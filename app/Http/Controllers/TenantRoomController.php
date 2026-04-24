<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Type;
use App\Models\RoomStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TenantRoomController extends Controller
{
    /**
     * Afficher la liste des chambres du tenant
     */
    public function index(Request $request)
    {
        $tenant = Auth::user()->tenant;
        
        if (!$tenant) {
            abort(403, 'Vous n\'êtes pas associé à un tenant');
        }

        // Récupérer les chambres du tenant avec les relations
        $rooms = Room::where('tenant_id', $tenant->id)
            ->with(['type', 'roomStatus'])
            ->paginate(10);

        return view('tenant.rooms.index', [
            'rooms' => $rooms,
            'tenant' => $tenant
        ]);
    }

    /**
     * Afficher le formulaire de création de chambre
     */
    public function create()
    {
        $tenant = Auth::user()->tenant;
        
        if (!$tenant) {
            abort(403, 'Vous n\'êtes pas associé à un tenant');
        }

        $types = Type::all();
        $roomStatuses = RoomStatus::all();

        return view('tenant.rooms.create', [
            'types' => $types,
            'roomStatuses' => $roomStatuses,
            'tenant' => $tenant
        ]);
    }

    /**
     * Enregistrer une nouvelle chambre
     */
    public function store(Request $request)
    {
        $tenant = Auth::user()->tenant;
        
        if (!$tenant) {
            abort(403, 'Vous n\'êtes pas associé à un tenant');
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'type_id' => 'required|exists:types,id',
            'room_status_id' => 'required|exists:room_statuses,id',
            'number' => 'required|string|max:10|unique:rooms,number,NULL,id,tenant_id,' . $tenant->id,
            'name' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1|max:10',
            'price' => 'required|numeric|min:0',
            'view' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:1000',
            'size' => 'nullable|string|max:100',
        ], [
            'type_id.required' => 'Veuillez sélectionner un type de chambre',
            'room_status_id.required' => 'Veuillez sélectionner un statut',
            'number.required' => 'Le numéro de chambre est requis',
            'number.unique' => 'Ce numéro de chambre existe déjà pour votre hôtel',
            'capacity.required' => 'La capacité est requise',
            'price.required' => 'Le prix est requis',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Préparer les données avec le tenant_id
        $data = $validator->validated();
        $data['tenant_id'] = $tenant->id;

        // S'assurer que les champs vides sont null
        $data['view'] = $data['view'] ?? '';
        $data['name'] = empty($data['name']) ? null : $data['name'];
        $data['description'] = empty($data['description']) ? null : $data['description'];
        $data['size'] = empty($data['size']) ? null : $data['size'];

        // Créer la chambre
        $room = Room::create($data);

        return redirect()->route('tenant.rooms.index')
            ->with('success', 'Chambre ' . $room->number . ' créée avec succès!');
    }

    /**
     * Afficher les détails d'une chambre
     */
    public function show(Room $room)
    {
        $tenant = Auth::user()->tenant;
        
        if (!$tenant || $room->tenant_id !== $tenant->id) {
            abort(403, 'Accès non autorisé');
        }

        $room->load(['type', 'roomStatus']);

        return view('tenant.rooms.show', [
            'room' => $room,
            'tenant' => $tenant
        ]);
    }

    /**
     * Afficher le formulaire d'édition de chambre
     */
    public function edit(Room $room)
    {
        $tenant = Auth::user()->tenant;
        
        if (!$tenant || $room->tenant_id !== $tenant->id) {
            abort(403, 'Accès non autorisé');
        }

        $types = Type::all();
        $roomStatuses = RoomStatus::all();

        return view('tenant.rooms.edit', [
            'room' => $room,
            'types' => $types,
            'roomStatuses' => $roomStatuses,
            'tenant' => $tenant
        ]);
    }

    /**
     * Mettre à jour une chambre
     */
    public function update(Request $request, Room $room)
    {
        $tenant = Auth::user()->tenant;
        
        if (!$tenant || $room->tenant_id !== $tenant->id) {
            abort(403, 'Accès non autorisé');
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'type_id' => 'required|exists:types,id',
            'room_status_id' => 'required|exists:room_statuses,id',
            'number' => 'required|string|max:10|unique:rooms,number,' . $room->id . ',id,tenant_id,' . $tenant->id,
            'name' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1|max:10',
            'price' => 'required|numeric|min:0',
            'view' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:1000',
            'size' => 'nullable|string|max:100',
        ], [
            'type_id.required' => 'Veuillez sélectionner un type de chambre',
            'room_status_id.required' => 'Veuillez sélectionner un statut',
            'number.required' => 'Le numéro de chambre est requis',
            'number.unique' => 'Ce numéro de chambre existe déjà pour votre hôtel',
            'capacity.required' => 'La capacité est requise',
            'price.required' => 'Le prix est requis',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Préparer les données
        $data = $validator->validated();
        
        // S'assurer que les champs vides sont null
        $data['view'] = $data['view'] ?? '';
        $data['name'] = empty($data['name']) ? null : $data['name'];
        $data['description'] = empty($data['description']) ? null : $data['description'];
        $data['size'] = empty($data['size']) ? null : $data['size'];

        // Mettre à jour la chambre
        $room->update($data);

        return redirect()->route('tenant.rooms.index')
            ->with('success', 'Chambre ' . $room->number . ' mise à jour avec succès!');
    }

    /**
     * Supprimer une chambre
     */
    public function destroy(Room $room)
    {
        $tenant = Auth::user()->tenant;
        
        if (!$tenant || $room->tenant_id !== $tenant->id) {
            abort(403, 'Accès non autorisé');
        }

        // Vérifier si la chambre a des transactions actives
        if ($room->transactions()->where('status', 'active')->exists()) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer cette chambre car elle a des réservations actives.');
        }

        $roomNumber = $room->number;
        $room->delete();

        return redirect()->route('tenant.rooms.index')
            ->with('success', 'Chambre ' . $roomNumber . ' supprimée avec succès!');
    }
}
