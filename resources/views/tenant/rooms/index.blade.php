@extends('frontend.layouts.master')

@section('title', 'Gestion des Chambres - {{ $tenant->name }}')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-0">
                    <i class="fas fa-bed me-2 text-primary"></i>
                    Gestion des Chambres
                </h2>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('tenant.dashboard', $tenant->subdomain ?? $tenant->id) }}">
                                Dashboard {{ $tenant->name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Chambres</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('tenant.rooms.create', $tenant->subdomain ?? $tenant->id) }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Nouvelle Chambre
            </a>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="card shadow border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0">
                <i class="fas fa-list me-2 text-info"></i>
                Liste des Chambres ({{ $rooms->total() }})
            </h5>
        </div>
        <div class="card-body">
            @if($rooms->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Numéro</th>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Capacité</th>
                                <th>Prix</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary">{{ $room->number }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $room->name ?? 'N/A' }}</strong>
                                        @if($room->view)
                                            <br><small class="text-muted"><i class="fas fa-mountain"></i> {{ $room->view }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $room->type->name ?? 'N/A' }}</td>
                                    <td>
                                        <i class="fas fa-users text-primary"></i>
                                        {{ $room->capacity }} pers.
                                    </td>
                                    <td>
                                        <strong>{{ number_format($room->price, 0, ',', ' ') }} FCFA</strong>
                                        @if($room->type && $room->type->base_price && $room->price != $room->type->base_price)
                                            <br><small class="text-warning">
                                                <i class="fas fa-exclamation-circle"></i> Prix personnalisé
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $room->roomStatus->color ?? 'secondary' }}">
                                            <i class="{{ $room->status_icon ?? 'fa-door-closed' }}"></i>
                                            {{ $room->roomStatus->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('tenant.rooms.show', [$tenant->subdomain ?? $tenant->id, $room->id]) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Voir les détails">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('tenant.rooms.edit', [$tenant->subdomain ?? $tenant->id, $room->id]) }}" 
                                               class="btn btn-sm btn-outline-warning" 
                                               title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" 
                                                  action="{{ route('tenant.rooms.destroy', [$tenant->subdomain ?? $tenant->id, $room->id]) }}"
                                                  onsubmit="return confirm('Supprimer la chambre {{ $room->number }}? Cette action est irréversible.')"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <small class="text-muted">
                            Affichage de {{ $rooms->firstItem() }} à {{ $rooms->lastItem() }} 
                            sur {{ $rooms->total() }} chambres
                        </small>
                    </div>
                    <div>
                        {{ $rooms->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-bed fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucune chambre trouvée</h4>
                    <p class="text-muted">Commencez par ajouter votre première chambre.</p>
                    <a href="{{ route('tenant.rooms.create', $tenant->subdomain ?? $tenant->id) }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Ajouter une chambre
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
