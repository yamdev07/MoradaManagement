<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Définir le tenant_id basé sur l'utilisateur authentifié
        if (Auth::check() && Auth::user()->tenant_id) {
            app()->instance('tenant_id', Auth::user()->tenant_id);
            
            // Optionnel : Stocker aussi l'objet tenant complet
            $tenant = \App\Models\Tenant::find(Auth::user()->tenant_id);
            if ($tenant) {
                app()->instance('current_tenant', $tenant);
            }
        }

        return $next($request);
    }
}
