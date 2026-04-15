@extends('template.master')
@section('title', $tenant->name . ' - Dashboard')

@section('content')
<div class="tenant-dashboard">
    <!-- Header Tenant -->
    <div class="tenant-header" style="background: linear-gradient(135deg, {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }} 0%, {{ $tenant->theme_settings['secondary_color'] ?? '#3498db' }} 100%); color: white; padding: 2rem; border-radius: 12px; margin-bottom: 2rem;">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    @if($tenant->logo)
                        <img src="{{ asset('storage/' . $tenant->logo) }}" alt="{{ $tenant->name }}" style="height: 60px; width: auto; border-radius: 8px; margin-right: 1rem;">
                    @else
                        <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                            <i class="fas fa-hotel fa-2x"></i>
                        </div>
                    @endif
                    <div>
                        <h1 class="h3 mb-1">{{ $tenant->name }}</h1>
                        <p class="mb-0 opacity-75">{{ $tenant->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <div class="tenant-info">
                    <span class="badge bg-white text-dark me-2">
                        <i class="fas fa-door-open me-1"></i> {{ $stats['totalRooms'] }} Chambres
                    </span>
                    <span class="badge bg-white text-dark me-2">
                        <i class="fas fa-users me-1"></i> {{ $stats['activeTransactions'] }} Actifs
                    </span>
                    <span class="badge bg-white text-dark">
                        <i class="fas fa-user-tie me-1"></i> {{ $stats['totalCustomers'] }} Clients
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }} !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Chambres Totales</h6>
                            <h3 class="card-title mb-0">{{ $stats['totalRooms'] }}</h3>
                        </div>
                        <div style="width: 50px; height: 50px; background: {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }}20; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-door-open fa-lg" style="color: {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }};"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid {{ $tenant->theme_settings['secondary_color'] ?? '#3498db' }} !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Chambres Disponibles</h6>
                            <h3 class="card-title mb-0">{{ $stats['availableRooms'] }}</h3>
                        </div>
                        <div style="width: 50px; height: 50px; background: {{ $tenant->theme_settings['secondary_color'] ?? '#3498db' }}20; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-door-closed fa-lg" style="color: {{ $tenant->theme_settings['secondary_color'] ?? '#3498db' }};"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid {{ $tenant->theme_settings['accent_color'] ?? '#f39c12' }} !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Chambres Occupées</h6>
                            <h3 class="card-title mb-0">{{ $stats['occupiedRooms'] }}</h3>
                        </div>
                        <div style="width: 50px; height: 50px; background: {{ $tenant->theme_settings['accent_color'] ?? '#f39c12' }}20; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-door-open fa-lg" style="color: {{ $tenant->theme_settings['accent_color'] ?? '#f39c12' }};"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #28a745 !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Transactions Aujourd'hui</h6>
                            <h3 class="card-title mb-0">{{ $stats['todayTransactions'] }}</h3>
                        </div>
                        <div style="width: 50px; height: 50px; background: #28a74520; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-calendar-day fa-lg" style="color: #28a745;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Récentes -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-history me-2" style="color: {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }};"></i>
                    Transactions Récentes
                </h5>
                <a href="{{ route('tenant.transactions', $tenant->id) }}" class="btn btn-sm" style="background: {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }}; color: white; border: none;">
                    Voir tout
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($recentTransactions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Chambre</th>
                                <th>Montant</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $transaction)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 12px;">
                                                {{ strtoupper(substr($transaction->customer->name ?? 'N/A', 0, 2)) }}
                                            </div>
                                            <span>{{ $transaction->customer->name ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $transaction->room->number ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($transaction->total_amount ?? 0, 0, ',', ' ') }} FCFA</strong>
                                    </td>
                                    <td>
                                        @switch($transaction->status)
                                            @case('active')
                                                <span class="badge bg-success">Actif</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-primary">Terminé</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-danger">Annulé</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $transaction->status }}</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h6 class="text-muted">Aucune transaction récente</h6>
                    <p class="text-muted">Les transactions de {{ $tenant->name }} apparaîtront ici.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Navigation Rapide -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title mb-3">Navigation Rapide - {{ $tenant->name }}</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('tenant.rooms', $tenant->id) }}" class="btn btn-outline-primary w-100 mb-2">
                                <i class="fas fa-door-open me-2"></i> Chambres
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('tenant.transactions', $tenant->id) }}" class="btn btn-outline-primary w-100 mb-2">
                                <i class="fas fa-exchange-alt me-2"></i> Transactions
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('tenant.customers', $tenant->id) }}" class="btn btn-outline-primary w-100 mb-2">
                                <i class="fas fa-users me-2"></i> Clients
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('frontend.home') }}?hotel_id={{ $tenant->id }}" target="_blank" class="btn btn-outline-success w-100 mb-2">
                                <i class="fas fa-external-link-alt me-2"></i> Site Web
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tenant-dashboard {
    padding: 2rem;
}

.tenant-header {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.card {
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge {
    font-size: 0.75rem;
}
</style>
@endsection
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total_users'] }}</h3>
                    <p>Utilisateurs</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('tenant.users', ['subdomain' => $tenant->subdomain]) }}" class="small-box-footer" target="_self">
                    Voir tout <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['total_rooms'] }}</h3>
                    <p>Chambres</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bed"></i>
                </div>
                <a href="{{ route('tenant.rooms', ['subdomain' => $tenant->subdomain]) }}" class="small-box-footer" target="_self">
                    Voir tout <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['total_customers'] }}</h3>
                    <p>Clients</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Voir tout <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ number_format($stats['total_transactions'], 0) }}</h3>
                    <p>Transactions</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ route('tenant.transactions', ['subdomain' => $tenant->subdomain]) }}" class="small-box-footer" target="_self">
                    Voir tout <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Graphiques et informations détaillées -->
    <div class="row">
        <!-- Revenus et taux d'occupation -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        Performance
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">{{ number_format($stats['total_revenue'], 0, ',', ' ') }} FCFA</h5>
                                <span class="description-text">Revenus totaux</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="description-block">
                                <h5 class="description-header">{{ $stats['occupancy_rate'] }}%</h5>
                                <span class="description-text">Taux d'occupation</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transactions récentes -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-shopping-bag"></i>
                        Transactions récentes
                    </h3>
                </div>
                <div class="card-body">
                    @if($stats['recent_transactions']->count() > 0)
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            @foreach($stats['recent_transactions'] as $transaction)
                                <li class="item">
                                    <div class="product-img">
                                        <i class="fas fa-receipt"></i>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-title">
                                            {{ $transaction->customer->name ?? 'Client inconnu' }}
                                            <span class="badge badge-info float-right">
                                                {{ number_format($transaction->amount, 0, ',', ' ') }} FCFA
                                            </span>
                                        </a>
                                        <span class="product-description">
                                            {{ $transaction->created_at->format('d/m/Y H:i') }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Aucune transaction récente</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Utilisateurs récents -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i>
                        Utilisateurs récents
                    </h3>
                </div>
                <div class="card-body">
                    @if($stats['recent_users']->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Date d'inscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['recent_users'] as $recentUser)
                                    <tr>
                                        <td>{{ $recentUser->name }}</td>
                                        <td>{{ $recentUser->email }}</td>
                                        <td>
                                            <span class="badge badge-{{ $recentUser->role == 'Admin' ? 'danger' : ($recentUser->role == 'Receptionist' ? 'warning' : 'info') }}">
                                                {{ $recentUser->role }}
                                            </span>
                                        </td>
                                        <td>{{ $recentUser->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Aucun utilisateur récent</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Information sur le sous-domaine -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle"></i> Accès par URL</h5>
                        <p class="mb-0">
                            Votre entreprise est accessible via l'URL : <strong>{{ request()->url() }}</strong><br>
                            Chaque tenant a son propre espace isolé avec ses propres données.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
