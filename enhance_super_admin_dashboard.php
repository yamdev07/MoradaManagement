<?php

// Amélioration du dashboard Super Admin avec fonctionnalités complètes

echo "🚀 Amélioration du dashboard Super Admin\n\n";

try {
    // 1. Créer la vue du dashboard amélioré
    $dashboardView = <<<'VIEW'
@extends('layouts.superadmin')

@section('title', 'Dashboard Super Admin')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Super Admin</h1>
        <div class="text-right">
            <span class="text-gray-600">Bienvenue, {{ Auth::user()->name }}</span>
            <span class="badge badge-success ml-2">Super Admin</span>
        </div>
    </div>

    <!-- Statistiques principales -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Hôtels</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTenants }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hotel fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                En attente</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTenants }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Revenus</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalRevenue, 0, ',', ' ') }} FCFA</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Utilisateurs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Actions Rapides</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('superadmin.tenants.index') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-hotel"></i> Gérer les Hôtels
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('superadmin.users.index') }}" class="btn btn-info btn-block">
                                <i class="fas fa-users"></i> Gérer les Utilisateurs
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('superadmin.reservations.index') }}" class="btn btn-success btn-block">
                                <i class="fas fa-calendar-check"></i> Réservations
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('superadmin.maintenance.index') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-tools"></i> Maintenance
                            </a>
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
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-warning">Hôtels en attente de validation</h6>
                    <span class="badge badge-warning">{{ $pendingTenantsList->count() }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="pendingTenantsTable">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Admin</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingTenantsList as $tenant)
                                <tr>
                                    <td>{{ $tenant['name'] }}</td>
                                    <td>{{ $tenant['email'] }}</td>
                                    <td>{{ $tenant['phone'] }}</td>
                                    <td>{{ $tenant['admin_user']->name }} ({{ $tenant['admin_user']->email }})</td>
                                    <td>{{ $tenant['created_at'] }}</td>
                                    <td>
                                        <a href="{{ route('superadmin.tenants.show', $tenant['id']) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                        <a href="{{ route('superadmin.tenants.approve', $tenant['id']) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i> Approuver
                                        </a>
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

    <!-- Top Hôtels -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top Hôtels par Revenus</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistiques par Rôle</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="roleChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Super Admin
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Admin
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Manager
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Customer
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique des revenus
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
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
    const roleChart = new Chart(roleCtx, {
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
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endpush
VIEW;

    // Créer le répertoire si nécessaire
    $viewDir = 'resources/views/superadmin';
    if (!is_dir($viewDir)) {
        mkdir($viewDir, 0755, true);
        echo "✅ Répertoire superadmin créé\n";
    }

    // Sauvegarder la vue
    file_put_contents($viewDir . '/dashboard.blade.php', $dashboardView);
    echo "✅ Vue dashboard créée\n";

    // 2. Ajouter les routes manquantes
    echo "\n📋 Routes à ajouter dans routes/web.php:\n";
    echo "// Routes Super Admin\n";
    echo "Route::prefix('super-admin')->middleware(['auth', 'superadmin'])->group(function () {\n";
    echo "    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');\n";
    echo "    Route::get('/tenants', [SuperAdminController::class, 'tenantsIndex'])->name('superadmin.tenants.index');\n";
    echo "    Route::get('/tenants/{id}', [SuperAdminController::class, 'tenantsShow'])->name('superadmin.tenants.show');\n";
    echo "    Route::post('/tenants/{id}/approve', [SuperAdminController::class, 'approveTenant'])->name('superadmin.tenants.approve');\n";
    echo "    Route::get('/users', [SuperAdminController::class, 'usersIndex'])->name('superadmin.users.index');\n";
    echo "    Route::get('/reservations', [SuperAdminController::class, 'reservationsIndex'])->name('superadmin.reservations.index');\n";
    echo "    Route::get('/maintenance', [SuperAdminController::class, 'maintenanceIndex'])->name('superadmin.maintenance.index');\n";
    echo "});\n";

    echo "\n🎯 Instructions:\n";
    echo "1. Connectez-vous avec: superadmin@hotelio.com / superadmin123\n";
    echo "2. Accédez au dashboard: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "3. Ajoutez les routes ci-dessus dans routes/web.php\n";
    echo "4. Le dashboard est maintenant prêt à gérer tout le système !\n";

} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
