@extends('layouts.app')

@section('title', 'Dashboard Super Admin - Enhanced')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Inter+Display:wght@700;800&display=swap');

:root {
    /* ── Palette Super Admin Premium ── */
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
    position: relative;
    overflow-x: hidden;
}

.dashboard-super::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 50%, var(--success) 100%);
    opacity: 0.8;
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
    cursor: pointer;
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
    transform: translateY(-4px) scale(1.02);
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
    position: relative;
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
    position: relative;
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

/* Animations avancées */
@keyframes slideInFromTop {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

@keyframes shimmer {
    0% {
        background-position: -1000px 0;
    }
    100% {
        background-position: 1000px 0;
    }
}

.loading-shimmer {
    background: linear-gradient(90deg, var(--gray-100) 0%, var(--gray-50) 50%, var(--gray-100) 100%);
    background-size: 1000px 100%;
    animation: shimmer 2s infinite;
}

.pending-tenant-card {
    border-left: 4px solid var(--warning) !important;
    transition: var(--transition);
}

.pending-tenant-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-success {
    background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
    border: none;
    color: var(--white);
}

.btn-success:hover {
    background: linear-gradient(135deg, #059669 0%, var(--success) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
}

.btn-danger {
    background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
    border: none;
    color: var(--white);
}

.btn-danger:hover {
    background: linear-gradient(135deg, #dc2626 0%, var(--danger) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
}

/* Responsive amélioré */
@media (max-width: 768px) {
    .dashboard-super {
        padding: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .table {
        font-size: 0.8rem;
    }
    
    .table th, .table td {
        padding: 0.5rem;
    }
    
    .header-title {
        font-size: 1.75rem;
    }
    
    .stat-card .number {
        font-size: 2.25rem;
    }
}

.stat-number {
    display: inline-block;
    animation: slideInFromTop 0.6s ease-out;
}

.stat-icon {
    transition: var(--transition);
    display: inline-block;
}

.stat-card:hover .stat-icon {
    transform: scale(1.1) rotate(5deg);
}

.tooltip {
    position: relative;
}

.tooltip::after {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: var(--gray-800);
    color: var(--white);
    padding: 0.5rem 0.75rem;
    border-radius: var(--radius);
    font-size: 0.75rem;
    white-space: nowrap;
    opacity: 0;
    transition: var(--transition);
    pointer-events: none;
    z-index: 1000;
}

.tooltip:hover::after {
    opacity: 1;
    bottom: calc(100% + 0.5rem);
}

.loading-spinner {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid var(--gray-300);
    border-top: 2px solid var(--primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>

<div class="dashboard-super">
    <!-- En-tête amélioré -->
    <div class="header-section">
        <h1 class="header-title">
            <i class="fas fa-crown me-2" style="color: var(--warning);"></i>
            Tableau de Bord Super Admin
        </h1>
        <p class="header-subtitle">
            Gestion globale de tous les hôtels Morada Lodge
        </p>
    </div>

    <!-- Statistiques globales avec animations -->
    <div class="stats-grid">
        <div class="stat-card" data-tooltip="Hôtels actifs sur la plateforme">
            <i class="fas fa-building stat-icon" style="color: var(--primary); opacity: 0.3; position: absolute; top: 1rem; right: 1rem; font-size: 2rem;"></i>
            <div class="number stat-number">{{ $totalTenants }}</div>
            <div class="label">Hôtels Actifs</div>
            <div class="growth growth-positive">
                <i class="fas fa-chart-line me-1"></i>
                Établissements
            </div>
        </div>

        <div class="stat-card" data-tooltip="Total des utilisateurs tous rôles confondus">
            <i class="fas fa-users stat-icon" style="color: var(--info); opacity: 0.3; position: absolute; top: 1rem; right: 1rem; font-size: 2rem;"></i>
            <div class="number stat-number">21</div>
            <div class="label">Utilisateurs</div>
            <div class="growth">
                <i class="fas fa-user-shield me-1"></i>
                Tous rôles confondus
            </div>
        </div>

        <div class="stat-card" data-tooltip="Total des chambres disponibles">
            <i class="fas fa-door-open stat-icon" style="color: var(--success); opacity: 0.3; position: absolute; top: 1rem; right: 1rem; font-size: 2rem;"></i>
            <div class="number stat-number">{{ $totalRooms }}</div>
            <div class="label">Chambres</div>
            <div class="growth">
                <i class="fas fa-bed me-1"></i>
                Total disponibles
            </div>
        </div>

        <div class="stat-card" data-tooltip="Total des clients inscrits" style="border-left: 4px solid var(--warning);">
            <i class="fas fa-user-friends stat-icon" style="color: var(--warning); opacity: 0.3; position: absolute; top: 1rem; right: 1rem; font-size: 2rem;"></i>
            <div class="number stat-number">{{ $totalCustomers }}</div>
            <div class="label">Clients</div>
            <div class="growth" style="color: var(--warning);">
                <i class="fas fa-users me-1"></i>
                Total inscrits
            </div>
        </div>

        <div class="stat-card" data-tooltip="En attente de validation" style="border-left: 4px solid var(--warning);">
            <i class="fas fa-clock stat-icon" style="color: var(--warning); opacity: 0.3; position: absolute; top: 1rem; right: 1rem; font-size: 2rem;"></i>
            <div class="number stat-number">{{ $pendingTenants }}</div>
            <div class="label">En Attente</div>
            <div class="growth" style="color: var(--warning);">
                <i class="fas fa-hourglass-half me-1"></i>
                Validations requises
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tableau des hôtels -->
        <div class="col-lg-8">
            <div class="tenants-table">
                <div class="p-3 border-bottom" style="background: var(--primary); color: white;">
                    <h5 class="mb-0">
                        <i class="fas fa-building me-2"></i>
                        Détail des Hôtels
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th data-sortable>Hôtel</th>
                                <th data-sortable>Domaine</th>
                                <th data-sortable>Utilisateurs</th>
                                <th data-sortable>Chambres</th>
                                <th data-sortable>Clients</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tenants as $tenant)
                            <tr>
                                <td>
                                    <strong>{{ $tenant['name'] }}</strong>
                                    <br>
                                    <small class="text-muted">Créé le {{ $tenant['created_at'] }}</small>
                                </td>
                                <td>
                                    <code>{{ $tenant['domain'] }}</code>
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-info">
                                        {{ $tenant['users_count'] }}
                                    </span>
                                </td>
                                <td>{{ $tenant['rooms_count'] }}</td>
                                <td>{{ $tenant['customers_count'] }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('tenant.dashboard', $tenant['id']) }}" 
                                           class="btn btn-sm btn-view" target="_self"
                                           data-tooltip="Voir le dashboard de cet hôtel">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="mailto:{{ $tenant['contact_email'] }}" 
                                           class="btn btn-sm btn-view"
                                           data-tooltip="Envoyer un email">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tenants en attente de validation -->
        @if($pendingTenantsList->count() > 0)
        <div class="col-lg-12 mt-4">
            <div class="tenants-table">
                <div class="p-3 border-bottom" style="background: linear-gradient(135deg, var(--warning) 0%, var(--danger) 100%); color: white;">
                    <h5 class="mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Inscriptions Complètes en Attente ({{ $pendingTenantsList->count() }})
                    </h5>
                    <small>Tenants avec formulaire d'inscription complet et compte administrateur créé</small>
                </div>
                
                <!-- Cartes des tenants en attente -->
                <div class="p-4">
                    <div class="row g-3">
                        @foreach($pendingTenantsList as $pendingTenant)
                        <div class="col-lg-6">
                            <div class="pending-tenant-card card border-0 shadow-sm">
                                <div class="card-body">
                                    <!-- Header du tenant -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="flex-grow-1">
                                            <h6 class="card-title mb-1">
                                                <i class="fas fa-hotel me-2" style="color: var(--warning);"></i>
                                                {{ $pendingTenant['name'] }}
                                            </h6>
                                            @if($pendingTenant['description'])
                                                <p class="text-muted small mb-2">{{ Str::limit($pendingTenant['description'], 80) }}</p>
                                            @endif
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
                                            <code>{{ $pendingTenant['domain'] }}</code>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Email</small><br>
                                            <a href="mailto:{{ $pendingTenant['email'] }}" class="text-decoration-none">
                                                <small>{{ $pendingTenant['email'] }}</small>
                                            </a>
                                        </div>
                                        @if($pendingTenant['phone'])
                                        <div class="col-6">
                                            <small class="text-muted">Téléphone</small><br>
                                            <small>{{ $pendingTenant['phone'] }}</small>
                                        </div>
                                        @endif
                                        @if($pendingTenant['address'])
                                        <div class="col-6">
                                            <small class="text-muted">Adresse</small><br>
                                            <small>{{ Str::limit($pendingTenant['address'], 30) }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Admin utilisateur -->
                                    @if($pendingTenant['admin_user'])
                                    <div class="alert alert-info py-2 mb-3">
                                        <small class="text-muted">Administrateur</small><br>
                                        <strong>{{ $pendingTenant['admin_user']['name'] }}</strong><br>
                                        <small>{{ $pendingTenant['admin_user']['email'] }}</small>
                                    </div>
                                    @endif
                                    
                                    <!-- Thème choisi -->
                                    @if($pendingTenant['theme_settings'])
                                    <div class="mb-3">
                                        <small class="text-muted">Thème personnalisé</small><br>
                                        <div class="d-flex gap-2">
                                            <span class="badge" style="background: {{ $pendingTenant['theme_settings']['primary_color'] ?? '#8b4513' }}; color: white;">
                                                Primaire
                                            </span>
                                            <span class="badge" style="background: {{ $pendingTenant['theme_settings']['secondary_color'] ?? '#a0522d' }}; color: white;">
                                                Secondaire
                                            </span>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <!-- Actions -->
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="flex-grow-1">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $pendingTenant['created_at'] }}
                                            </small>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <button type="button" 
                                                    class="btn btn-success btn-sm" 
                                                    data-action="approve-tenant"
                                                    data-tenant-id="{{ $pendingTenant['id'] }}"
                                                    data-tenant-name="{{ $pendingTenant['name'] }}"
                                                    title="Approuver et créer les pages">
                                                <i class="fas fa-check"></i>
                                                <span class="d-none d-md-inline"> Approuver</span>
                                            </button>
                                            <button type="button" 
                                                    class="btn btn-info btn-sm" 
                                                    data-action="view-tenant-details"
                                                    data-tenant-id="{{ $pendingTenant['id'] }}"
                                                    title="Voir les détails">
                                                <i class="fas fa-eye"></i>
                                                <span class="d-none d-md-inline"> Détails</span>
                                            </button>
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm" 
                                                    data-action="reject-tenant"
                                                    data-tenant-id="{{ $pendingTenant['id'] }}"
                                                    data-tenant-name="{{ $pendingTenant['name'] }}"
                                                    title="Rejeter et supprimer">
                                                <i class="fas fa-times"></i>
                                                <span class="d-none d-md-inline"> Rejeter</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-12 mt-4">
            <div class="alert alert-success text-center" style="border-radius: var(--radius-lg); border: 1px solid var(--success);">
                <i class="fas fa-check-circle fa-3x mb-3" style="color: var(--success);"></i>
                <h5>✅ Aucune demande en attente</h5>
                <p class="mb-0">Tous les tenants ont été traités. Les nouveaux tenants apparaîtront ici pour validation.</p>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Scripts modernes et améliorés pour le dashboard Super Admin -->
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

// Utilitaires améliorés
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
    
    showNotification(message, type = 'success', duration = 3000) {
        document.querySelectorAll('.notification').forEach(n => n.remove());
        
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
                <span>${message}</span>
                <button class="notification-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        requestAnimationFrame(() => {
            notification.classList.add('show');
        });
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, duration);
    },
    
    showLoading(element, originalContent) {
        element.disabled = true;
        element.innerHTML = '<i class="fas fa-spinner fa-spin loading-spinner me-2"></i>Chargement...';
    },
    
    hideLoading(element, originalContent) {
        element.disabled = false;
        element.innerHTML = originalContent;
    }
};

// Gestion des statistiques animées améliorée
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
                    num.classList.add('stat-number');
                    setTimeout(() => {
                        Utils.animateValue(num, 0, finalValue, 1500);
                    }, 500);
                }
            });
        });
    }
    
    addInteractivity() {
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

// Gestion des tables interactives améliorée
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
        const tableHeaders = document.querySelectorAll('.table th[data-sortable]');
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
                
                if (matches) {
                    row.style.animation = 'slideInFromTop 0.3s ease-out';
                }
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
        
        header.parentNode.querySelectorAll('th').forEach(th => {
            th.classList.remove('sort-asc', 'sort-desc');
        });
        header.classList.add(isAscending ? 'sort-asc' : 'sort-desc');
        
        rows.forEach((row, index) => {
            row.style.animation = `slideInFromTop 0.3s ease-out ${index * 0.05}s`;
            tbody.appendChild(row);
        });
    }
}

// Gestion des actions tenant améliorée
class TenantManager {
    constructor() {
        this.init();
    }
    
    init() {
        this.bindApprovalActions();
        this.bindViewActions();
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
        const originalContent = button.innerHTML;
        
        Utils.showLoading(button, originalContent);
        
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
            Utils.hideLoading(button, originalContent);
        }
    }
    
    async rejectTenant(button) {
        const tenantId = button.dataset.tenantId;
        const tenantName = button.dataset.tenantName;
        const originalContent = button.innerHTML;
        
        if (!confirm(`Êtes-vous sûr de vouloir rejeter "${tenantName}"? Cette action est irréversible.`)) {
            return;
        }
        
        Utils.showLoading(button, originalContent);
        
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
            Utils.hideLoading(button, originalContent);
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
        console.log(`Afficher les détails du tenant ${tenantId}`);
    }
}

// Styles CSS additionnels
const additionalStyles = `
<style>
.notification {
    position: fixed;
    top: 2rem;
    right: 2rem;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
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

.notification-success {
    border-left: 4px solid var(--success);
}

.notification-error {
    border-left: 4px solid var(--danger);
}

.notification-info {
    border-left: 4px solid var(--info);
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
    .notification {
        top: 1rem;
        right: 1rem;
        left: 1rem;
        max-width: calc(100% - 2rem);
    }
    
    .table-search-input {
        width: 100%;
        margin-top: 0.5rem;
    }
}
</style>
`;

// Initialiser tous les gestionnaires
document.addEventListener('DOMContentLoaded', () => {
    document.head.insertAdjacentHTML('beforeend', additionalStyles);
    
    window.statsManager = new StatsManager();
    window.tableManager = new TableManager();
    window.tenantManager = new TenantManager();
    
    console.log('Dashboard Super Admin Enhanced initialisé avec succès');
});

window.addEventListener('error', (e) => {
    console.error('Erreur JavaScript:', e.error);
    Utils.showNotification('Une erreur est survenue', 'error');
});
</script>

@endsection
