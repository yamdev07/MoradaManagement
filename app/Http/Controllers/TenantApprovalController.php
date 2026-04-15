<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use App\Models\Room;
use App\Models\Type;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TenantApprovalController extends Controller
{
    /**
     * Approuver un tenant et le configurer automatiquement
     */
    public function approveTenant($tenantId)
    {
        try {
            $tenant = Tenant::findOrFail($tenantId);
            
            // Vérifier si le tenant n'est pas déjà approuvé
            if ($tenant->status == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ce tenant est déjà approuvé'
                ]);
            }

            // Approuver le tenant
            $tenant->status = 1;
            $tenant->is_active = true;
            $tenant->approved_at = Carbon::now();
            
            // Appliquer les thèmes par défaut si non définis
            if (!$tenant->theme_settings) {
                $tenant->theme_settings = $this->getDefaultThemeSettings();
            }
            
            $tenant->save();

            // Créer les données de base pour le tenant
            $this->initializeTenantData($tenant);

            // Créer un utilisateur administrateur pour le tenant
            $this->createTenantAdmin($tenant);

            Log::info('Tenant approuvé avec succès', [
                'tenant_id' => $tenant->id,
                'tenant_name' => $tenant->name,
                'approved_at' => $tenant->approved_at
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tenant approuvé et configuré avec succès',
                'tenant' => $tenant
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'approbation du tenant', [
                'tenant_id' => $tenantId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'approbation: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtenir les thèmes par défaut pour un tenant
     */
    private function getDefaultThemeSettings()
    {
        return [
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

    /**
     * Initialiser les données de base pour un tenant
     */
    private function initializeTenantData($tenant)
    {
        try {
            // Créer des types de chambres par défaut
            $defaultTypes = [
                ['name' => 'Standard', 'description' => 'Chambre standard confortable', 'base_price' => 25000],
                ['name' => 'Deluxe', 'description' => 'Chambre deluxe avec vue', 'base_price' => 45000],
                ['name' => 'Suite', 'description' => 'Suite luxueuse spacieuse', 'base_price' => 75000],
                ['name' => 'VIP', 'description' => 'Suite VIP avec services premium', 'base_price' => 125000]
            ];

            foreach ($defaultTypes as $typeData) {
                Type::create([
                    'name' => $typeData['name'],
                    'description' => $typeData['description'],
                    'base_price' => $typeData['base_price'],
                    'tenant_id' => $tenant->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }

            // Créer des chambres d'exemple
            $types = Type::where('tenant_id', $tenant->id)->get();
            $roomCounter = 1;

            foreach ($types as $type) {
                for ($i = 1; $i <= 3; $i++) {
                    Room::create([
                        'number' => str_pad($roomCounter, 3, '0', STR_PAD_LEFT),
                        'type_id' => $type->id,
                        'capacity' => $type->name == 'VIP' ? 4 : ($type->name == 'Suite' ? 3 : 2),
                        'price' => $type->base_price,
                        'description' => "Chambre {$type->name} #{$roomCounter}",
                        'room_status_id' => 1, // Available
                        'tenant_id' => $tenant->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    $roomCounter++;
                }
            }

            // Créer des menus de restaurant par défaut
            $defaultMenus = [
                [
                    'name' => 'Petit Déjeuner',
                    'description' => 'Petit déjeuner continental complet',
                    'price' => 5000,
                    'category' => 'breakfast'
                ],
                [
                    'name' => 'Déjeuner',
                    'description' => 'Déjeuner avec entrée, plat et dessert',
                    'price' => 12000,
                    'category' => 'lunch'
                ],
                [
                    'name' => 'Dîner',
                    'description' => 'Dîner gastronomique',
                    'price' => 15000,
                    'category' => 'dinner'
                ]
            ];

            foreach ($defaultMenus as $menuData) {
                Menu::create([
                    'name' => $menuData['name'],
                    'description' => $menuData['description'],
                    'price' => $menuData['price'],
                    'category' => $menuData['category'],
                    'tenant_id' => $tenant->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }

            Log::info('Données de base initialisées pour le tenant', [
                'tenant_id' => $tenant->id,
                'types_created' => $types->count(),
                'rooms_created' => $roomCounter - 1,
                'menus_created' => count($defaultMenus)
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'initialisation des données du tenant', [
                'tenant_id' => $tenant->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Créer un utilisateur administrateur pour le tenant
     */
    private function createTenantAdmin($tenant)
    {
        try {
            $adminEmail = 'admin@' . Str::slug($tenant->name, '') . '.morada.com';
            
            // Vérifier si l'email existe déjà
            if (User::where('email', $adminEmail)->exists()) {
                $adminEmail = 'admin' . $tenant->id . '@morada.com';
            }

            $adminUser = User::create([
                'name' => 'Administrateur ' . $tenant->name,
                'email' => $adminEmail,
                'password' => Hash::make('admin123'), // Mot de passe temporaire
                'role' => 'Admin',
                'tenant_id' => $tenant->id,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            Log::info('Utilisateur administrateur créé pour le tenant', [
                'tenant_id' => $tenant->id,
                'user_id' => $adminUser->id,
                'email' => $adminEmail
            ]);

            return $adminUser;

        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'admin du tenant', [
                'tenant_id' => $tenant->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Obtenir les statistiques d'un tenant
     */
    public function getTenantStats($tenantId)
    {
        try {
            $tenant = Tenant::findOrFail($tenantId);
            
            $stats = [
                'rooms_count' => Room::where('tenant_id', $tenant->id)->count(),
                'available_rooms' => Room::where('tenant_id', $tenant->id)->where('room_status_id', 1)->count(),
                'active_reservations' => \App\Models\Transaction::where('tenant_id', $tenant->id)
                    ->whereIn('status', ['active', 'reservation'])->count(),
                'users_count' => User::where('tenant_id', $tenant->id)->count(),
                'menus_count' => Menu::where('tenant_id', $tenant->id)->count(),
                'total_revenue' => \App\Models\Transaction::where('tenant_id', $tenant->id)
                    ->whereHas('payments', function ($query) {
                        $query->where('status', 'completed');
                    })->sum('total_price'),
                'occupancy_rate' => $this->calculateOccupancyRate($tenant->id),
                'theme_settings' => $tenant->theme_settings,
                'created_at' => $tenant->created_at,
                'approved_at' => $tenant->approved_at
            ];

            return response()->json([
                'success' => true,
                'stats' => $stats,
                'tenant' => $tenant
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des stats du tenant', [
                'tenant_id' => $tenantId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculer le taux d'occupation
     */
    private function calculateOccupancyRate($tenantId)
    {
        try {
            $totalRooms = Room::where('tenant_id', $tenantId)->count();
            
            if ($totalRooms == 0) {
                return 0;
            }

            $occupiedRooms = \App\Models\Transaction::where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->where('check_in', '<=', Carbon::now())
                ->where('check_out', '>=', Carbon::now())
                ->distinct('room_id')
                ->count('room_id');

            return round(($occupiedRooms / $totalRooms) * 100, 2);

        } catch (\Exception $e) {
            Log::error('Erreur lors du calcul du taux d\'occupation', [
                'tenant_id' => $tenantId,
                'error' => $e->getMessage()
            ]);
            return 0;
        }
    }

    /**
     * Mettre à jour les thèmes d'un tenant
     */
    public function updateTenantTheme(Request $request, $tenantId)
    {
        try {
            $tenant = Tenant::findOrFail($tenantId);
            
            $themeSettings = $request->only([
                'primary_color',
                'secondary_color',
                'accent_color',
                'background_color',
                'text_color',
                'font_family',
                'logo_position',
                'show_stats',
                'enable_booking',
                'enable_restaurant',
                'custom_css'
            ]);

            $tenant->theme_settings = array_merge($tenant->theme_settings ?? [], $themeSettings);
            $tenant->save();

            Log::info('Thèmes du tenant mis à jour', [
                'tenant_id' => $tenantId,
                'theme_settings' => $tenant->theme_settings
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thèmes mis à jour avec succès',
                'theme_settings' => $tenant->theme_settings
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour des thèmes', [
                'tenant_id' => $tenantId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Rejeter et supprimer un tenant
     */
    public function rejectTenant($tenantId)
    {
        try {
            $tenant = Tenant::findOrFail($tenantId);
            
            // Supprimer l'utilisateur admin associé
            $tenant->users()->delete();
            
            // Supprimer les données liées
            $tenant->rooms()->delete();
            $tenant->customers()->delete();
            $tenant->transactions()->delete();
            
            // Supprimer le tenant lui-même
            $tenant->delete();

            Log::info('Tenant rejeté et supprimé', [
                'tenant_id' => $tenantId,
                'tenant_name' => $tenant->name
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tenant rejeté et supprimé avec succès'
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors du rejet du tenant', [
                'tenant_id' => $tenantId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }
}
