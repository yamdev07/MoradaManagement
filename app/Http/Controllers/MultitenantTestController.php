<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultitenantTestController extends Controller
{
    /**
     * Afficher un tableau de bord pour tester le multitenant
     */
    public function dashboard()
    {
        $user = Auth::user();
        $tenant = $user->tenant;
        
        // Ces requêtes devraient automatiquement filtrer par tenant grâce au global scope
        $users = User::all(); // Seulement les users du tenant courant
        $rooms = Room::all(); // Seulement les rooms du tenant courant
        
        return view('multitenant.test', compact('user', 'tenant', 'users', 'rooms'));
    }
    
    /**
     * Créer une room de test (devrait automatiquement avoir le tenant_id)
     */
    public function createRoom(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
        
        // Le tenant_id devrait être automatiquement assigné par le trait BelongsToTenant
        $room = Room::create($request->all());
        
        return redirect()->back()->with('success', "Chambre créée avec tenant_id: {$room->tenant_id}");
    }
}
