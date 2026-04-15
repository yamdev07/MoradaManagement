<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;

class TenantThemeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $tenantColors = null;
        
        // Récupérer le tenant depuis l'URL ou la session
        $hotelId = $request->get('hotel_id') ?: session('selected_hotel_id');
        
        // Utiliser des couleurs de test basées sur l'URL (sans reqête BDD)
        if ($request->get('hotel_id') == '3') {
            // Hotel Paradise - Bleu
            $tenantColors = [
                'primary_color' => '#1e3a8a',
                'secondary_color' => '#3b82f6',
                'accent_color' => '#f59e0b'
            ];
        } elseif ($request->get('hotel_id') == '4') {
            // Cactus Palace - Vert
            $tenantColors = [
                'primary_color' => '#059669',
                'secondary_color' => '#10b981',
                'accent_color' => '#fbbf24'
            ];
        } elseif ($request->get('hotel_id') == '45') {
            // HOTEL PRINCE - Violet
            $tenantColors = [
                'primary_color' => '#7c3aed',
                'secondary_color' => '#a78bfa',
                'accent_color' => '#f59e0b'
            ];
        } else {
            // Couleurs par défaut
            $tenantColors = [
                'primary_color' => '#2c3e50',
                'secondary_color' => '#3498db',
                'accent_color' => '#f39c12'
            ];
        }
        
        // Stocker en session
        session(['tenant_colors' => $tenantColors]);
        
        // Partager les couleurs avec toutes les vues
        view()->share('tenantColors', $tenantColors);
        
        return $next($request);
    }
}
