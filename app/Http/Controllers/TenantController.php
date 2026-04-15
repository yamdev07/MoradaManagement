<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    /**
     * Afficher le dashboard isolé du tenant
     */
    public function dashboard($tenantIdentifier)
    {
        // Récupérer le tenant par ID ou domaine
        $tenant = Tenant::where('id', $tenantIdentifier)
            ->orWhere('domain', $tenantIdentifier)
            ->orWhere('subdomain', $tenantIdentifier)
            ->firstOrFail();
            
        // Mettre en session
        session(['selected_hotel_id' => $tenant->id]);
        
        // Statistiques isolées pour ce tenant
        $stats = [
            'totalRooms' => Room::where('hotel_id', $tenant->id)->count(),
            'availableRooms' => Room::where('hotel_id', $tenant->id)->where('status', 'available')->count(),
            'occupiedRooms' => Room::where('hotel_id', $tenant->id)->where('status', 'occupied')->count(),
            'activeTransactions' => Transaction::where('hotel_id', $tenant->id)->where('status', 'active')->count(),
            'todayTransactions' => Transaction::where('hotel_id', $tenant->id)
                ->whereDate('created_at', today())->count(),
            'totalCustomers' => Customer::whereHas('transactions', function($query) use ($tenant) {
                $query->where('hotel_id', $tenant->id);
            })->count(),
        ];
        
        // Transactions récentes du tenant
        $recentTransactions = Transaction::where('hotel_id', $tenant->id)
            ->with(['customer', 'room'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        return view('tenant.dashboard', compact('tenant', 'stats', 'recentTransactions'));
    }
    
    /**
     * Afficher les chambres du tenant
     */
    public function rooms($tenantIdentifier)
    {
        $tenant = Tenant::where('id', $tenantIdentifier)
            ->orWhere('domain', $tenantIdentifier)
            ->orWhere('subdomain', $tenantIdentifier)
            ->firstOrFail();
            
        session(['selected_hotel_id' => $tenant->id]);
        
        $rooms = Room::where('hotel_id', $tenant->id)
            ->with(['type', 'transactions'])
            ->orderBy('number')
            ->paginate(20);
            
        return view('tenant.rooms', compact('tenant', 'rooms'));
    }
    
    /**
     * Afficher les transactions du tenant
     */
    public function transactions($tenantIdentifier, Request $request)
    {
        $tenant = Tenant::where('id', $tenantIdentifier)
            ->orWhere('domain', $tenantIdentifier)
            ->orWhere('subdomain', $tenantIdentifier)
            ->firstOrFail();
            
        session(['selected_hotel_id' => $tenant->id]);
        
        $query = Transaction::where('hotel_id', $tenant->id)
            ->with(['customer', 'room']);
            
        // Filtrage
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->date_filter) {
            switch ($request->date_filter) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                    break;
            }
        }
        
        $transactions = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('tenant.transactions', compact('tenant', 'transactions'));
    }
    
    /**
     * Afficher les clients du tenant
     */
    public function customers($tenantIdentifier)
    {
        $tenant = Tenant::where('id', $tenantIdentifier)
            ->orWhere('domain', $tenantIdentifier)
            ->orWhere('subdomain', $tenantIdentifier)
            ->firstOrFail();
            
        session(['selected_hotel_id' => $tenant->id]);
        
        $customers = Customer::whereHas('transactions', function($query) use ($tenant) {
                $query->where('hotel_id', $tenant->id);
            })
            ->with(['transactions' => function($query) use ($tenant) {
                $query->where('hotel_id', $tenant->id)->latest();
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('tenant.customers', compact('tenant', 'customers'));
    }
    
    /**
     * Page d'accueil du tenant
     */
    public function home($tenantIdentifier)
    {
        $tenant = Tenant::where('id', $tenantIdentifier)
            ->orWhere('domain', $tenantIdentifier)
            ->orWhere('subdomain', $tenantIdentifier)
            ->firstOrFail();
            
        session(['selected_hotel_id' => $tenant->id]);
        
        return view('tenant.home', compact('tenant'));
    }
    
    /**
     * API pour récupérer les infos du tenant
     */
    public function apiInfo($tenantIdentifier)
    {
        $tenant = Tenant::where('id', $tenantIdentifier)
            ->orWhere('domain', $tenantIdentifier)
            ->orWhere('subdomain', $tenantIdentifier)
            ->firstOrFail();
            
        return response()->json([
            'id' => $tenant->id,
            'name' => $tenant->name,
            'domain' => $tenant->domain,
            'subdomain' => $tenant->subdomain,
            'description' => $tenant->description,
            'logo' => $tenant->logo,
            'theme_settings' => $tenant->theme_settings,
            'is_active' => $tenant->is_active,
            'stats' => [
                'rooms' => Room::where('hotel_id', $tenant->id)->count(),
                'active_transactions' => Transaction::where('hotel_id', $tenant->id)
                    ->where('status', 'active')->count(),
                'customers' => Customer::whereHas('transactions', function($query) use ($tenant) {
                    $query->where('hotel_id', $tenant->id);
                })->count(),
            ]
        ]);
    }
}
