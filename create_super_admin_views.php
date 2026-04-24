<?php

// Création des vues pour le dashboard Super Admin avec gestion des hôtels

echo "🏨 Création des vues Super Admin pour les hôtels\n\n";

try {
    // 1. Créer le layout Super Admin
    $layoutContent = <<<'LAYOUT'
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Super Admin Dashboard') - Morada Management</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px 12px 0 0 !important;
        }
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
        .status-pending {
            background: #ffc107;
            color: #000;
        }
        .status-active {
            background: #28a745;
            color: white;
        }
        .status-inactive {
            background: #dc3545;
            color: white;
        }
        .stats-card {
            border-left: 4px solid;
            transition: transform 0.3s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .stats-card.primary {
            border-left-color: #007bff;
        }
        .stats-card.warning {
            border-left-color: #ffc107;
        }
        .stats-card.success {
            border-left-color: #28a745;
        }
        .stats-card.info {
            border-left-color: #17a2b8;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">
                            <i class="fas fa-crown"></i> Super Admin
                        </h4>
                        <small class="text-white-50">Morada Management</small>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('super-admin/dashboard') ? 'active' : '' }}" 
                               href="{{ route('super-admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('super-admin/tenants*') ? 'active' : '' }}" 
                               href="{{ route('super-admin.tenants') }}">
                                <i class="fas fa-hotel"></i> Hôtels
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('super-admin/users*') ? 'active' : '' }}" 
                               href="{{ route('super-admin.users') }}">
                                <i class="fas fa-users"></i> Utilisateurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('super-admin/reservations*') ? 'active' : '' }}" 
                               href="{{ route('super-admin.reservations') }}">
                                <i class="fas fa-calendar-check"></i> Réservations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('super-admin/maintenance*') ? 'active' : '' }}" 
                               href="{{ route('super-admin.maintenance') }}">
                                <i class="fas fa-tools"></i> Maintenance
                            </a>
                        </li>
                    </ul>
                    
                    <hr class="text-white-50">
                    
                    <div class="text-white-50 px-3 py-2">
                        <small>
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}<br>
                            <i class="fas fa-envelope"></i> {{ Auth::user()->email }}
                        </small>
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title', 'Dashboard')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @stack('scripts')
</body>
</html>
LAYOUT;

    // Créer le répertoire des vues superadmin
    $viewDir = 'resources/views/superadmin';
    if (!is_dir($viewDir)) {
        mkdir($viewDir, 0755, true);
    }

    // Sauvegarder le layout
    file_put_contents($viewDir . '/layout.blade.php', $layoutContent);
    echo "✅ Layout Super Admin créé\n";

    // 2. Créer la vue dashboard améliorée
    $dashboardContent = <<<'DASHBOARD'
@extends('superadmin.layout')

@section('title', 'Dashboard Super Admin')

@section('content')
<div class="container-fluid">
    <!-- Statistiques principales -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Hôtels</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTenants }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hotel fa-2x text-primary opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card warning h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                En attente</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTenants }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-warning opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Revenus</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalRevenue, 0, ',', ' ') }} FCFA</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-success opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card info h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Utilisateurs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hôtels en attente -->
    @if($pendingTenantsList->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0">
                        <i class="fas fa-exclamation-triangle"></i> Hôtels en attente de validation
                    </h6>
                    <span class="badge bg-warning">{{ $pendingTenantsList->count() }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom de l'hôtel</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Administrateur</th>
                                    <th>Date d'inscription</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingTenantsList as $tenant)
                                <tr>
                                    <td>
                                        <strong>{{ $tenant['name'] }}</strong>
                                        @if($tenant['logo'])
                                            <img src="{{ asset('storage/' . $tenant['logo']) }}" 
                                                 alt="Logo" class="ms-2" style="width: 30px; height: 30px; border-radius: 4px;">
                                        @endif
                                    </td>
                                    <td>{{ $tenant['email'] }}</td>
                                    <td>{{ $tenant['phone'] }}</td>
                                    <td>
                                        <div>
                                            <strong>{{ $tenant['admin_user']->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $tenant['admin_user']->email }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $tenant['created_at'] }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('super-admin.tenants.show', $tenant['id']) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                            <form action="{{ route('super-admin.tenants.approve', $tenant['id']) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success"
                                                        onclick="return confirm('Approuver cet hôtel ?')">
                                                    <i class="fas fa-check"></i> Approuver
                                                </button>
                                            </form>
                                            <form action="{{ route('super-admin.tenants.reject', $tenant['id']) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Rejeter cet hôtel ?')">
                                                    <i class="fas fa-times"></i> Rejeter
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Top Hôtels et Statistiques -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0">
                        <i class="fas fa-chart-bar"></i> Top 5 Hôtels par Revenus
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0">
                        <i class="fas fa-chart-pie"></i> Distribution des Rôles
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="roleChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Graphique des revenus
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: @json($topTenantsByRevenue->pluck('name')),
            datasets: [{
                label: 'Revenus (FCFA)',
                data: @json($topTenantsByRevenue->pluck('revenue')),
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('fr-FR').format(value) + ' FCFA';
                        }
                    }
                }
            }
        }
    });

    // Graphique des rôles
    const roleCtx = document.getElementById('roleChart').getContext('2d');
    new Chart(roleCtx, {
        type: 'doughnut',
        data: {
            labels: @json($roleStats->keys()),
            datasets: [{
                data: @json($roleStats->values()),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(255, 99, 132, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endpush
DASHBOARD;

    file_put_contents($viewDir . '/dashboard.blade.php', $dashboardContent);
    echo "✅ Vue dashboard créée\n";

    // 3. Créer la vue des hôtels
    $tenantsContent = <<<'TENANTS'
@extends('superadmin.layout')

@section('title', 'Gestion des Hôtels')

@section('content')
<div class="container-fluid">
    <!-- Filtres -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Rechercher un hôtel..." 
                                   value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">Tous les statuts</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                    Actifs
                                </option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                    En attente
                                </option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                    Inactifs
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Rechercher
                            </button>
                            <a href="{{ route('super-admin.tenants') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-redo"></i> Réinitialiser
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des hôtels -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0">
                        <i class="fas fa-hotel"></i> Liste des Hôtels
                    </h6>
                    <span class="badge bg-primary">{{ $tenants->total() }} hôtels</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Hôtel</th>
                                    <th>Contact</th>
                                    <th>Statut</th>
                                    <th>Statistiques</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tenants as $tenant)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($tenant->logo)
                                                <img src="{{ asset('storage/' . $tenant->logo) }}" 
                                                     alt="Logo" class="me-3" style="width: 50px; height: 50px; border-radius: 8px;">
                                            @endif
                                            <div>
                                                <strong>{{ $tenant->name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $tenant->domain }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <i class="fas fa-envelope"></i> {{ $tenant->email }}
                                            <br>
                                            <i class="fas fa-phone"></i> {{ $tenant->phone }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($tenant->is_active)
                                            <span class="badge badge-status status-active">
                                                <i class="fas fa-check-circle"></i> Actif
                                            </span>
                                        @else
                                            <span class="badge badge-status status-pending">
                                                <i class="fas fa-clock"></i> En attente
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small">
                                            <div><i class="fas fa-users"></i> {{ $tenant->users->count() }} utilisateurs</div>
                                            <div><i class="fas fa-bed"></i> {{ $tenant->rooms->count() }} chambres</div>
                                            <div><i class="fas fa-calendar-check"></i> {{ $tenant->transactions->count() }} réservations</div>
                                            <div><i class="fas fa-dollar-sign"></i> {{ number_format($tenant->transactions->sum('total_price'), 0, ',', ' ') }} FCFA</div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $tenant->created_at->format('d/m/Y') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('super-admin.tenants.show', $tenant->id) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(!$tenant->is_active)
                                                <form action="{{ route('super-admin.tenants.approve', $tenant->id) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                            onclick="return confirm('Approuver cet hôtel ?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('super-admin.tenants.toggle', $tenant->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning"
                                                        onclick="return confirm('Changer le statut ?')">
                                                    <i class="fas fa-toggle-on"></i>
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
                            Affichage de {{ $tenants->firstItem() }} à {{ $tenants->lastItem() }} 
                            sur {{ $tenants->total() }} résultats
                        </div>
                        <div>
                            {{ $tenants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
TENANTS;

    file_put_contents($viewDir . '/tenants.blade.php', $tenantsContent);
    echo "✅ Vue des hôtels créée\n";

    echo "\n🎯 Vues Super Admin créées avec succès !\n";
    echo "   - Layout moderne avec sidebar\n";
    echo "   - Dashboard avec statistiques et hôtels en attente\n";
    echo "   - Gestion complète des hôtels\n";
    echo "   - Interface responsive et intuitive\n\n";

    echo "🚀 Accès au dashboard:\n";
    echo "   URL: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "   Email: superadmin@hotelio.com\n";
    echo "   Mot de passe: superadmin123\n\n";

} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
