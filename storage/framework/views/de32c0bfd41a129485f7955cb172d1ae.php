<?php $__env->startSection('title', 'Dashboard Super Admin'); ?>

<?php $__env->startSection('content'); ?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Inter+Display:wght@700;800&display=swap');

:root {
    /* ── Palette Super Admin Moderne ── */
    --primary: #6366f1;
    --primary-dark: #4f46e5;
    --primary-light: #818cf8;
    --secondary: #8b5cf6;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #3b82f6;
    
    /* Couleurs de base */
    --white: #ffffff;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    
    /* Espacements et ombres */
    --radius-sm: 6px;
    --radius: 8px;
    --radius-lg: 12px;
    --radius-xl: 16px;
    --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
    --shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.15);
    
    /* Transitions */
    --transition-fast: all 0.15s ease;
    --transition: all 0.2s ease;
    --transition-slow: all 0.3s ease;
    
    /* Typography */
    --font-sans: 'Inter', system-ui, -apple-system, sans-serif;
    --font-display: 'Inter Display', sans-serif;
}

.dashboard-super {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    min-height: 100vh;
    padding: 2rem;
    font-family: var(--font-sans);
    color: var(--gray-800);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.75rem;
    box-shadow: var(--shadow);
    border: 1px solid var(--gray-200);
    border-left: 4px solid var(--primary);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
    opacity: 0.8;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary-light);
}

.stat-card .number {
    font-size: 2.75rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.5rem;
    font-family: var(--font-display);
    line-height: 1;
    letter-spacing: -0.02em;
}

.stat-card .label {
    color: var(--gray-600);
    font-size: 0.875rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 1rem;
}

.stat-card .growth {
    font-size: 0.875rem;
    margin-top: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    background: var(--gray-50);
    border-radius: var(--radius);
    font-weight: 500;
}

.growth-positive {
    color: var(--success);
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.growth-negative {
    color: var(--warning);
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.tenants-table {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow);
    border: 1px solid var(--gray-200);
}

.table {
    margin: 0;
    font-size: 0.875rem;
}

.table th {
    background: var(--primary);
    color: var(--white);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.05em;
    padding: 1rem 1.25rem;
    border: none;
    font-family: var(--font-sans);
}

.table td {
    padding: 1rem 1.25rem;
    vertical-align: middle;
    border-bottom: 1px solid var(--gray-200);
    font-weight: 400;
}

.table tbody tr:hover {
    background: var(--gray-50);
    transition: var(--transition-fast);
}

.badge-role {
    padding: 0.375rem 0.875rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
    font-family: var(--font-sans);
}

.badge-super {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: var(--white);
    box-shadow: var(--shadow-sm);
}

.badge-admin {
    background: var(--info);
    color: var(--white);
    box-shadow: var(--shadow-sm);
}

.badge-receptionist {
    background: var(--secondary);
    color: var(--white);
    box-shadow: var(--shadow-sm);
}

.revenue-cell {
    font-weight: 600;
    color: var(--primary);
    font-family: var(--font-display);
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    border-radius: var(--radius);
    border: none;
    cursor: pointer;
    transition: var(--transition);
    font-weight: 500;
    font-family: var(--font-sans);
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    text-decoration: none;
}

.btn-view {
    background: var(--gray-100);
    color: var(--gray-700);
    border: 1px solid var(--gray-300);
}

.btn-view:hover {
    background: var(--gray-200);
    color: var(--gray-800);
    transform: translateY(-1px);
    box-shadow: var(--shadow-sm);
}

.btn-toggle {
    background: var(--warning);
    color: var(--white);
    border: 1px solid var(--warning);
}

.btn-toggle:hover {
    background: #dc8804;
    transform: translateY(-1px);
    box-shadow: var(--shadow-sm);
}

.header-section {
    margin-bottom: 2.5rem;
    text-align: center;
}

.header-title {
    color: var(--gray-900);
    font-size: 2.25rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    font-family: var(--font-display);
    letter-spacing: -0.02em;
}

.header-subtitle {
    color: var(--gray-600);
    font-size: 1.125rem;
    font-weight: 400;
    margin-bottom: 1rem;
}

.top-tenants {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 2rem;
    box-shadow: var(--shadow);
    border: 1px solid var(--gray-200);
}

.top-tenant-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 0;
    border-bottom: 1px solid var(--gray-200);
    transition: var(--transition-fast);
}

.top-tenant-item:hover {
    background: var(--gray-50);
}

.top-tenant-item:last-child {
    border-bottom: none;
}

.top-tenant-rank {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: var(--white);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.875rem;
    font-family: var(--font-display);
    box-shadow: var(--shadow-sm);
}

.top-tenant-name {
    flex: 1;
    margin-left: 1rem;
    font-weight: 600;
    color: var(--gray-800);
    font-size: 1rem;
}

.top-tenant-revenue {
    font-weight: 600;
    color: var(--primary);
    font-family: var(--font-display);
    font-size: 1.125rem;
}

@media (max-width: 768px) {
    .dashboard-super {
        padding: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .table {
        font-size: 0.8rem;
    }
    
    .table th, .table td {
        padding: 0.5rem;
    }
}
</style>

<div class="dashboard-super">
    <!-- En-tête -->
    <div class="header-section">
        <h1 class="header-title">
            <i class="fas fa-crown me-2"></i>
            Tableau de Bord Super Admin
        </h1>
        <p class="header-subtitle">
            Gestion globale de tous les hôtels Morada Lodge
        </p>
    </div>

    <!-- Statistiques globales -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="number"><?php echo e($totalTenants); ?></div>
            <div class="label">Hôtels Actifs</div>
            <div class="growth growth-positive">
                <i class="fas fa-building me-1"></i>
                Établissements
            </div>
        </div>

        <div class="stat-card">
            <div class="number">21</div>
            <div class="label">Utilisateurs</div>
            <div class="growth">
                <i class="fas fa-users me-1"></i>
                Tous rôles confondus
            </div>
        </div>

        <div class="stat-card">
            <div class="number"><?php echo e($totalRooms); ?></div>
            <div class="label">Chambres</div>
            <div class="growth">
                <i class="fas fa-door-open me-1"></i>
                Total disponibles
            </div>
        </div>

        
        <div class="stat-card">
            <div class="number"><?php echo e($totalCustomers); ?></div>
            <div class="label">Clients</div>
            <div class="growth">
                <i class="fas fa-user-friends me-1"></i>
                Total inscrits
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid var(--m500);">
            <div class="number"><?php echo e($pendingTenants); ?></div>
            <div class="label">En Attente</div>
            <div class="growth" style="color: var(--m500);">
                <i class="fas fa-clock me-1"></i>
                Validations requises
            </div>
        </div>

            </div>

    <div class="row">
        <!-- Tableau des hôtels -->
        <div class="col-lg-8">
            <div class="tenants-table">
                <div class="p-3 border-bottom" style="background: var(--m600); color: white;">
                    <h5 class="mb-0">
                        <i class="fas fa-building me-2"></i>
                        Détail des Hôtels
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Hôtel</th>
                                <th>Domaine</th>
                                <th>Utilisateurs</th>
                                <th>Chambres</th>
                                <th>Clients</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($tenant['name']); ?></strong>
                                    <br>
                                    <small class="text-muted">Créé le <?php echo e($tenant['created_at']); ?></small>
                                </td>
                                <td>
                                    <code><?php echo e($tenant['domain']); ?></code>
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-info">
                                        <?php echo e($tenant['users_count']); ?>

                                    </span>
                                </td>
                                <td><?php echo e($tenant['rooms_count']); ?></td>
                                <td><?php echo e($tenant['customers_count']); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?php echo e(route('tenant.dashboard', $tenant['id'])); ?>" 
                                           class="btn btn-sm btn-view" target="_self">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="mailto:<?php echo e($tenant['contact_email']); ?>" 
                                           class="btn btn-sm btn-view">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tenants en attente de validation -->
        <?php if($pendingTenantsList->count() > 0): ?>
        <div class="col-lg-12 mt-4">
            <div class="tenants-table">
                <div class="p-3 border-bottom" style="background: linear-gradient(135deg, var(--m500) 0%, var(--m600) 100%); color: white;">
                    <h5 class="mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Inscriptions Complètes en Attente (<?php echo e($pendingTenantsList->count()); ?>)
                    </h5>
                    <small>Tenants avec formulaire d'inscription complet et compte administrateur créé</small>
                </div>
                
                <!-- Cartes des tenants en attente -->
                <div class="p-4">
                    <div class="row g-3">
                        <?php $__currentLoopData = $pendingTenantsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendingTenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-6">
                            <div class="pending-tenant-card card border-0 shadow-sm" style="border-left: 4px solid var(--m500) !important;">
                                <div class="card-body">
                                    <!-- Header du tenant -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="flex-grow-1">
                                            <h6 class="card-title mb-1">
                                                <i class="fas fa-hotel me-2" style="color: var(--m500);"></i>
                                                <?php echo e($pendingTenant['name']); ?>

                                            </h6>
                                            <?php if($pendingTenant['description']): ?>
                                                <p class="text-muted small mb-2"><?php echo e(Str::limit($pendingTenant['description'], 80)); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-hourglass-half me-1"></i>
                                            En attente
                                        </span>
                                    </div>
                                    
                                    <!-- Informations de contact -->
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <small class="text-muted">Domaine</small><br>
                                            <code><?php echo e($pendingTenant['domain']); ?></code>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Email</small><br>
                                            <a href="mailto:<?php echo e($pendingTenant['email']); ?>" class="text-decoration-none">
                                                <small><?php echo e($pendingTenant['email']); ?></small>
                                            </a>
                                        </div>
                                        <?php if($pendingTenant['phone']): ?>
                                        <div class="col-6">
                                            <small class="text-muted">Téléphone</small><br>
                                            <small><?php echo e($pendingTenant['phone']); ?></small>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($pendingTenant['address']): ?>
                                        <div class="col-6">
                                            <small class="text-muted">Adresse</small><br>
                                            <small><?php echo e(Str::limit($pendingTenant['address'], 30)); ?></small>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Admin utilisateur -->
                                    <?php if($pendingTenant['admin_user']): ?>
                                    <div class="alert alert-info py-2 mb-3">
                                        <small class="text-muted">Administrateur</small><br>
                                        <strong><?php echo e($pendingTenant['admin_user']['name']); ?></strong><br>
                                        <small><?php echo e($pendingTenant['admin_user']['email']); ?></small>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <!-- Thème choisi -->
                                    <?php if($pendingTenant['theme_settings']): ?>
                                    <div class="mb-3">
                                        <small class="text-muted">Thème personnalisé</small><br>
                                        <div class="d-flex gap-2">
                                            <span class="badge" style="background: <?php echo e($pendingTenant['theme_settings']['primary_color'] ?? '#8b4513'); ?>; color: white;">
                                                Primaire
                                            </span>
                                            <span class="badge" style="background: <?php echo e($pendingTenant['theme_settings']['secondary_color'] ?? '#a0522d'); ?>; color: white;">
                                                Secondaire
                                            </span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <!-- Actions -->
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="flex-grow-1">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                <?php echo e($pendingTenant['created_at']); ?>

                                            </small>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <button type="button" 
                                                    class="btn btn-success btn-sm" 
                                                    data-action="approve-tenant"
                                                    data-tenant-id="<?php echo e($pendingTenant['id']); ?>"
                                                    data-tenant-name="<?php echo e($pendingTenant['name']); ?>"
                                                    title="Approuver et créer les pages">
                                                <i class="fas fa-check"></i>
                                                <span class="d-none d-md-inline"> Approuver</span>
                                            </button>
                                            <button type="button" 
                                                    class="btn btn-info btn-sm" 
                                                    data-action="view-tenant-details"
                                                    data-tenant-id="<?php echo e($pendingTenant['id']); ?>"
                                                    title="Voir les détails">
                                                <i class="fas fa-eye"></i>
                                                <span class="d-none d-md-inline"> Détails</span>
                                            </button>
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm" 
                                                    data-action="reject-tenant"
                                                    data-tenant-id="<?php echo e($pendingTenant['id']); ?>"
                                                    data-tenant-name="<?php echo e($pendingTenant['name']); ?>"
                                                    title="Rejeter et supprimer">
                                                <i class="fas fa-times"></i>
                                                <span class="d-none d-md-inline"> Rejeter</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                
                <!-- Instructions -->
                            </div>
        </div>
        
        <!-- Message si aucun tenant en attente -->
        <?php else: ?>
        <div class="col-lg-12 mt-4">
            <div class="alert alert-success text-center">
                <i class="fas fa-check-circle fa-3x mb-3"></i>
                <h5>✅ Aucune demande en attente</h5>
                <p class="mb-0">Tous les tenants ont été traités. Les nouveaux tenants apparaîtront ici pour validation.</p>
            </div>
        </div>
        <?php endif; ?>

            </div>

    <!-- Statistiques par rôle -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="top-tenants">
                <h5 class="mb-3">
                    <i class="fas fa-user-tag me-2" style="color: var(--m600);"></i>
                    Utilisateurs par Rôle (21 total)
                </h5>
                
                <!-- Super Admin -->
                <div class="top-tenant-item" style="background: var(--a50); border-radius: 8px; padding: 1rem;">
                    <div style="display: flex; align-items: center;">
                        <i class="fas fa-crown me-2" style="color: var(--a700); font-size: 1.2rem;"></i>
                        <span class="badge-role badge-super">
                            Super Admin
                        </span>
                    </div>
                    <div style="text-align: right;">
                        <strong style="font-size: 1.1rem; color: var(--a700);">3</strong>
                        <div style="font-size: 0.8rem; color: #666;">Administrateur principal</div>
                    </div>
                </div>
                
                <!-- Admins -->
                <div class="top-tenant-item" style="background: var(--m50); border-radius: 8px; padding: 1rem;">
                    <div style="display: flex; align-items: center;">
                        <i class="fas fa-user-shield me-2" style="color: var(--m600); font-size: 1.2rem;"></i>
                        <span class="badge-role badge-admin">
                            Admin
                        </span>
                    </div>
                    <div style="text-align: right;">
                        <strong style="font-size: 1.1rem; color: var(--m600);"><?php echo e($roleStats['Admin'] ?? 0); ?></strong>
                        <div style="font-size: 0.8rem; color: #666;">Administrateurs d'hôtels</div>
                    </div>
                </div>
                
                <!-- Receptionists -->
                <div class="top-tenant-item" style="background: #f8f9fa; border-radius: 8px; padding: 1rem;">
                    <div style="display: flex; align-items: center;">
                        <i class="fas fa-concierge-bell me-2" style="color: var(--m300); font-size: 1.2rem;"></i>
                        <span class="badge-role badge-receptionist">
                            Receptionist
                        </span>
                    </div>
                    <div style="text-align: right;">
                        <strong style="font-size: 1.1rem; color: var(--m300);"><?php echo e($roleStats['Receptionist'] ?? 0); ?></strong>
                        <div style="font-size: 0.8rem; color: #666;">Réceptionnistes</div>
                    </div>
                </div>
                
                <!-- Customers -->
                <div class="top-tenant-item" style="background: #f0f0f0; border-radius: 8px; padding: 1rem;">
                    <div style="display: flex; align-items: center;">
                        <i class="fas fa-user me-2" style="color: #6c757d; font-size: 1.2rem;"></i>
                        <span class="badge-role badge-customer">
                            Customer
                        </span>
                    </div>
                    <div style="text-align: right;">
                        <strong style="font-size: 1.1rem; color: #6c757d;"><?php echo e($roleStats['Customer'] ?? 0); ?></strong>
                        <div style="font-size: 0.8rem; color: #666;">Clients</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section détaillée des utilisateurs par hôtel -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="tenants-table">
                <div class="p-3 border-bottom" style="background: var(--m600); color: white;">
                    <h5 class="mb-0">
                        <i class="fas fa-users-cog me-2"></i>
                        Répartition des Utilisateurs par Hôtel
                    </h5>
                </div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Hôtel</th>
                                <th>Super Admin</th>
                                <th>Admins</th>
                                <th>Réceptionnistes</th>
                                <th>Clients</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $tenantUsers = $tenant['users_count'];
                                // Récupérer les détails des utilisateurs pour ce tenant
                                $usersByRole = \App\Models\User::where('tenant_id', $tenant['id'])
                                    ->selectRaw('role, COUNT(*) as count')
                                    ->groupBy('role')
                                    ->pluck('count', 'role')
                                    ->toArray();
                            ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($tenant['name']); ?></strong>
                                    <br>
                                    <small class="text-muted"><?php echo e($tenant['domain'] ?? 'N/A'); ?></small>
                                </td>
                                <td>
                                    <span class="badge-role badge-super">
                                        <?php echo e($usersByRole['Super'] ?? 0); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge-role badge-admin">
                                        <?php echo e($usersByRole['Admin'] ?? 0); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge-role badge-receptionist">
                                        <?php echo e($usersByRole['Receptionist'] ?? 0); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge-role badge-customer">
                                        <?php echo e($usersByRole['Customer'] ?? 0); ?>

                                    </span>
                                </td>
                                <td>
                                    <strong style="font-size: 1.1rem; color: var(--m600);">
                                        <?php echo e($tenant['users_count']); ?>

                                    </strong>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('super-admin.users')); ?>?tenant_id=<?php echo e($tenant['id']); ?>" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-list"></i> Voir détails
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr style="background: var(--m50); font-weight: bold;">
                                <td><strong>TOTAUX</strong></td>
                                <td><strong>3</strong></td>
                                <td><strong><?php echo e($roleStats['Admin'] ?? 0); ?></strong></td>
                                <td><strong><?php echo e($roleStats['Receptionist'] ?? 0); ?></strong></td>
                                <td><strong><?php echo e($roleStats['Customer'] ?? 0); ?></strong></td>
                                <td><strong style="font-size: 1.2rem; color: var(--m600);">21</strong></td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts modernes pour le dashboard Super Admin -->
<script>
// Configuration globale
const CONFIG = {
    animation: {
        duration: 300,
        easing: 'cubic-bezier(0.4, 0, 0.2, 1)'
    },
    api: {
        debounce: 300
    }
};

// Utilitaires
const Utils = {
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },
    
    animateValue(element, start, end, duration = CONFIG.animation.duration) {
        const startTime = performance.now();
        const animate = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            const current = start + (end - start) * easeProgress;
            
            element.textContent = Math.round(current).toLocaleString();
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };
        requestAnimationFrame(animate);
    },
    
    showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
            <button class="notification-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
};

// Gestion des statistiques animées
class StatsManager {
    constructor() {
        this.observerOptions = {
            threshold: 0.1,
            rootMargin: '0px'
        };
        this.init();
    }
    
    init() {
        this.observeStatCards();
        this.initializeCounters();
        this.addInteractivity();
    }
    
    observeStatCards() {
        const cards = document.querySelectorAll('.stat-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.animateStatCard(entry.target);
                }
            });
        }, this.observerOptions);
        
        cards.forEach(card => observer.observe(card));
    }
    
    animateStatCard(card) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
        
        const number = card.querySelector('.number');
        if (number) {
            const finalValue = parseInt(number.textContent.replace(/,/g, ''));
            Utils.animateValue(number, 0, finalValue, 1000);
        }
    }
    
    initializeCounters() {
        document.addEventListener('DOMContentLoaded', () => {
            const numbers = document.querySelectorAll('.stat-card .number');
            numbers.forEach(num => {
                const finalValue = parseInt(num.textContent.replace(/,/g, ''));
                if (!isNaN(finalValue)) {
                    num.textContent = '0';
                    setTimeout(() => {
                        Utils.animateValue(num, 0, finalValue, 1500);
                    }, 500);
                }
            });
        });
    }
    
    addInteractivity() {
        // Ajouter des tooltips aux cartes de statistiques
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mouseenter', (e) => {
                card.style.transform = 'translateY(-8px) scale(1.02)';
                card.style.boxShadow = '0 20px 25px rgba(99, 102, 241, 0.15)';
            });
            
            card.addEventListener('mouseleave', (e) => {
                card.style.transform = 'translateY(-4px) scale(1)';
                card.style.boxShadow = '0 10px 15px rgba(0, 0, 0, 0.1)';
            });
        });
    }
}

// Gestion des tables interactives
class TableManager {
    constructor() {
        this.init();
    }
    
    init() {
        this.addTableInteractions();
        this.addSearchFunctionality();
        this.addSortingFunctionality();
    }
    
    addTableInteractions() {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                row.style.transition = `all 0.4s cubic-bezier(0.4, 0, 0.2, 1) ${index * 0.05}s`;
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 50);
        });
    }
    
    addSearchFunctionality() {
        const tableHeaders = document.querySelectorAll('.table th');
        tableHeaders.forEach(header => {
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.placeholder = `Rechercher ${header.textContent}...`;
            searchInput.className = 'table-search-input';
            searchInput.style.cssText = `
                margin-left: 0.5rem;
                padding: 0.25rem 0.5rem;
                border: 1px solid var(--gray-300);
                border-radius: var(--radius);
                font-size: 0.75rem;
                width: 150px;
                display: none;
            `;
            
            header.style.position = 'relative';
            header.appendChild(searchInput);
            
            header.addEventListener('click', () => {
                searchInput.style.display = searchInput.style.display === 'none' ? 'inline-block' : 'none';
                if (searchInput.style.display !== 'none') {
                    searchInput.focus();
                }
            });
            
            searchInput.addEventListener('input', Utils.debounce((e) => {
                this.filterTable(header.textContent, e.target.value);
            }, CONFIG.api.debounce));
        });
    }
    
    filterTable(column, searchTerm) {
        const rows = document.querySelectorAll('tbody tr');
        const columnIndex = Array.from(document.querySelectorAll('thead th')).findIndex(th => th.textContent.trim() === column.trim());
        
        rows.forEach(row => {
            const cell = row.cells[columnIndex];
            if (cell) {
                const text = cell.textContent.toLowerCase();
                const matches = text.includes(searchTerm.toLowerCase());
                row.style.display = matches ? '' : 'none';
            }
        });
    }
    
    addSortingFunctionality() {
        const sortableHeaders = document.querySelectorAll('.table th[data-sortable]');
        sortableHeaders.forEach(header => {
            header.style.cursor = 'pointer';
            header.addEventListener('click', () => {
                this.sortTable(header);
            });
        });
    }
    
    sortTable(header) {
        const table = header.closest('table');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const columnIndex = Array.from(header.parentNode.children).indexOf(header);
        const isAscending = !header.classList.contains('sort-asc');
        
        rows.sort((a, b) => {
            const aValue = a.cells[columnIndex].textContent.trim();
            const bValue = b.cells[columnIndex].textContent.trim();
            
            if (isAscending) {
                return aValue.localeCompare(bValue);
            } else {
                return bValue.localeCompare(aValue);
            }
        });
        
        // Mettre à jour les classes de tri
        header.parentNode.querySelectorAll('th').forEach(th => {
            th.classList.remove('sort-asc', 'sort-desc');
        });
        header.classList.add(isAscending ? 'sort-asc' : 'sort-desc');
        
        // Réorganiser les lignes
        rows.forEach(row => tbody.appendChild(row));
    }
}

// Gestion des actions tenant
class TenantManager {
    constructor() {
        this.init();
    }
    
    init() {
        this.bindApprovalActions();
        this.bindViewActions();
        this.addBulkActions();
    }
    
    bindApprovalActions() {
        document.querySelectorAll('[data-action="approve-tenant"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                this.approveTenant(e.target.closest('button'));
            });
        });
        
        document.querySelectorAll('[data-action="reject-tenant"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                this.rejectTenant(e.target.closest('button'));
            });
        });
    }
    
    async approveTenant(button) {
        const tenantId = button.dataset.tenantId;
        const tenantName = button.dataset.tenantName;
        
        // Désactiver le bouton
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Approbation...';
        
        try {
            const response = await fetch(`/super-admin/tenant/${tenantId}/approve`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            });
            
            if (response.ok) {
                Utils.showNotification(`Hôtel "${tenantName}" approuvé avec succès!`, 'success');
                setTimeout(() => window.location.reload(), 1500);
            } else {
                throw new Error('Erreur lors de l\'approbation');
            }
        } catch (error) {
            Utils.showNotification(`Erreur: ${error.message}`, 'error');
            button.disabled = false;
            button.innerHTML = '<i class="fas fa-check"></i> Approuver';
        }
    }
    
    async rejectTenant(button) {
        const tenantId = button.dataset.tenantId;
        const tenantName = button.dataset.tenantName;
        
        if (!confirm(`Êtes-vous sûr de vouloir rejeter "${tenantName}"? Cette action est irréversible.`)) {
            return;
        }
        
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Rejet...';
        
        try {
            const response = await fetch(`/super-admin/tenant/${tenantId}/reject`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            });
            
            if (response.ok) {
                Utils.showNotification(`Hôtel "${tenantName}" rejeté`, 'info');
                setTimeout(() => window.location.reload(), 1500);
            } else {
                throw new Error('Erreur lors du rejet');
            }
        } catch (error) {
            Utils.showNotification(`Erreur: ${error.message}`, 'error');
            button.disabled = false;
            button.innerHTML = '<i class="fas fa-times"></i> Rejeter';
        }
    }
    
    bindViewActions() {
        document.querySelectorAll('[data-action="view-tenant-details"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                this.showTenantDetails(e.target.closest('button'));
            });
        });
    }
    
    showTenantDetails(button) {
        const tenantId = button.dataset.tenantId;
        // Implémenter un modal pour afficher les détails du tenant
        console.log(`Afficher les détails du tenant ${tenantId}`);
    }
    
    addBulkActions() {
        // Ajouter un bouton pour approuver/rejeter en masse
        const header = document.querySelector('.tenants-table .p-3');
        if (header && header.textContent.includes('Inscriptions Complètes')) {
            const bulkActions = document.createElement('div');
            bulkActions.className = 'bulk-actions';
            bulkActions.innerHTML = `
                <button class="btn btn-sm btn-success me-2" onclick="tenantManager.bulkApprove()">
                    <i class="fas fa-check-double"></i> Tout approuver
                </button>
                <button class="btn btn-sm btn-danger" onclick="tenantManager.bulkReject()">
                    <i class="fas fa-times-double"></i> Tout rejeter
                </button>
            `;
            header.appendChild(bulkActions);
        }
    }
    
    async bulkApprove() {
        if (!confirm('Approuver tous les tenants en attente?')) return;
        
        const buttons = document.querySelectorAll('[data-action="approve-tenant"]');
        buttons.forEach(btn => btn.click());
    }
    
    async bulkReject() {
        if (!confirm('Rejeter tous les tenants en attente? Cette action est irréversible.')) return;
        
        const buttons = document.querySelectorAll('[data-action="reject-tenant"]');
        buttons.forEach(btn => btn.click());
    }
}

// Gestion du thème et des préférences
class ThemeManager {
    constructor() {
        this.init();
    }
    
    init() {
        this.addThemeToggle();
        this.addCompactMode();
        this.addExportFunctionality();
    }
    
    addThemeToggle() {
        const themeToggle = document.createElement('button');
        themeToggle.className = 'theme-toggle';
        themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
        themeToggle.title = 'Basculer le thème';
        
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-theme');
            const isDark = document.body.classList.contains('dark-theme');
            themeToggle.innerHTML = isDark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
        
        document.body.appendChild(themeToggle);
    }
    
    addCompactMode() {
        const compactToggle = document.createElement('button');
        compactToggle.className = 'compact-toggle';
        compactToggle.innerHTML = '<i class="fas fa-compress"></i>';
        compactToggle.title = 'Mode compact';
        
        compactToggle.addEventListener('click', () => {
            document.body.classList.toggle('compact-mode');
            const isCompact = document.body.classList.contains('compact-mode');
            compactToggle.innerHTML = isCompact ? '<i class="fas fa-expand"></i>' : '<i class="fas fa-compress"></i>';
            localStorage.setItem('layout', isCompact ? 'compact' : 'normal');
        });
        
        document.body.appendChild(compactToggle);
    }
    
    addExportFunctionality() {
        const exportBtn = document.createElement('button');
        exportBtn.className = 'export-btn';
        exportBtn.innerHTML = '<i class="fas fa-download me-2"></i>Exporter';
        exportBtn.title = 'Exporter les données';
        
        exportBtn.addEventListener('click', () => {
            this.exportData();
        });
        
        const header = document.querySelector('.header-section');
        if (header) {
            const actionsContainer = document.createElement('div');
            actionsContainer.className = 'header-actions';
            actionsContainer.appendChild(exportBtn);
            header.appendChild(actionsContainer);
        }
    }
    
    exportData() {
        const data = {
            tenants: this.extractTableData(),
            stats: this.extractStatsData(),
            timestamp: new Date().toISOString()
        };
        
        const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `super-admin-dashboard-${new Date().toISOString().split('T')[0]}.json`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        
        Utils.showNotification('Données exportées avec succès', 'success');
    }
    
    extractTableData() {
        const rows = document.querySelectorAll('tbody tr');
        return Array.from(rows).map(row => {
            const cells = row.querySelectorAll('td');
            return Array.from(cells).map(cell => cell.textContent.trim());
        });
    }
    
    extractStatsData() {
        const statCards = document.querySelectorAll('.stat-card');
        return Array.from(statCards).map(card => ({
            label: card.querySelector('.label')?.textContent,
            value: card.querySelector('.number')?.textContent,
            growth: card.querySelector('.growth')?.textContent
        }));
    }
}

// Styles CSS additionnels
const additionalStyles = `
<style>
.header-actions {
    position: absolute;
    top: 2rem;
    right: 2rem;
    display: flex;
    gap: 0.5rem;
}

.theme-toggle, .compact-toggle, .export-btn {
    background: var(--white);
    border: 1px solid var(--gray-300);
    border-radius: var(--radius);
    padding: 0.5rem 0.75rem;
    cursor: pointer;
    transition: var(--transition);
    font-size: 0.875rem;
    color: var(--gray-700);
}

.theme-toggle:hover, .compact-toggle:hover, .export-btn:hover {
    background: var(--gray-100);
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-1px);
    box-shadow: var(--shadow-sm);
}

.bulk-actions {
    margin-top: 1rem;
    display: flex;
    gap: 0.5rem;
}

.table-search-input {
    background: var(--white);
    border: 1px solid var(--gray-300);
    border-radius: var(--radius);
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    transition: var(--transition);
    width: 200px;
}

.table-search-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.notification {
    position: fixed;
    top: 2rem;
    right: 2rem;
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 1rem 1.5rem;
    box-shadow: var(--shadow-xl);
    z-index: 9999;
    transform: translateX(100%);
    transition: var(--transition-slow);
    max-width: 400px;
}

.notification.show {
    transform: translateX(0);
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.notification-content i {
    font-size: 1.25rem;
}

.notification-success {
    border-left: 4px solid var(--success);
}

.notification-error {
    border-left: 4px solid var(--danger);
}

.notification-info {
    border-left: 4px solid var(--info);
}

.notification-close {
    background: none;
    border: none;
    color: var(--gray-400);
    cursor: pointer;
    padding: 0.25rem;
    margin-left: auto;
    transition: var(--transition);
}

.notification-close:hover {
    color: var(--gray-600);
}

.dark-theme {
    --white: #1f2937;
    --gray-50: #374151;
    --gray-100: #4b5563;
    --gray-200: #6b7280;
    --gray-300: #9ca3af;
    --gray-900: #f9fafb;
    --gray-800: #f3f4f6;
}

.compact-mode .stats-grid {
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.compact-mode .stat-card {
    padding: 1rem;
}

.compact-mode .header-section {
    margin-bottom: 1.5rem;
}

.compact-mode .tenants-table {
    padding: 1rem;
}

th[data-sortable] {
    position: relative;
    padding-right: 1.5rem !important;
}

th[data-sortable]:hover {
    background: var(--primary-dark);
}

th[data-sortable]::after {
    content: '↕';
    position: absolute;
    right: 0.5rem;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.5;
    font-size: 0.75rem;
}

th.sort-asc::after {
    content: '↑';
    opacity: 1;
}

th.sort-desc::after {
    content: '↓';
    opacity: 1;
}

@media (max-width: 768px) {
    .header-actions {
        position: static;
        margin-bottom: 1rem;
        justify-content: center;
    }
    
    .table-search-input {
        width: 100%;
        margin-top: 0.5rem;
    }
    
    .notification {
        top: 1rem;
        right: 1rem;
        left: 1rem;
        max-width: calc(100% - 2rem);
    }
}
</style>
`;

// Initialiser tous les gestionnaires
document.addEventListener('DOMContentLoaded', () => {
    // Ajouter les styles additionnels
    document.head.insertAdjacentHTML('beforeend', additionalStyles);
    
    // Initialiser les composants
    window.statsManager = new StatsManager();
    window.tableManager = new TableManager();
    window.tenantManager = new TenantManager();
    window.themeManager = new ThemeManager();
    
    // Restaurer les préférences
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-theme');
    }
    
    const savedLayout = localStorage.getItem('layout');
    if (savedLayout === 'compact') {
        document.body.classList.add('compact-mode');
    }
    
    console.log('Dashboard Super Admin initialisé avec succès');
});

// Gestion des erreurs globales
window.addEventListener('error', (e) => {
    console.error('Erreur JavaScript:', e.error);
    Utils.showNotification('Une erreur est survenue', 'error');
});

// Gestion des performances
if ('performance' in window) {
    window.addEventListener('load', () => {
        const perfData = performance.getEntriesByType('navigation')[0];
        console.log('Performance du dashboard:', {
            loadTime: perfData.loadEventEnd - perfData.loadEventStart,
            domInteractive: perfData.domContentLoadedEventEnd - perfData.loadEventStart
        });
    });
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Majorelle V\Documents\MoradaManagement\resources\views/super-admin/dashboard.blade.php ENDPATH**/ ?>