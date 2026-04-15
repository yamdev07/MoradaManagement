<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // Vérifier que c'est bien un Super Admin
        if (Auth::user()->role !== 'Super') {
            abort(403, 'Accès non autorisé');
        }

        // Statistiques globales
        $totalTenants = Tenant::where('is_active', true)->count();
        $pendingTenants = Tenant::where('is_active', false)
            ->whereHas('users', function($query) {
                $query->where('role', 'admin');
            })
            ->count();
        $totalUsers = User::count();
        $totalRooms = Room::count();
        $totalCustomers = Customer::count();
        $totalRevenue = Transaction::sum('total_price') ?? 0;
        $totalTransactions = Transaction::count();

        // Statistiques par tenant (actifs uniquement)
        $tenants = Tenant::with(['users', 'rooms', 'transactions'])
            ->where('is_active', true)
            ->get()
            ->map(function ($tenant) {
                return [
                    'id' => $tenant->id,
                    'name' => $tenant->name,
                    'domain' => $tenant->domain,
                    'users_count' => $tenant->users->count(),
                    'rooms_count' => $tenant->rooms->count(),
                    'customers_count' => $tenant->customers->count(),
                    'transactions_count' => $tenant->transactions->count(),
                    'revenue' => $tenant->transactions->sum('total_price') ?? 0,
                    'contact_email' => $tenant->email,
                    'created_at' => $tenant->created_at->format('d/m/Y'),
                ];
            });

        // Tenants en attente de validation (uniquement ceux avec inscription complète)
        $pendingTenantsList = Tenant::where('is_active', false)
            ->whereHas('users', function($query) {
                $query->where('role', 'admin');
            })
            ->with(['users' => function($query) {
                $query->where('role', 'admin');
            }])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($tenant) {
                return [
                    'id' => $tenant->id,
                    'name' => $tenant->name,
                    'domain' => $tenant->domain,
                    'email' => $tenant->email,
                    'phone' => $tenant->phone,
                    'address' => $tenant->address,
                    'description' => $tenant->description,
                    'logo' => $tenant->logo,
                    'theme_settings' => $tenant->theme_settings,
                    'admin_user' => $tenant->users->first(),
                    'created_at' => $tenant->created_at->format('d/m/Y H:i'),
                ];
            });

        // Statistiques par rôle
        $roleStats = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role');

        // Top 5 des hôtels par revenu
        $topTenantsByRevenue = $tenants->sortByDesc('revenue')->take(5);

        // Chiffres du mois
        $currentMonthRevenue = Transaction::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price') ?? 0;

        $lastMonthRevenue = Transaction::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total_price') ?? 0;

        $revenueGrowth = $lastMonthRevenue > 0 ? 
            (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;

        return view('super-admin.dashboard', compact(
            'totalTenants',
            'pendingTenants',
            'pendingTenantsList',
            'totalUsers', 
            'totalRooms',
            'totalCustomers',
            'totalRevenue',
            'totalTransactions',
            'tenants',
            'roleStats',
            'topTenantsByRevenue',
            'currentMonthRevenue',
            'lastMonthRevenue',
            'revenueGrowth'
        ));
    }

    public function tenants()
    {
        if (Auth::user()->role !== 'Super') {
            abort(403, 'Accès non autorisé');
        }

        $tenants = Tenant::with(['users', 'rooms', 'transactions'])
            ->where('is_active', true)
            ->paginate(10);

        return view('super-admin.tenants', compact('tenants'));
    }

    public function users()
    {
        if (Auth::user()->role !== 'Super') {
            abort(403, 'Accès non autorisé');
        }

        $users = User::with('tenant')->get();
        return view('super-admin.users', compact('users'));
    }

    public function approveTenant($id)
    {
        $isAjax = request()->ajax() || 
                  request()->header('X-Requested-With') === 'XMLHttpRequest' ||
                  request()->expectsJson();
        
        \Log::info('approveTenant called', [
            'tenant_id' => $id,
            'is_ajax' => $isAjax,
            'request_headers' => request()->headers->all(),
            'ajax_method' => request()->ajax(),
            'x_requested_with' => request()->header('X-Requested-With'),
            'expects_json' => request()->expectsJson()
        ]);
        
        if (Auth::user()->role !== 'Super') {
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => 'Accès non autorisé'
                ], 403);
            }
            abort(403, 'Accès non autorisé');
        }

        try {
            $tenant = Tenant::findOrFail($id);
            
            // Vérifier si le tenant n'est pas déjà approuvé
            if ($tenant->is_active) {
                if ($isAjax) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Ce tenant est déjà approuvé'
                    ]);
                }
                return redirect()->route('super-admin.dashboard')
                    ->with('warning', 'Ce tenant est déjà approuvé.');
            }

            // Activer le tenant (APPROBATION INSTANTANÉE)
            $tenant->is_active = true;
            $tenant->status = 1;
            
            // Appliquer les thèmes par défaut si non définis
            if (!$tenant->theme_settings) {
                $tenant->theme_settings = [
                    'primary_color' => '#8b4513',
                    'secondary_color' => '#a0522d',
                    'accent_color' => '#cd853f',
                    'background_color' => '#f4f1e8',
                    'text_color' => '#2c3e50',
                    'font_family' => 'Inter',
                    'logo_position' => 'left',
                    'show_stats' => true,
                    'enable_booking' => true,
                    'enable_restaurant' => true,
                    'custom_css' => ''
                ];
            }
            
            // Activer l'utilisateur admin associé (si existe)
            $adminUser = User::where('tenant_id', $tenant->id)->where('role', 'admin')->first();
            if ($adminUser) {
                $adminUser->is_active = true;
                $adminUser->email_verified_at = now();
                $adminUser->save();
            }
            
            $tenant->save();
            
            // APPROBATION ULTRA-RAPIDE : Pas de création de données pour l'instant
            if ($isAjax) {
                // Lancer la création des données en arrière-plan TRÈS léger
                $this->initializeTenantPagesMinimal($tenant);
                
                return response()->json([
                    'success' => true,
                    'message' => '⚡ ' . $tenant->name . ' approuvé INSTANTANÉMENT !',
                    'tenant' => $tenant,
                    'instant_approval' => true,
                    'background_initialization' => true
                ]);
            }
            
            // Pour les requêtes non-AJAX : création synchrone minimaliste
            $this->initializeTenantPagesMinimal($tenant);

            return redirect()->route('super-admin.dashboard')
                ->with('success', '⚡ ' . $tenant->name . ' approuvé avec succès !');
                
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'approbation du tenant', [
                'tenant_id' => $id,
                'error' => $e->getMessage(),
                'is_ajax' => $isAjax
            ]);

            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de l\'approbation: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('super-admin.dashboard')
                ->with('error', 'Erreur lors de l\'approbation du tenant: ' . $e->getMessage());
        }
    }

    /**
     * Initialiser les pages et données de base pour un tenant approuvé (version ultra-optimisée)
     */
    private function initializeTenantPages($tenant)
    {
        try {
            $now = \Carbon\Carbon::now();
            
            // 1. Créer uniquement les types de chambres essentiels (réduit de 4 à 2)
            $defaultTypes = [
                ['name' => 'Standard', 'description' => 'Chambre confortable', 'base_price' => 25000, 'capacity' => 2],
                ['name' => 'Deluxe', 'description' => 'Chambre premium avec vue', 'base_price' => 75000, 'capacity' => 3]
            ];

            $typeInserts = [];
            foreach ($defaultTypes as $typeData) {
                $typeInserts[] = [
                    'name' => $typeData['name'],
                    'description' => $typeData['description'],
                    'base_price' => $typeData['base_price'],
                    'capacity' => $typeData['capacity'],
                    'tenant_id' => $tenant->id,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }
            \App\Models\Type::insert($typeInserts);

            // 2. Créer uniquement 6 chambres exemples (réduit de 12 à 6)
            $types = \App\Models\Type::where('tenant_id', $tenant->id)->get();
            $roomInserts = [];
            $roomCounter = 1;

            foreach ($types as $type) {
                for ($i = 1; $i <= 3; $i++) {
                    $roomInserts[] = [
                        'number' => str_pad($roomCounter, 3, '0', STR_PAD_LEFT),
                        'type_id' => $type->id,
                        'capacity' => $type->capacity,
                        'price' => $type->base_price,
                        'description' => "{$type->name} #{$roomCounter}",
                        'room_status_id' => 1,
                        'tenant_id' => $tenant->id,
                        'created_at' => $now,
                        'updated_at' => $now
                    ];
                    $roomCounter++;
                }
            }
            \App\Models\Room::insert($roomInserts);

            // 3. Créer uniquement 2 menus essentiels (réduit de 4 à 2)
            $defaultMenus = [
                ['name' => 'Petit Déjeuner', 'description' => 'Petit déjeuner continental', 'price' => 5000, 'category' => 'breakfast'],
                ['name' => 'Déjeuner', 'description' => 'Déjeuner complet', 'price' => 12000, 'category' => 'lunch']
            ];

            $menuInserts = [];
            foreach ($defaultMenus as $menuData) {
                $menuInserts[] = [
                    'name' => $menuData['name'],
                    'description' => $menuData['description'],
                    'price' => $menuData['price'],
                    'category' => $menuData['category'],
                    'tenant_id' => $tenant->id,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }
            \App\Models\Menu::insert($menuInserts);

            // 4. Logger la création optimisée
            \Log::info('Pages et données du tenant initialisées (MODE ULTRA-OPTIMISÉ)', [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
                'rooms_created' => count($roomInserts),
                'types_created' => count($typeInserts),
                'menus_created' => count($menuInserts),
                'total_items' => count($roomInserts) + count($typeInserts) + count($menuInserts),
                'batch_insertion' => true,
                'ultra_optimized' => true
            ]);

        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'initialisation des pages du tenant', [
                'tenant_id' => $tenant->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Initialiser les pages en arrière-plan (version minimaliste ultra-rapide)
     */
    private function initializeTenantPagesMinimal($tenant)
    {
        try {
            $now = \Carbon\Carbon::now();
            
            // Création ultra-minimaliste : seulement 1 type et 2 chambres
            \App\Models\Type::insert([
                'name' => 'Standard',
                'description' => 'Chambre confortable',
                'base_price' => 25000,
                'capacity' => 2,
                'tenant_id' => $tenant->id,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            $type = \App\Models\Type::where('tenant_id', $tenant->id)->first();
            if ($type) {
                \App\Models\Room::insert([
                    [
                        'number' => '001',
                        'type_id' => $type->id,
                        'capacity' => 2,
                        'price' => 25000,
                        'description' => 'Chambre Standard #1',
                        'room_status_id' => 1,
                        'tenant_id' => $tenant->id,
                        'created_at' => $now,
                        'updated_at' => $now
                    ],
                    [
                        'number' => '002',
                        'type_id' => $type->id,
                        'capacity' => 2,
                        'price' => 25000,
                        'description' => 'Chambre Standard #2',
                        'room_status_id' => 1,
                        'tenant_id' => $tenant->id,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]
                ]);
            }

            \Log::info('Initialisation minimaliste terminée', [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
                'minimal_mode' => true,
                'items_created' => 3
            ]);

        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'initialisation minimaliste', [
                'tenant_id' => $tenant->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Initialiser les pages de manière synchrone minimaliste (pour non-AJAX)
     */
    private function initializeTenantPagesMinimalSync($tenant)
    {
        try {
            $now = \Carbon\Carbon::now();
            
            // Création synchrone ultra-minimaliste
            \App\Models\Type::insert([
                'name' => 'Standard',
                'description' => 'Chambre confortable',
                'base_price' => 25000,
                'capacity' => 2,
                'tenant_id' => $tenant->id,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            $type = \App\Models\Type::where('tenant_id', $tenant->id)->first();
            if ($type) {
                \App\Models\Room::insert([
                    [
                        'number' => '001',
                        'type_id' => $type->id,
                        'capacity' => 2,
                        'price' => 25000,
                        'description' => 'Chambre Standard #1',
                        'room_status_id' => 1,
                        'tenant_id' => $tenant->id,
                        'created_at' => $now,
                        'updated_at' => $now
                    ],
                    [
                        'number' => '002',
                        'type_id' => $type->id,
                        'capacity' => 2,
                        'price' => 25000,
                        'description' => 'Chambre Standard #2',
                        'room_status_id' => 1,
                        'tenant_id' => $tenant->id,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]
                ]);
            }

            \Log::info('Initialisation synchrone minimaliste terminée', [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
                'sync_mode' => true,
                'items_created' => 3
            ]);

        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'initialisation synchrone minimaliste', [
                'tenant_id' => $tenant->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function rejectTenant($id)
    {
        if (Auth::user()->role !== 'Super') {
            abort(403, 'Accès non autorisé');
        }

        try {
            $tenant = Tenant::findOrFail($id);
            
            // Supprimer l'utilisateur admin associé
            $tenant->users()->delete();
            
            // Supprimer les données liées
            $tenant->rooms()->delete();
            $tenant->customers()->delete();
            $tenant->transactions()->delete();
            
            // Supprimer le tenant lui-même
            $tenant->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tenant rejeté et supprimé avec succès'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du rejet: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleTenantStatus($id)
    {
        if (Auth::user()->role !== 'Super') {
            abort(403, 'Accès non autorisé');
        }

        $tenant = Tenant::findOrFail($id);
        $tenant->status = $tenant->status ? 0 : 1;
        $tenant->save();

        return redirect()->back()->with('success', 'Statut de l\'hôtel mis à jour');
    }
}
