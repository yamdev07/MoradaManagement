@extends('template.master')
@section('title', 'Gestion des Clients')
@section('content')

<style>
/* ═══════════════════════════════════════════════════════════════
   DESIGN SYSTEM - MÊME STYLE QUE CHECK-IN
═══════════════════════════════════════════════════════════════════ */
:root {
    --primary-50: #fcf8f3;
    --primary-100: #f9f0e6;
    --primary-400: #a0522d;
    --primary-500: #8b4513;
    --primary-600: #704838;
    --primary-700: #5f3c2e;
    --primary-800: #4e3024;

    --amber-50: #fcf8f3;
    --amber-100: #f9f0e6;
    --amber-400: #a0522d;
    --amber-500: #8b4513;
    --amber-600: #704838;

    --blue-50: #fcf8f3;
    --blue-100: #f9f0e6;
    --blue-500: #8b4513;
    --blue-600: #704838;

    --gray-50: #fcf8f3;
    --gray-100: #f9f0e6;
    --gray-200: #f5e6d3;
    --gray-300: #e8d5c4;
    --gray-400: #d2b48c;
    --gray-500: #704838;
    --gray-600: #5f3c2e;
    --gray-700: #4e3024;
    --gray-800: #3d241a;
    --gray-900: #2d1f15;

    --shadow-sm: 0 1px 2px 0 rgb(139 69 19 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(139 69 19 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(139 69 19 / 0.1);
    --shadow-xl: 0 20px 25px -5px rgb(139 69 19 / 0.1);
}

* { box-sizing: border-box; }

.customers-page {
    background: var(--gray-50);
    min-height: 100vh;
    padding: 24px 32px;
    font-family: 'Inter', system-ui, sans-serif;
}

/* Breadcrumb */
.breadcrumb-custom {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.813rem;
    color: var(--gray-400);
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.breadcrumb-custom a {
    color: var(--gray-400);
    text-decoration: none;
    transition: color 0.2s;
}

.breadcrumb-custom a:hover {
    color: var(--primary-600);
}

.breadcrumb-custom .separator {
    color: var(--gray-300);
    font-size: 0.688rem;
}

.breadcrumb-custom .current {
    color: var(--gray-600);
    font-weight: 500;
}

/* En-tête */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 16px;
}

.header-title {
    display: flex;
    align-items: center;
    gap: 12px;
}

.header-title h1 {
    font-size: 1.875rem;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0;
}

.header-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--primary-700), var(--primary-500));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    box-shadow: 0 4px 10px rgba(139, 69, 19, 0.3);
}

.header-subtitle {
    color: var(--gray-500);
    font-size: 0.875rem;
    margin: 6px 0 0 60px;
}

/* Boutons */
.btn-modern {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 500;
    font-size: 0.875rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-primary-modern {
    background: linear-gradient(135deg, var(--primary-700), var(--primary-500));
    color: white;
    box-shadow: 0 4px 6px -1px rgba(139, 69, 19, 0.3);
}

.btn-primary-modern:hover {
    background: linear-gradient(135deg, var(--primary-800), var(--primary-600));
    transform: translateY(-1px);
    box-shadow: 0 6px 8px -1px rgba(139, 69, 19, 0.4);
    color: white;
    text-decoration: none;
}

.btn-outline-modern {
    background: white;
    color: var(--gray-700);
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.btn-outline-modern:hover {
    background: var(--gray-50);
    border-color: var(--gray-300);
    color: var(--gray-900);
    transform: translateY(-1px);
    text-decoration: none;
}

.btn-sm-modern {
    padding: 6px 14px;
    font-size: 0.813rem;
    border-radius: 8px;
}

/* Statistiques */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 28px;
}

.stat-card-modern {
    background: white;
    border-radius: 20px;
    padding: 24px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
    transition: transform 0.2s;
    position: relative;
    overflow: hidden;
}

.stat-card-modern:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.stat-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--primary-500);
}

.stat-card-modern.primary::before { background: var(--primary-500); }
.stat-card-modern.success::before { background: var(--primary-500); }
.stat-card-modern.info::before { background: var(--blue-500); }

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--gray-800);
    line-height: 1.2;
    margin-bottom: 4px;
}

.stat-label {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    color: var(--gray-500);
    letter-spacing: 0.5px;
}

.stat-footer {
    margin-top: 12px;
    font-size: 0.75rem;
    color: var(--gray-400);
    display: flex;
    align-items: center;
    gap: 4px;
}

/* Barre d'actions */
.action-bar {
    background: white;
    border-radius: 16px;
    padding: 16px 20px;
    margin-bottom: 24px;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}

.action-left {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.action-right {
    flex: 1;
    max-width: 400px;
}

/* Filtres */
.filter-badges {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.filter-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 0.75rem;
    font-weight: 500;
    background: var(--gray-100);
    color: var(--gray-600);
    border: 1px solid var(--gray-200);
    text-decoration: none;
    transition: all 0.2s;
}

.filter-badge:hover {
    background: var(--gray-200);
    color: var(--gray-800);
    transform: translateY(-1px);
    text-decoration: none;
}

.filter-badge.active {
    background: var(--primary-100);
    color: var(--primary-700);
    border-color: var(--primary-200);
}

.badge-count {
    background: var(--gray-200);
    padding: 2px 6px;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 600;
    color: var(--gray-700);
}

/* Recherche */
.search-container {
    position: relative;
    width: 100%;
}

.search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
    font-size: 0.9rem;
    pointer-events: none;
    z-index: 2;
}

.search-input {
    width: 100%;
    padding: 12px 16px 12px 42px;
    border: 1px solid var(--gray-200);
    border-radius: 12px;
    font-size: 0.875rem;
    transition: all 0.2s;
    background: var(--white);
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-500);
    box-shadow: 0 0 0 3px var(--primary-100);
}

.search-input::placeholder {
    color: var(--gray-400);
}

.search-clear {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
    background: none;
    border: none;
    font-size: 0.9rem;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 6px;
    transition: all 0.2s;
    z-index: 2;
}

.search-clear:hover {
    color: var(--gray-600);
    background: var(--gray-100);
}

/* Alertes */
.alert-modern {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    font-size: 0.875rem;
    background: white;
    box-shadow: var(--shadow-md);
}

.alert-success {
    background: var(--primary-50);
    border-color: var(--primary-200);
    color: var(--primary-800);
}

.alert-danger {
    background: #fee2e2;
    border-color: #fecaca;
    color: #b91c1c;
}

.alert-info {
    background: var(--blue-50);
    border-color: var(--blue-200);
    color: var(--blue-800);
}

.alert-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.alert-success .alert-icon {
    background: var(--primary-500);
    color: white;
}

.alert-danger .alert-icon {
    background: #ef4444;
    color: white;
}

.alert-info .alert-icon {
    background: var(--blue-500);
    color: white;
}

.alert-close {
    margin-left: auto;
    background: none;
    border: none;
    color: currentColor;
    opacity: 0.5;
    cursor: pointer;
    padding: 4px;
    font-size: 0.9rem;
    transition: all 0.2s;
}

.alert-close:hover {
    opacity: 1;
}

/* Grille des clients */
.customer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 20px;
    margin-bottom: 24px;
}

.customer-card {
    background: white;
    border-radius: 20px;
    border: 1px solid var(--gray-200);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.2s;
    cursor: pointer;
}

.customer-card:hover {
    box-shadow: var(--shadow-lg);
    border-color: var(--gray-300);
    transform: translateY(-4px);
}

.customer-header {
    position: relative;
    height: 120px;
    background: linear-gradient(135deg, var(--primary-700), var(--primary-500));
    padding: 20px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
}

.customer-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 4px solid white;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    object-fit: cover;
    background: white;
    position: absolute;
    bottom: -40px;
    left: 20px;
}

.customer-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(4px);
    padding: 4px 12px;
    border-radius: 30px;
    color: white;
    font-size: 0.7rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.customer-number {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(4px);
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 0.9rem;
}

.customer-body {
    padding: 50px 20px 20px 20px;
}

.customer-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.customer-name a {
    color: var(--gray-800);
    text-decoration: none;
    transition: color 0.2s;
}

.customer-name a:hover {
    color: var(--primary-600);
}

.customer-info-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 8px 0;
    border-bottom: 1px solid var(--gray-100);
}

.customer-info-item:last-child {
    border-bottom: none;
}

.customer-info-icon {
    width: 20px;
    color: var(--gray-400);
    font-size: 0.85rem;
    margin-top: 2px;
}

.customer-info-label {
    font-size: 0.688rem;
    color: var(--gray-500);
    margin-bottom: 2px;
}

.customer-info-value {
    font-size: 0.813rem;
    color: var(--gray-700);
    font-weight: 500;
}

.customer-footer {
    display: flex;
    gap: 8px;
    padding: 16px 20px;
    border-top: 1px solid var(--gray-100);
    background: var(--gray-50);
}

.customer-action-btn {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    border: 1px solid var(--gray-200);
    background: white;
    color: var(--gray-700);
    text-decoration: none;
    transition: all 0.2s;
    cursor: pointer;
}

.customer-action-btn:hover {
    background: var(--gray-100);
    border-color: var(--gray-300);
    color: var(--gray-900);
    transform: translateY(-1px);
    text-decoration: none;
}

.customer-action-btn.primary {
    background: var(--primary-100);
    color: var(--primary-700);
    border-color: var(--primary-200);
}

.customer-action-btn.primary:hover {
    background: var(--primary-500);
    color: white;
    border-color: var(--primary-500);
}

/* Menu déroulant */
.dropdown-modern {
    border: none;
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
    padding: 8px;
    min-width: 200px;
}

.dropdown-modern .dropdown-item {
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
    transition: all 0.2s;
}

.dropdown-modern .dropdown-item:hover {
    background: var(--gray-50);
}

.dropdown-modern .dropdown-item i {
    width: 18px;
    color: var(--gray-500);
}

.dropdown-modern .dropdown-divider {
    margin: 6px 0;
    border-top: 1px solid var(--gray-200);
}

/* État vide */
.empty-state-modern {
    background: white;
    border-radius: 20px;
    padding: 60px 20px;
    text-align: center;
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.empty-state-modern i {
    font-size: 4rem;
    color: var(--gray-300);
    margin-bottom: 20px;
}

.empty-state-modern h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-600);
    margin-bottom: 8px;
}

.empty-state-modern p {
    color: var(--gray-400);
    margin-bottom: 24px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.empty-state-modern .search-term {
    background: var(--gray-100);
    padding: 4px 12px;
    border-radius: 30px;
    font-weight: 600;
    color: var(--gray-700);
    display: inline-block;
    margin-bottom: 16px;
}

/* Pagination */
.pagination-modern {
    display: flex;
    gap: 6px;
    justify-content: center;
    margin-top: 30px;
}

.pagination-modern .page-item {
    list-style: none;
}

.pagination-modern .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    border: 1px solid var(--gray-200);
    background: white;
    color: var(--gray-600);
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s;
    text-decoration: none;
}

.pagination-modern .page-link:hover {
    background: var(--gray-50);
    border-color: var(--gray-300);
    color: var(--gray-800);
    transform: translateY(-2px);
}

.pagination-modern .active .page-link {
    background: var(--primary-500);
    border-color: var(--primary-500);
    color: white;
}

/* Badge de résultat de recherche */
.search-result-badge {
    background: var(--primary-100);
    color: var(--primary-700);
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    border: 1px solid var(--primary-200);
}

/* Modal */
.modal-modern .modal-content {
    border-radius: 20px;
    border: none;
    overflow: hidden;
}

.modal-modern .modal-header {
    background: var(--gray-50);
    border-bottom: 1px solid var(--gray-200);
    padding: 20px 24px;
}

.modal-modern .modal-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--gray-700);
    display: flex;
    align-items: center;
    gap: 8px;
}

.modal-modern .modal-body {
    padding: 24px;
}

.modal-modern .modal-footer {
    background: var(--gray-50);
    border-top: 1px solid var(--gray-200);
    padding: 16px 24px;
}

/* Responsive */
@media (max-width: 768px) {
    .customers-page {
        padding: 16px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .action-bar {
        flex-direction: column;
        align-items: stretch;
    }
    
    .action-right {
        max-width: 100%;
    }
    
    .customer-grid {
        grid-template-columns: 1fr;
    }
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in {
    animation: fadeIn 0.3s ease-out forwards;
}

.stagger-1 { animation-delay: 0.05s; }
.stagger-2 { animation-delay: 0.1s; }
.stagger-3 { animation-delay: 0.15s; }
</style>

<div class="customers-page">
    <!-- Breadcrumb -->
    <div class="breadcrumb-custom">
        <a href="{{ route('dashboard.index') }}"><i class="fas fa-home fa-xs me-1"></i>Dashboard</a>
        <span class="separator"><i class="fas fa-chevron-right fa-xs"></i></span>
        <span class="current">Clients</span>
    </div>

    <!-- En-tête -->
    <div class="page-header">
        <div class="header-title">
            <span class="header-icon">
                <i class="fas fa-users"></i>
            </span>
            <h1>Gestion des Clients</h1>
        </div>
        <p class="header-subtitle">Gérez votre base de données clients et consultez leurs réservations</p>
    </div>

    <!-- Statistiques -->
    @php
        $totalClients = $customers->total();
        $resultCount = $customers->count();
    @endphp
    
    <div class="stats-grid">
        <div class="stat-card-modern primary fade-in stagger-1">
            <div class="stat-number">{{ $totalClients }}</div>
            <div class="stat-label">Clients totaux</div>
            <div class="stat-footer">
                <i class="fas fa-user"></i>
                {{ $totalClients }} enregistrés
            </div>
        </div>
        
        <div class="stat-card-modern success fade-in stagger-2">
            <div class="stat-number">{{ $resultCount }}</div>
            <div class="stat-label">Sur cette page</div>
            <div class="stat-footer">
                <i class="fas fa-users"></i>
                Page {{ $customers->currentPage() }}/{{ $customers->lastPage() }}
            </div>
        </div>
        
        <div class="stat-card-modern info fade-in stagger-3">
            <div class="stat-number">{{ $customers->lastPage() }}</div>
            <div class="stat-label">Pages totales</div>
            <div class="stat-footer">
                <i class="fas fa-layer-group"></i>
                {{ $customers->perPage() }} par page
            </div>
        </div>
    </div>

    <!-- Barre d'actions -->
    <div class="action-bar fade-in">
        <div class="action-left">
            <button class="btn-modern btn-primary-modern" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                <i class="fas fa-plus-circle"></i>
                Nouveau client
            </button>
            
            <div class="filter-badges">
                <a href="{{ route('customer.index') }}" class="filter-badge {{ !request()->has('search') || request()->search == '' ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    Tous
                    <span class="badge-count">{{ $totalClients }}</span>
                </a>
                @if(request()->has('search') && request()->search != '')
                <a href="{{ route('customer.index') }}" class="filter-badge">
                    <i class="fas fa-times"></i>
                    Effacer la recherche
                </a>
                @endif
            </div>
        </div>
        
        <div class="action-right">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <form method="GET" action="{{ route('customer.index') }}" id="search-form">
                    <input type="text" 
                           class="search-input" 
                           placeholder="Rechercher par nom, email, téléphone..." 
                           name="search" 
                           id="search-input"
                           value="{{ request()->input('search') }}"
                           autocomplete="off">
                    @if(request()->has('search') && request()->search != '')
                    <button type="button" class="search-clear" onclick="clearSearch()">
                        <i class="fas fa-times"></i>
                    </button>
                    <span class="search-result-badge" style="position: absolute; right: 40px; top: 50%; transform: translateY(-50%);">
                        <i class="fas fa-check-circle fa-xs me-1"></i>
                        {{ $customers->total() }} résultat(s)
                    </span>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Messages d'alerte -->
    @if(session('success'))
    <div class="alert-modern alert-success fade-in">
        <div class="alert-icon">
            <i class="fas fa-check"></i>
        </div>
        <div class="flex-grow-1">{!! session('success') !!}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    @if(session('error') || session('failed'))
    <div class="alert-modern alert-danger fade-in">
        <div class="alert-icon">
            <i class="fas fa-exclamation"></i>
        </div>
        <div class="flex-grow-1">{{ session('error') ?? session('failed') }}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Message de résultat de recherche -->
    @if(request()->has('search') && request()->search != '')
    <div class="alert-modern alert-info fade-in">
        <div class="alert-icon">
            <i class="fas fa-search"></i>
        </div>
        <div class="flex-grow-1">
            <strong>{{ $customers->total() }}</strong> résultat(s) pour la recherche "<strong>{{ e(request()->search) }}</strong>"
        </div>
        <a href="{{ route('customer.index') }}" class="btn-modern btn-sm-modern btn-outline-modern">
            <i class="fas fa-times me-1"></i>Effacer
        </a>
    </div>
    @endif

    <!-- Grille des clients -->
    @if($customers->count() > 0)
    <div class="customer-grid">
        @foreach ($customers as $customer)
        @php
            $index = ($customers->currentPage() - 1) * $customers->perPage() + $loop->index + 1;
            $reservationsCount = $customer->transactions()->count();
            $avatarUrl = $customer->user ? $customer->user->getAvatar() : null;
        @endphp
        
        <div class="customer-card fade-in" style="animation-delay: {{ $loop->index * 0.03 }}s">
            <!-- En-tête -->
            <div class="customer-header">
                <span class="customer-badge">
                    <i class="fas fa-star"></i>
                    Client #{{ $index }}
                </span>
                <span class="customer-number">{{ $index }}</span>
                
                @if($avatarUrl)
                <img src="{{ $avatarUrl }}" 
                     alt="{{ $customer->name }}" 
                     class="customer-avatar"
                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background=059669&color=fff&size=80'">
                @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background=059669&color=fff&size=80" 
                     alt="{{ $customer->name }}" 
                     class="customer-avatar">
                @endif
            </div>
            
            <!-- Corps -->
            <div class="customer-body">
                <div class="customer-name">
                    <a href="{{ route('customer.show', $customer->id) }}" class="text-decoration-none">
                        {{ $customer->name }}
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-sm p-0" style="color: var(--gray-400);" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-modern">
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.show', $customer->id) }}">
                                    <i class="fas fa-eye me-2"></i>Voir le profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('transaction.reservation.customerReservations', $customer->id) }}">
                                    <i class="fas fa-calendar-check me-2"></i>Voir ses réservations
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.edit', $customer->id) }}">
                                    <i class="fas fa-edit me-2"></i>Modifier
                                </a>
                            </li>
                            <li>
                                <button class="dropdown-item text-danger" onclick="confirmDelete('{{ $customer->name }}', {{ $customer->id }})">
                                    <i class="fas fa-trash me-2"></i>Supprimer
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Informations -->
                @if($customer->user)
                <div class="customer-info-item">
                    <div class="customer-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div style="flex: 1;">
                        <div class="customer-info-label">Email</div>
                        <div class="customer-info-value">{{ $customer->user->email }}</div>
                    </div>
                </div>
                @endif
                
                @if($customer->phone)
                <div class="customer-info-item">
                    <div class="customer-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div style="flex: 1;">
                        <div class="customer-info-label">Téléphone</div>
                        <div class="customer-info-value">{{ $customer->phone }}</div>
                    </div>
                </div>
                @endif
                
                @if($customer->job)
                <div class="customer-info-item">
                    <div class="customer-info-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div style="flex: 1;">
                        <div class="customer-info-label">Profession</div>
                        <div class="customer-info-value">{{ $customer->job }}</div>
                    </div>
                </div>
                @endif
                
                @if($customer->birthdate)
                <div class="customer-info-item">
                    <div class="customer-info-icon">
                        <i class="fas fa-cake-candles"></i>
                    </div>
                    <div style="flex: 1;">
                        <div class="customer-info-label">Date de naissance</div>
                        <div class="customer-info-value">
                            {{ \Carbon\Carbon::parse($customer->birthdate)->format('d/m/Y') }}
                            ({{ \Carbon\Carbon::parse($customer->birthdate)->age }} ans)
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="customer-info-item">
                    <div class="customer-info-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div style="flex: 1;">
                        <div class="customer-info-label">Réservations</div>
                        <div class="customer-info-value">
                            <span class="badge" style="background: var(--primary-100); color: var(--primary-700); padding: 4px 8px; border-radius: 6px;">
                                {{ $reservationsCount }} réservation(s)
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer avec actions -->
            <div class="customer-footer">
                <a href="{{ route('customer.show', $customer->id) }}" class="customer-action-btn primary">
                    <i class="fas fa-user"></i>
                    Profil
                </a>
                <a href="{{ route('transaction.reservation.customerReservations', $customer->id) }}" class="customer-action-btn">
                    <i class="fas fa-calendar-check"></i>
                    Réservations
                </a>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    @if($customers->hasPages())
    <div class="pagination-modern fade-in">
        {{ $customers->onEachSide(2)->links('pagination::bootstrap-5') }}
    </div>
    @endif
    
    @elseif(request()->has('search') && request()->search != '')
    <!-- État vide avec recherche -->
    <div class="empty-state-modern fade-in">
        <i class="fas fa-search"></i>
        <div class="search-term">
            Recherche : "{{ e(request()->search) }}"
        </div>
        <h3>Aucun client trouvé</h3>
        <p>
            Aucun client ne correspond à votre recherche.<br>
            Essayez d'autres termes ou ajoutez un nouveau client.
        </p>
        <div class="d-flex gap-2 justify-content-center">
            <a href="{{ route('customer.index') }}" class="btn-modern btn-outline-modern">
                <i class="fas fa-times me-2"></i>Effacer la recherche
            </a>
            <button class="btn-modern btn-primary-modern" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                <i class="fas fa-plus-circle me-2"></i>Ajouter un client
            </button>
        </div>
    </div>
    @else
    <!-- État vide sans recherche -->
    <div class="empty-state-modern fade-in">
        <i class="fas fa-users"></i>
        <h3>Aucun client pour le moment</h3>
        <p>Commencez par ajouter votre premier client à votre base de données.</p>
        <button class="btn-modern btn-primary-modern" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            <i class="fas fa-plus-circle me-2"></i>Ajouter un client
        </button>
    </div>
    @endif

    <!-- Modal d'ajout -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-modern">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus" style="color: var(--primary-500);"></i>
                        Nouveau client
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <div style="font-size: 4rem; color: var(--primary-100); margin-bottom: 16px;">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h6 class="fw-semibold mb-3">Choisissez une méthode</h6>
                    <p class="text-muted small mb-4">Sélectionnez comment vous souhaitez ajouter un nouveau client.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('customer.create') }}" class="btn-modern btn-primary-modern w-100">
                            <i class="fas fa-user-plus me-2"></i>
                            Créer un nouveau compte
                        </a>
                        <button type="button" class="btn-modern btn-outline-modern w-100" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulaire de suppression caché -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (el) {
        return new bootstrap.Tooltip(el);
    });

    // Auto-dismiss des alertes après 5 secondes
    const alerts = document.querySelectorAll('.alert-modern');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    // Debounce pour la recherche (attend que l'utilisateur arrête de taper)
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('search-form').submit();
            }, 500); // Attend 500ms après la dernière frappe
        });

        // Soumettre avec la touche Entrée
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('search-form').submit();
            }
        });
    }

    // Confirmation de suppression avec SweetAlert
    window.confirmDelete = function(name, id) {
        Swal.fire({
            title: 'Confirmer la suppression',
            html: `Êtes-vous sûr de vouloir supprimer <strong>${name}</strong> ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<i class="fas fa-trash me-2"></i>Supprimer',
            cancelButtonText: '<i class="fas fa-times me-2"></i>Annuler',
            reverseButtons: true,
            background: '#ffffff',
            borderRadius: '12px',
            customClass: {
                popup: 'shadow-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('delete-form');
                form.action = `/customer/${id}`;
                form.submit();
            }
        });
    };

    // Raccourcis clavier
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + N pour nouveau client
        if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('addCustomerModal'));
            modal.show();
        }
        
        // / pour focus recherche
        if (e.key === '/' && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
            e.preventDefault();
            document.getElementById('search-input')?.focus();
        }
        
        // Esc pour effacer la recherche (si le champ est vide)
        if (e.key === 'Escape' && document.activeElement === searchInput && !searchInput.value) {
            document.activeElement.blur();
        }
    });
});

// Fonction pour effacer la recherche
function clearSearch() {
    const input = document.getElementById('search-input');
    if (input) {
        input.value = '';
        document.getElementById('search-form').submit();
    }
}
</script>
@endsection