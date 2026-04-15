<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantPortalController extends Controller
{
    /**
     * Afficher le portail des tenants avec leurs liens de login
     */
    public function index()
    {
        // Récupérer tous les tenants actifs avec leurs relations
        $tenants = Tenant::with(['users', 'rooms'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('auth.tenant-portal', compact('tenants'));
    }

    /**
     * Afficher une page de login spécifique pour un tenant
     */
    public function showLogin($tenant)
    {
        $tenantModel = Tenant::where('domain', $tenant)
            ->orWhere('subdomain', $tenant)
            ->orWhere('id', $tenant)
            ->first();

        if (!$tenantModel) {
            abort(404, 'Tenant non trouvé');
        }

        return view('auth.tenant-login', ['tenant' => $tenantModel]);
    }

    /**
     * API pour récupérer les informations d'un tenant
     */
    public function getTenantInfo($tenant)
    {
        $tenantModel = Tenant::where('domain', $tenant)
            ->orWhere('subdomain', $tenant)
            ->orWhere('id', $tenant)
            ->first();

        if (!$tenantModel) {
            return response()->json(['error' => 'Tenant non trouvé'], 404);
        }

        return response()->json([
            'id' => $tenantModel->id,
            'name' => $tenantModel->name,
            'domain' => $tenantModel->domain,
            'subdomain' => $tenantModel->subdomain,
            'logo' => $tenantModel->logo,
            'description' => $tenantModel->description,
            'is_active' => $tenantModel->is_active,
            'theme_settings' => $tenantModel->theme_settings,
            'users_count' => $tenantModel->users()->count(),
            'rooms_count' => $tenantModel->rooms()->count(),
            'login_url' => route('tenant.login', $tenantModel->domain ?? $tenantModel->subdomain ?? $tenantModel->id)
        ]);
    }

    /**
     * Rechercher des tenants par nom ou domaine
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query || strlen($query) < 2) {
            return response()->json(['error' => 'Query too short'], 400);
        }

        $tenants = Tenant::where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('domain', 'LIKE', "%{$query}%")
                  ->orWhere('subdomain', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->with(['users', 'rooms'])
            ->orderBy('name')
            ->limit(10)
            ->get();

        return response()->json($tenants);
    }
}
