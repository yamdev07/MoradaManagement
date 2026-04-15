<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;

class SetTenantByUrl
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtenir le tenant depuis l'URL (ex: /tenant/benin/dashboard)
        $path = $request->path();
        $segments = explode('/', $path);
        
        // Vérifier si c'est une route tenant
        if (count($segments) >= 2 && $segments[0] === 'tenant') {
            $subdomain = $segments[1];
            
            // Chercher le tenant par sous-domaine
            $tenant = Tenant::where('subdomain', $subdomain)->first();
            
            if (!$tenant) {
                return redirect('/')->with('error', 'Ce tenant n\'existe pas.');
            }
            
            // Vérifier si le tenant est actif
            if (!$tenant->status) {
                return redirect('/')->with('error', 'Ce tenant est désactivé.');
            }
            
            // Définir le tenant courant
            app()->instance('current_tenant', $tenant);
            app()->instance('tenant_id', $tenant->id);
            
            // Si l'utilisateur est connecté, vérifier qu'il appartient à ce tenant
            if (Auth::check()) {
                if (Auth::user()->tenant_id !== $tenant->id) {
                    // Déconnecter l'utilisateur s'il n'appartient pas à ce tenant
                    Auth::logout();
                    session()->invalidate();
                    session()->regenerateToken();
                    
                    return redirect()->route('login.index')
                        ->with('error', 'Vous n\'avez pas accès à ce tenant. Veuillez vous connecter avec le bon compte.')
                        ->with('intended_tenant', $subdomain);
                }
            }
        }
        
        return $next($request);
    }
}
