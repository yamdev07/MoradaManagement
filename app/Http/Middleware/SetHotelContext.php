<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetHotelContext
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
        $hotelId = null;
        
        // Log pour débug
        \Log::info('SetHotelContext: DÉBUT DU MIDDLEWARE', [
            'url' => $request->fullUrl(),
            'route' => $request->route() ? $request->route()->getName() : 'unknown',
            'method' => $request->method(),
            'all_params' => $request->all(),
            'hotel_id_param' => $request->input('hotel_id'),
            'hotel_id_session' => session()->get('selected_hotel_id'),
            'user_authenticated' => auth()->check(),
            'user_tenant_id' => auth()->check() ? auth()->user()->tenant_id : null
        ]);
        
        \Log::info('SetHotelContext: DÉMARRAGE', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'has_hotel_id' => $request->has('hotel_id'),
            'hotel_id_value' => $request->get('hotel_id'),
            'segments' => $request->segments(),
            'session_hotel_id' => session('selected_hotel_id'),
            'session_exists' => session()->has('selected_hotel_id')
        ]);
        
        // 1. PRIORITÉ ABSOLUE : Vérifier si l'hotel_id est passé en paramètre GET
        if ($request->has('hotel_id') && $request->get('hotel_id')) {
            $hotelId = $request->get('hotel_id');
            Session::put('selected_hotel_id', $hotelId);
            
            // Log pour débug
            \Log::info('SetHotelContext: Hotel ID passé en paramètre (PRIORITÉ ABSOLUE)', [
                'hotel_id' => $hotelId,
                'url' => $request->fullUrl(),
                'user_agent' => $request->userAgent(),
                'ip' => $request->ip(),
                'previous_session_id' => Session::get('selected_hotel_id', 'none')
            ]);
        }
        // 2. Sinon, vérifier si l'hotel_id est en session
        elseif (session()->has('selected_hotel_id') && session('selected_hotel_id')) {
            $hotelId = session('selected_hotel_id');
            
            \Log::info('SetHotelContext: Hotel ID récupéré depuis la session', [
                'hotel_id' => $hotelId,
                'url' => $request->fullUrl()
            ]);
        }
        // 3. Vérifier si l'URL contient /hotel/{domain}
        elseif ($request->segment(1) === 'hotel' && $request->segment(2)) {
            $domain = $request->segment(2);
            $hotel = Tenant::where('domain', $domain)->orWhere('subdomain', $domain)->first();
            
            if ($hotel) {
                $hotelId = $hotel->id;
                Session::put('selected_hotel_id', $hotelId);
                
                // Log pour débug
                \Log::info('SetHotelContext: Tenant détecté depuis l\'URL', [
                    'domain' => $domain,
                    'hotel_id' => $hotelId,
                    'hotel_name' => $hotel->name,
                    'url' => $request->fullUrl()
                ]);
            }
        }
        // 4. Sinon, essayer de récupérer depuis l'utilisateur connecté (SEULEMENT si aucun hotel_id en session/param)
        elseif (!session()->has('selected_hotel_id') && !$request->has('hotel_id') && auth()->check() && auth()->user()->tenant_id) {
            $hotelId = auth()->user()->tenant_id;
            Session::put('selected_hotel_id', $hotelId);
            
            // Log pour débug
            \Log::info('SetHotelContext: Utilisateur connecté', [
                'user_id' => auth()->user()->id,
                'user_email' => auth()->user()->email,
                'tenant_id' => $hotelId,
                'user_role' => auth()->user()->role
            ]);
        }
        // 5. Sinon, vérifier si l'utilisateur connecté a un tenant_id pour les pages frontend (SEULEMENT si aucun hotel_id en session/param)
        else {
            // Pour les pages frontend, si l'utilisateur est connecté avec un tenant_id ET qu'aucun hotel_id n'est fourni, l'utiliser
            if (!session()->has('selected_hotel_id') && !$request->has('hotel_id') && auth()->check() && auth()->user()->tenant_id) {
                $hotelId = auth()->user()->tenant_id;
                Session::put('selected_hotel_id', $hotelId);
                
                \Log::info('SetHotelContext: Tenant de l\'utilisateur utilisé pour frontend', [
                    'user_id' => auth()->user()->id,
                    'user_email' => auth()->user()->email,
                    'tenant_id' => $hotelId,
                    'url' => request()->fullUrl()
                ]);
            } else {
                // Ne forcer aucun hôtel quand aucun hotel_id n'est fourni
                \Log::info('SetHotelContext: Aucun hôtel forcé', [
                    'url' => request()->fullUrl(),
                    'route' => request()->route() ? request()->route()->getName() : 'unknown'
                ]);
            }
        }
        
        \Log::info('SetHotelContext: VÉRIFICATION FINALE', [
            'hotel_id' => $hotelId,
            'is_null' => is_null($hotelId),
            'hotel_id_type' => gettype($hotelId)
        ]);
        
        // Définir le contexte de l'hôtel
        if ($hotelId) {
            \Log::info('SetHotelContext: RECHERCHE DU TENANT', ['hotel_id' => $hotelId]);
            
            $hotel = Tenant::find($hotelId);
            if ($hotel) {
                \Log::info('SetHotelContext: TENANT TROUVÉ', ['hotel_name' => $hotel->name]);
                
                // Partager l'hôtel dans toute l'application
                app()->instance('current_hotel', $hotel);
                app()->instance('current_hotel_id', $hotelId);
                
                // Partager aussi dans les vues
                view()->share('currentHotel', $hotel);
                view()->share('currentHotelId', $hotelId);
                
                // Log pour débug
                \Log::info('SetHotelContext: Hôtel partagé dans les vues', [
                    'hotel_id' => $hotelId,
                    'hotel_name' => $hotel->name,
                    'is_paradise' => $hotel->name == 'Hotel Paradise',
                    'url' => request()->fullUrl()
                ]);
            } else {
                \Log::warning('SetHotelContext: TENANT NON TROUVÉ', ['hotel_id' => $hotelId]);
            }
        } else {
            \Log::info('SetHotelContext: AUCUN HOTEL_ID À TRAITER');
        }
        
        return $next($request);
    }
}
