@extends('template.master')

@section('title', 'Accueil - ' . ($currentTenant->name ?? 'CHECK-SYS'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-home me-2"></i>
                        Bienvenue sur {{ $currentTenant->name ?? 'CHECK-SYS' }}
                    </h5>
                </div>
                <div class="card-body">
                    @if($currentTenant)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-hotel me-2"></i>Informations du Tenant</h6>
                                    <p><strong>Nom:</strong> {{ $currentTenant->name }}</p>
                                    <p><strong>Sous-domaine:</strong> {{ $currentTenant->subdomain }}</p>
                                    <p><strong>Statut:</strong> 
                                        @if($currentTenant->is_active)
                                            <span class="badge bg-success">Actif</span>
                                        @else
                                            <span class="badge bg-danger">Inactif</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-primary">
                                    <h6><i class="fas fa-tachometer-alt me-2"></i>Actions Rapides</h6>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('dashboard.index', ['hotel_id' => $currentTenant->id]) }}" class="btn btn-primary">
                                            <i class="fas fa-chart-line me-2"></i>Tableau de bord
                                        </a>
                                        @if(auth()->user() && auth()->user()->role === 'Super')
                                        <a href="{{ route('super-admin.dashboard') }}" class="btn btn-secondary">
                                            <i class="fas fa-cogs me-2"></i>Administration
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6><i class="fas fa-th-large me-2"></i>Modules Disponibles</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        <i class="fas fa-bed fa-2x text-primary mb-2"></i>
                                                        <h6>Chambres</h6>
                                                        <a href="/tenant/{{$currentTenant->subdomain}}/rooms" class="btn btn-sm btn-outline-primary">Gérer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        <i class="fas fa-users fa-2x text-success mb-2"></i>
                                                        <h6>Clients</h6>
                                                        <a href="/tenant/{{$currentTenant->subdomain}}/customers" class="btn btn-sm btn-outline-success">Gérer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        <i class="fas fa-calendar-check fa-2x text-info mb-2"></i>
                                                        <h6>Réservations</h6>
                                                        <a href="/tenant/{{$currentTenant->subdomain}}/transactions" class="btn btn-sm btn-outline-info">Gérer</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        <i class="fas fa-utensils fa-2x text-warning mb-2"></i>
                                                        <h6>Restaurant</h6>
                                                        <a href="/hotel/restaurant" class="btn btn-sm btn-outline-warning">Gérer</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Aucun Tenant Sélectionné</h5>
                            <p>Veuillez vous connecter avec un tenant spécifique ou retourner à la page d'accueil.</p>
                            <div class="mt-3">
                                <a href="/" class="btn btn-primary">
                                    <i class="fas fa-home me-2"></i>Retour à l'accueil
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
