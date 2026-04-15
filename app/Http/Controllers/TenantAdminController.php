<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TenantAdminController extends Controller
{
    /**
     * Afficher le dashboard de l'admin tenant
     */
    public function dashboard($subdomain)
    {
        $user = Auth::user();
        
        // Si l'utilisateur n'est pas connecté, rediriger vers login
        if (!$user) {
            return redirect()->route('login.index');
        }
        
        // Si l'utilisateur n'a pas de tenant_id, rediriger vers l'accueil
        if (!$user->tenant_id) {
            return redirect('/')->with('error', 'Vous n\'êtes associé à aucune entreprise.');
        }
        
        // Chercher le tenant par sous-domaine
        $tenant = Tenant::where('subdomain', $subdomain)->first();
        
        if (!$tenant) {
            return redirect('/')->with('error', 'Ce tenant n\'existe pas.');
        }
        
        // Vérifier si l'utilisateur appartient à ce tenant
        if ($user->tenant_id !== $tenant->id) {
            return redirect('/')->with('error', 'Vous n\'avez pas accès à ce tenant.');
        }
        
        // Définir le tenant courant
        app()->instance('current_tenant', $tenant);
        app()->instance('tenant_id', $tenant->id);
        
        
        // Statistiques pour le tenant
        $stats = [
            'total_users' => User::where('tenant_id', $tenant->id)->count(),
            'total_rooms' => Room::where('tenant_id', $tenant->id)->count(),
            'total_customers' => Customer::where('tenant_id', $tenant->id)->count(),
            'total_transactions' => Transaction::where('tenant_id', $tenant->id)->count(),
            'total_revenue' => Transaction::where('tenant_id', $tenant->id)
                ->where('status', 'completed')
                ->sum('amount'),
            'recent_transactions' => Transaction::where('tenant_id', $tenant->id)
                ->with('customer')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
            'recent_users' => User::where('tenant_id', $tenant->id)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
            'occupancy_rate' => $this->calculateOccupancyRate($tenant->id),
        ];

        return view('tenant.dashboard', compact('user', 'tenant', 'stats'));
    }

    /**
     * Afficher la liste des utilisateurs du tenant
     */
    public function users($subdomain)
    {
        $user = Auth::user();
        
        // Vérifications similaires à dashboard
        $tenant = Tenant::where('subdomain', $subdomain)->first();
        if (!$tenant || $user->tenant_id !== $tenant->id) {
            return redirect('/')->with('error', 'Accès non autorisé.');
        }
        
        app()->instance('current_tenant', $tenant);
        app()->instance('tenant_id', $tenant->id);
        
        $users = User::where('tenant_id', $tenant->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tenant.users', compact('user', 'tenant', 'users'));
    }

    /**
     * Afficher le formulaire de création d'utilisateur
     */
    public function createUser($subdomain)
    {
        $user = Auth::user();
        
        // Vérifications similaires à dashboard
        $tenant = Tenant::where('subdomain', $subdomain)->first();
        if (!$tenant || $user->tenant_id !== $tenant->id) {
            return redirect('/')->with('error', 'Accès non autorisé.');
        }
        
        app()->instance('current_tenant', $tenant);
        app()->instance('tenant_id', $tenant->id);
        
        return view('tenant.create-user', compact('user', 'tenant'));
    }

    /**
     * Créer un nouvel utilisateur pour le tenant
     */
    public function storeUser(Request $request, $subdomain)
    {
        $user = Auth::user();
        
        // Vérifications similaires à dashboard
        $tenant = Tenant::where('subdomain', $subdomain)->first();
        if (!$tenant || $user->tenant_id !== $tenant->id) {
            return redirect('/')->with('error', 'Accès non autorisé.');
        }
        
        app()->instance('current_tenant', $tenant);
        app()->instance('tenant_id', $tenant->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:Admin,Receptionist,Customer,Housekeeping',
        ]);

        // Le tenant_id est automatiquement assigné par le trait BelongsToTenant
        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'random_key' => \Illuminate\Support\Str::random(32),
        ]);

        return redirect()->route('tenant.users', ['subdomain' => $tenant->subdomain])->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Afficher les chambres du tenant
     */
    public function rooms($subdomain)
    {
        $user = Auth::user();
        $tenant = Tenant::where('subdomain', $subdomain)->first();
        if (!$tenant || $user->tenant_id !== $tenant->id) {
            return redirect('/')->with('error', 'Accès non autorisé.');
        }
        app()->instance('current_tenant', $tenant);
        app()->instance('tenant_id', $tenant->id);
        
        $rooms = Room::where('tenant_id', $tenant->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tenant.rooms', compact('user', 'tenant', 'rooms'));
    }

    /**
     * Afficher les transactions du tenant
     */
    public function transactions($subdomain)
    {
        $user = Auth::user();
        $tenant = Tenant::where('subdomain', $subdomain)->first();
        if (!$tenant || $user->tenant_id !== $tenant->id) {
            return redirect('/')->with('error', 'Accès non autorisé.');
        }
        app()->instance('current_tenant', $tenant);
        app()->instance('tenant_id', $tenant->id);
        
        $transactions = Transaction::where('tenant_id', $tenant->id)
            ->with('customer', 'room')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tenant.transactions', compact('user', 'tenant', 'transactions'));
    }

    /**
     * Afficher les paramètres du tenant
     */
    public function settings($subdomain)
    {
        $user = Auth::user();
        $tenant = Tenant::where('subdomain', $subdomain)->first();
        if (!$tenant || $user->tenant_id !== $tenant->id) {
            return redirect('/')->with('error', 'Accès non autorisé.');
        }
        app()->instance('current_tenant', $tenant);
        app()->instance('tenant_id', $tenant->id);
        
        return view('tenant.settings', compact('user', 'tenant'));
    }

    /**
     * Mettre à jour les paramètres du tenant
     */
    public function updateSettings(Request $request, $subdomain)
    {
        $user = Auth::user();
        $tenant = Tenant::where('subdomain', $subdomain)->first();
        if (!$tenant || $user->tenant_id !== $tenant->id) {
            return redirect('/')->with('error', 'Accès non autorisé.');
        }
        app()->instance('current_tenant', $tenant);
        app()->instance('tenant_id', $tenant->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        $tenant->update($request->only(['name', 'contact_email', 'contact_phone']));

        return redirect()->route('tenant.settings', ['subdomain' => $tenant->subdomain])->with('success', 'Paramètres mis à jour avec succès.');
    }

    /**
     * Calculer le taux d'occupation
     */
    private function calculateOccupancyRate($tenantId)
    {
        $totalRooms = Room::where('tenant_id', $tenantId)->count();
        if ($totalRooms == 0) return 0;

        $occupiedRooms = Room::where('tenant_id', $tenantId)
            ->where('status', 'occupied')
            ->count();

        return round(($occupiedRooms / $totalRooms) * 100, 1);
    }
}
