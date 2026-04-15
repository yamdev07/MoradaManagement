<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;

class SetTenantBySubdomain
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtenir le sous-domaine depuis l'URL
        $subdomain = $request->getHost();
        
        // Enlever le domaine principal
        $mainDomain = config('app.domain', 'localhost');
        if (strpos($subdomain, $mainDomain) !== false) {
            $subdomain = str_replace('.' . $mainDomain, '', $subdomain);
        }
        
        // Si c'est le domaine principal ou www, ne rien faire
        if (in_array($subdomain, ['www', 'localhost', '127.0.0.1', ''])) {
            return $next($request);
        }
        
        // Chercher le tenant par sous-domaine
        $tenant = Tenant::where('subdomain', $subdomain)->first();
        
        if (!$tenant) {
            // Rediriger vers le domaine principal si le tenant n'existe pas
            return redirect(config('app.url'))->with('error', 'Ce tenant n\'existe pas.');
        }
        
        // Vérifier si le tenant est actif
        if (!$tenant->status) {
            return redirect(config('app.url'))->with('error', 'Ce tenant est désactivé.');
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
                    ->with('error', 'Vous n\'avez pas accès à ce tenant. Veuillez vous connecter avec le bon compte.');
            }
        }
        
        return $next($request);
    }
}
