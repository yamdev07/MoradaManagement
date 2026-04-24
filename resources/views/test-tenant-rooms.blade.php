@extends('frontend.layouts.master')

@section('title', 'Test Gestion des Chambres Tenant')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Test Système de Gestion des Chambres Tenant</h3>
                </div>
                <div class="card-body">
                    @if(Auth::user())
                        <div class="alert alert-info">
                            <h5><i class="fas fa-user"></i> Utilisateur Connecté</h5>
                            <p><strong>Nom:</strong> {{ Auth::user()->name }}</p>
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Tenant ID:</strong> {{ Auth::user()->tenant_id ?? 'Non associé' }}</p>
                        </div>
                        
                        @if(Auth::user()->tenant)
                            @php
                                $tenant = Auth::user()->tenant;
                            @endphp
                            <div class="alert alert-success">
                                <h5><i class="fas fa-building"></i> Tenant Associé</h5>
                                <p><strong>Nom:</strong> {{ $tenant->name }}</p>
                                <p><strong>ID:</strong> {{ $tenant->id }}</p>
                                <p><strong>Sous-domaine:</strong> {{ $tenant->subdomain ?? 'Non défini' }}</p>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6><i class="fas fa-cogs"></i> Actions de Gestion</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-grid gap-2">
                                                <a href="{{ route('tenant.dashboard', $tenant->subdomain ?? $tenant->id) }}" class="btn btn-primary">
                                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard Tenant
                                                </a>
                                                <a href="{{ route('tenant.rooms.index', $tenant->subdomain ?? $tenant->id) }}" class="btn btn-success">
                                                    <i class="fas fa-bed me-2"></i>Gérer les Chambres
                                                </a>
                                                <a href="{{ route('tenant.rooms.create', $tenant->subdomain ?? $tenant->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-plus me-2"></i>Créer une Chambre
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6><i class="fas fa-info-circle"></i> Informations Système</h6>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Routes disponibles:</strong></p>
                                            <ul>
                                                <li>GET /tenant/{{ $tenant->subdomain ?? $tenant->id }}/dashboard</li>
                                                <li>GET /tenant/{{ $tenant->subdomain ?? $tenant->id }}/rooms</li>
                                                <li>GET /tenant/{{ $tenant->subdomain ?? $tenant->id }}/rooms/create</li>
                                                <li>POST /tenant/{{ $tenant->subdomain ?? $tenant->id }}/rooms</li>
                                                <li>GET /tenant/{{ $tenant->subdomain ?? $tenant->id }}/rooms/{id}</li>
                                                <li>GET /tenant/{{ $tenant->subdomain ?? $tenant->id }}/rooms/{id}/edit</li>
                                                <li>PUT /tenant/{{ $tenant->subdomain ?? $tenant->id }}/rooms/{id}</li>
                                                <li>DELETE /tenant/{{ $tenant->subdomain ?? $tenant->id }}/rooms/{id}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @php
                                $rooms = \App\Models\Room::where('tenant_id', $tenant->id)->with(['type', 'roomStatus'])->get();
                            @endphp
                            
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h6><i class="fas fa-list"></i> Chambres du Tenant ({{ $rooms->count() }})</h6>
                                </div>
                                <div class="card-body">
                                    @if($rooms->count() > 0)
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Numéro</th>
                                                    <th>Nom</th>
                                                    <th>Type</th>
                                                    <th>Statut</th>
                                                    <th>Prix</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($rooms as $room)
                                                    <tr>
                                                        <td>{{ $room->number }}</td>
                                                        <td>{{ $room->name ?? 'N/A' }}</td>
                                                        <td>{{ $room->type->name ?? 'N/A' }}</td>
                                                        <td>
                                                            <span class="badge badge-{{ $room->roomStatus->color ?? 'secondary' }}">
                                                                {{ $room->roomStatus->name ?? 'N/A' }}
                                                            </span>
                                                        </td>
                                                        <td>{{ number_format($room->price, 0, ',', ' ') }} FCFA</td>
                                                        <td>
                                                            <a href="{{ route('tenant.rooms.show', [$tenant->subdomain ?? $tenant->id, $room->id]) }}" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('tenant.rooms.edit', [$tenant->subdomain ?? $tenant->id, $room->id]) }}" class="btn btn-sm btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-bed fa-3x text-muted mb-3"></i>
                                            <h5>Aucune chambre trouvée</h5>
                                            <p class="text-muted">Commencez par créer votre première chambre.</p>
                                            <a href="{{ route('tenant.rooms.create', $tenant->subdomain ?? $tenant->id) }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-2"></i>Créer une chambre
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <h5><i class="fas fa-exclamation-triangle"></i> Aucun Tenant Associé</h5>
                                <p>L'utilisateur connecté n'est associé à aucun tenant.</p>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-danger">
                            <h5><i class="fas fa-sign-in-alt"></i> Non Connecté</h5>
                            <p>Veuillez vous connecter pour tester le système.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
