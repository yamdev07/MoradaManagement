@extends('frontend.layouts.master')

@section('title', 'Test Multitenant')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-building"></i>
                        Test du Système Multitenant
                    </h3>
                </div>
                <div class="card-body">
                    @if($tenant)
                        <div class="alert alert-success">
                            <h5><i class="fas fa-check-circle"></i> Connecté au Tenant</h5>
                            <strong>Nom:</strong> {{ $tenant->name }}<br>
                            <strong>ID:</strong> {{ $tenant->id }}<br>
                            <strong>Sous-domaine:</strong> {{ $tenant->subdomain ?? 'N/A' }}
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-exclamation-triangle"></i> Aucun Tenant</h5>
                            L'utilisateur n'est associé à aucun tenant.
                        </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-user"></i> Utilisateurs de ce Tenant</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">
                                        <small>Room::all() retourne seulement les utilisateurs du tenant courant grâce au global scope.</small>
                                    </p>
                                    @if($users->count() > 0)
                                        <ul class="list-group">
                                            @foreach($users as $user)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $user->name }}</strong><br>
                                                        <small class="text-muted">{{ $user->email }}</small>
                                                    </div>
                                                    <span class="badge bg-primary">{{ $user->role }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted">Aucun utilisateur trouvé pour ce tenant.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-bed"></i> Chambres de ce Tenant</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">
                                        <small>Room::all() retourne seulement les chambres du tenant courant grâce au global scope.</small>
                                    </p>
                                    @if($rooms->count() > 0)
                                        <ul class="list-group">
                                            @foreach($rooms as $room)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $room->name }}</strong><br>
                                                        <small class="text-muted">Chambre {{ $room->number }} - {{ $room->capacity }} pers.</small>
                                                    </div>
                                                    <span class="badge bg-success">{{ number_format($room->price, 0, ',', ' ') }} FCFA</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted">Aucune chambre trouvée pour ce tenant.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire de test de création -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-plus"></i> Test de Création Automatique</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">
                                        <small>Le trait BelongsToTenant devrait automatiquement assigner le tenant_id lors de la création.</small>
                                    </p>
                                    <form action="{{ route('multitenant.test.create-room') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Nom de la chambre</label>
                                                <input type="text" name="name" class="form-control" required>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Numéro</label>
                                                <input type="text" name="number" class="form-control" required>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Capacité</label>
                                                <input type="number" name="capacity" class="form-control" min="1" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Prix (FCFA)</label>
                                                <input type="number" name="price" class="form-control" min="0" step="100" required>
                                            </div>
                                            <div class="col-md-2">
                                                <label>&nbsp;</label><br>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Créer
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
