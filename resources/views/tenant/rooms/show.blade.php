@extends('frontend.layouts.master')

@section('title', 'Détails de la Chambre {{ $room->number }} - {{ $tenant->name }}')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-0">
                    <i class="fas fa-bed me-2 text-primary"></i>
                    Chambre {{ $room->number }}
                    @if($room->name)
                        <small class="text-muted">- {{ $room->name }}</small>
                    @endif
                </h2>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('tenant.dashboard', $tenant->subdomain ?? $tenant->id) }}">
                                Dashboard {{ $tenant->name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('tenant.rooms.index', $tenant->subdomain ?? $tenant->id) }}">
                                Chambres
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $room->number }}</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('tenant.rooms.edit', [$tenant->subdomain ?? $tenant->id, $room->id]) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-2"></i>Modifier
                </a>
                <a href="{{ route('tenant.rooms.index', $tenant->subdomain ?? $tenant->id) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour
                </a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2 text-info"></i>
                        Informations Générales
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Numéro:</strong></td>
                                    <td>
                                        <span class="badge bg-primary fs-6">{{ $room->number }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Nom:</strong></td>
                                    <td>{{ $room->name ?? 'Non défini' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Type:</strong></td>
                                    <td>
                                        <span class="badge bg-info">{{ $room->type->name ?? 'N/A' }}</span>
                                        @if($room->type && $room->type->base_price)
                                            <br><small class="text-muted">Prix de base: {{ number_format($room->type->base_price, 0, ',', ' ') }} FCFA</small>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Statut:</strong></td>
                                    <td>
                                        <span class="badge badge-{{ $room->roomStatus->color ?? 'secondary' }}">
                                            <i class="{{ $room->status_icon ?? 'fa-door-closed' }}"></i>
                                            {{ $room->roomStatus->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Capacité:</strong></td>
                                    <td>
                                        <i class="fas fa-users text-primary"></i>
                                        {{ $room->capacity }} personne(s)
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Prix:</strong></td>
                                    <td>
                                        <span class="text-success fw-bold">{{ number_format($room->price, 0, ',', ' ') }} FCFA</span>
                                        @if($room->type && $room->type->base_price && $room->price != $room->type->base_price)
                                            <br><small class="text-warning">
                                                <i class="fas fa-exclamation-circle"></i> Prix personnalisé
                                            </small>
                                        @endif
                                    </td>
                                </tr>
                                @if($room->view)
                                <tr>
                                    <td><strong>Vue:</strong></td>
                                    <td>
                                        <i class="fas fa-mountain text-primary"></i>
                                        {{ $room->view }}
                                    </td>
                                </tr>
                                @endif
                                @if($room->size)
                                <tr>
                                    <td><strong>Surface:</strong></td>
                                    <td>
                                        <i class="fas fa-ruler-combined text-primary"></i>
                                        {{ $room->size }}
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    
                    @if($room->description)
                    <div class="mt-4">
                        <h6><i class="fas fa-align-left me-2 text-primary"></i>Description</h6>
                        <div class="alert alert-light">
                            {{ $room->description }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Transactions actives -->
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-check me-2 text-success"></i>
                        Réservations Actuelles
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $activeTransactions = $room->transactions()
                            ->with('customer')
                            ->where('status', 'active')
                            ->orWhere('status', 'reservation')
                            ->orderBy('check_in', 'asc')
                            ->get();
                    @endphp
                    
                    @if($activeTransactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Client</th>
                                        <th>Date d'arrivée</th>
                                        <th>Date de départ</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activeTransactions as $transaction)
                                        <tr>
                                            <td>
                                                <strong>{{ $transaction->customer->name ?? 'N/A' }}</strong>
                                                @if($transaction->customer->email)
                                                    <br><small class="text-muted">{{ $transaction->customer->email }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $transaction->check_in->format('d/m/Y') }}</td>
                                            <td>{{ $transaction->check_out->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge badge-{{ $transaction->status == 'active' ? 'success' : 'warning' }}">
                                                    {{ $transaction->status == 'active' ? 'En cours' : 'Réservée' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-2x text-muted mb-3"></i>
                            <p class="text-muted">Aucune réservation active pour cette chambre.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Carte d'information du tenant -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-building me-2 text-primary"></i>
                        Informations de l'Hôtel
                    </h5>
                </div>
                <div class="card-body">
                    <p><strong>Nom:</strong> {{ $tenant->name }}</p>
                    <p><strong>ID:</strong> {{ $tenant->id }}</p>
                    @if($tenant->subdomain)
                        <p><strong>Sous-domaine:</strong> {{ $tenant->subdomain }}</p>
                    @endif
                    <div class="alert alert-success">
                        <small>
                            <i class="fas fa-shield-alt"></i>
                            Cette chambre appartient exclusivement à votre hôtel.
                        </small>
                    </div>
                </div>
            </div>
            
            <!-- Actions rapides -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2 text-warning"></i>
                        Actions Rapides
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('tenant.rooms.edit', [$tenant->subdomain ?? $tenant->id, $room->id]) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Modifier la chambre
                        </a>
                        
                        @if(!$room->transactions()->where('status', 'active')->exists())
                            <form method="POST" 
                                  action="{{ route('tenant.rooms.destroy', [$tenant->subdomain ?? $tenant->id, $room->id]) }}"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette chambre? Cette action est irréversible.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-trash me-2"></i>Supprimer la chambre
                                </button>
                            </form>
                        @else
                            <button class="btn btn-danger w-100" disabled>
                                <i class="fas fa-trash me-2"></i>Suppression impossible
                            </button>
                            <small class="text-muted">
                                La chambre a des réservations actives
                            </small>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Statistiques -->
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar me-2 text-info"></i>
                        Statistiques
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $totalTransactions = $room->transactions()->count();
                        $completedTransactions = $room->transactions()->where('status', 'completed')->count();
                        $activeTransactions = $room->transactions()->where('status', 'active')->count();
                        $reservationTransactions = $room->transactions()->where('status', 'reservation')->count();
                    @endphp
                    
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="border rounded p-2">
                                <h4 class="text-primary mb-0">{{ $totalTransactions }}</h4>
                                <small class="text-muted">Total</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="border rounded p-2">
                                <h4 class="text-success mb-0">{{ $completedTransactions }}</h4>
                                <small class="text-muted">Terminées</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="border rounded p-2">
                                <h4 class="text-info mb-0">{{ $activeTransactions }}</h4>
                                <small class="text-muted">En cours</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="border rounded p-2">
                                <h4 class="text-warning mb-0">{{ $reservationTransactions }}</h4>
                                <small class="text-muted">Réservées</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
