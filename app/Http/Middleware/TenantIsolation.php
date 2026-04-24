<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TenantIsolation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currentHotel = null;
        $hotelId = session('selected_hotel_id');
        
        \Log::info('TenantIsolation: DÉMARRAGE', [
            'url' => $request->fullUrl(),
            'hotel_id' => $hotelId,
            'user_authenticated' => auth()->check(),
            'user_id' => auth()->check() ? auth()->user()->id : null,
            'user_tenant_id' => auth()->check() ? auth()->user()->tenant_id : null
        ]);
        
        // Si aucun hotel_id en session, pas d'isolation
        if (!$hotelId) {
            \Log::info('TenantIsolation: Aucun hotel_id en session, pas d\'isolation');
            return $next($request);
        }
        
        // Récupérer le tenant actuel
        $currentHotel = Tenant::find($hotelId);
        if (!$currentHotel) {
            \Log::warning('TenantIsolation: Tenant non trouvé', ['hotel_id' => $hotelId]);
            return $next($request);
        }
        
        \Log::info('TenantIsolation: ISOLATION ACTIVÉE', [
            'tenant_id' => $hotelId,
            'tenant_name' => $currentHotel->name,
            'tenant_domain' => $currentHotel->domain
        ]);
        
        // Partager le tenant dans toutes les vues
        view()->share('currentHotel', $currentHotel);
        view()->share('currentHotelId', $hotelId);
        
        // Si l'utilisateur est connecté, vérifier qu'il appartient bien à ce tenant
        if (auth()->check()) {
            $user = auth()->user();
            
            // Super Admin peut accéder à tous les tenants
            if ($user->role === 'Super') {
                \Log::info('TenantIsolation: Super Admin accès autorisé', [
                    'user_id' => $user->id,
                    'user_role' => $user->role,
                    'tenant_access' => $hotelId
                ]);
            } 
            // Vérifier si l'utilisateur appartient à ce tenant
            elseif ($user->tenant_id != $hotelId) {
                \Log::warning('TenantIsolation: ACCÈS REFUSÉ - Utilisateur n\'appartient pas au tenant', [
                    'user_id' => $user->id,
                    'user_tenant_id' => $user->tenant_id,
                    'requested_tenant_id' => $hotelId,
                    'user_role' => $user->role
                ]);
                
                // Rediriger vers le dashboard du user ou page d'erreur
                if ($user->tenant_id) {
                    return redirect()->route('dashboard.index', ['hotel_id' => $user->tenant_id])
                        ->with('error', 'Vous n\'avez pas accès à ce tenant. Redirection vers votre tenant.');
                } else {
                    return redirect()->route('tenant.portal')
                        ->with('error', 'Vous n\'avez pas accès à ce tenant. Veuillez choisir votre tenant.');
                }
            } else {
                \Log::info('TenantIsolation: Accès autorisé', [
                    'user_id' => $user->id,
                    'user_tenant_id' => $user->tenant_id,
                    'tenant_name' => $currentHotel->name
                ]);
            }
        }
        
        // Créer des scopes globaux pour les modèles
        $this->setupTenantScopes($hotelId);
        
        return $next($request);
    }
    
    /**
     * Configurer les scopes pour isoler les données du tenant
     */
    private function setupTenantScopes($hotelId)
    {
        // Scope global pour les chambres
        Room::addGlobalScope('tenant', function ($query) use ($hotelId) {
            $query->where('tenant_id', $hotelId);
        });
        
        // Scope global pour les transactions
        Transaction::addGlobalScope('tenant', function ($query) use ($hotelId) {
            $query->where('tenant_id', $hotelId);
        });
        
        // Scope global pour les réservations (si le modèle existe)
        if (class_exists('\App\Models\Reservation')) {
            Reservation::addGlobalScope('tenant', function ($query) use ($hotelId) {
                $query->where('tenant_id', $hotelId);
            });
        }
        
        // Scope global pour les clients (si applicable)
        if (class_exists('\App\Models\Customer')) {
            Customer::addGlobalScope('tenant', function ($query) use ($hotelId) {
                if (method_exists($query, 'whereHas')) {
                    $query->whereHas('transactions', function ($q) use ($hotelId) {
                        $q->where('tenant_id', $hotelId);
                    });
                }
            });
        }
        
        \Log::info('TenantIsolation: Scopes configurés', ['hotel_id' => $hotelId]);
    }
}
