@extends('template.master')
@section('title', 'Profil Client - ' . $customer->name)
@section('content')

<style>
/* ═══════════════════════════════════════════════════════════════
   DESIGN SYSTEM - MÊME STYLE QUE GESTION DES CLIENTS
═══════════════════════════════════════════════════════════════════ */
:root {
    --primary-50: #fdf5ec;
    --primary-100: #f7e7d1;
    --primary-400: #e0a05a;
    --primary-500: #cd853f;
    --primary-600: #b87333;
    --primary-700: #654321;
    --primary-800: #4d3319;

    --amber-50: #fdf5ec;
    --amber-100: #f7e7d1;
    --amber-400: #cd853f;
    --amber-500: #cd853f;
    --amber-600: #b87333;

    --blue-50: #fdf5ec;
    --blue-100: #f7e7d1;
    --blue-500: #cd853f;
    --blue-600: #cd853f;

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

    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
}

* { box-sizing: border-box; }

.profile-page {
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
    box-shadow: 0 4px 10px rgba(101, 67, 33, 0.3);
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
    box-shadow: 0 4px 6px -1px rgba(101, 67, 33, 0.3);
}

.btn-primary-modern:hover {
    background: linear-gradient(135deg, var(--primary-800), var(--primary-600));
    transform: translateY(-1px);
    box-shadow: 0 6px 8px -1px rgba(101, 67, 33, 0.4);
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

.btn-warning-modern {
    background: linear-gradient(135deg, #b87333, #cd853f);
    color: white;
    box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.3);
}

.btn-warning-modern:hover {
    background: linear-gradient(135deg, #b45309, #b87333);
    transform: translateY(-1px);
    box-shadow: 0 6px 8px -1px rgba(245, 158, 11, 0.4);
    color: white;
    text-decoration: none;
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
    background: #f5ecec;
    border-color: #e7d1d1;
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
    background: #654321;
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

/* Carte profil */
.profile-card {
    background: white;
    border-radius: 20px;
    border: 1px solid var(--gray-200);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 24px;
}

.profile-header {
    background: linear-gradient(135deg, var(--primary-700), var(--primary-500));
    padding: 30px 24px;
    position: relative;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid white;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    object-fit: cover;
    background: white;
    margin-bottom: 16px;
}

.profile-name {
    font-size: 1.75rem;
    font-weight: 700;
    color: white;
    margin-bottom: 4px;
}

.profile-job {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin-bottom: 12px;
}

.profile-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(4px);
    padding: 6px 16px;
    border-radius: 30px;
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.profile-body {
    padding: 24px;
}

.profile-section {
    margin-bottom: 28px;
}

.profile-section-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--gray-700);
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 1px solid var(--gray-200);
}

.profile-section-title i {
    color: var(--primary-500);
}

.profile-info-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid var(--gray-100);
}

.profile-info-item:last-child {
    border-bottom: none;
}

.profile-info-icon {
    width: 24px;
    color: var(--gray-400);
    font-size: 0.9rem;
    margin-top: 2px;
}

.profile-info-label {
    font-size: 0.688rem;
    color: var(--gray-500);
    margin-bottom: 2px;
}

.profile-info-value {
    font-size: 0.875rem;
    color: var(--gray-700);
    font-weight: 500;
}

/* Cartes de réservation */
.reservation-card {
    background: white;
    border-radius: 16px;
    border: 1px solid var(--gray-200);
    overflow: hidden;
    transition: all 0.2s;
    margin-bottom: 16px;
}

.reservation-card:hover {
    box-shadow: var(--shadow-md);
    border-color: var(--gray-300);
}

.reservation-header {
    background: var(--gray-50);
    padding: 16px 20px;
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}

.reservation-room {
    display: flex;
    align-items: center;
    gap: 12px;
}

.reservation-room-icon {
    width: 40px;
    height: 40px;
    background: var(--primary-100);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-700);
    font-size: 1rem;
}

.reservation-room-info h6 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 2px;
}

.reservation-room-info small {
    color: var(--gray-500);
    font-size: 0.75rem;
}

.reservation-status {
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.status-active {
    background: var(--primary-100);
    color: var(--primary-700);
    border: 1px solid var(--primary-200);
}

.status-upcoming {
    background: var(--blue-100);
    color: var(--blue-700);
    border: 1px solid var(--blue-200);
}

.status-completed {
    background: var(--gray-100);
    color: var(--gray-600);
    border: 1px solid var(--gray-200);
}

.reservation-body {
    padding: 20px;
}

.reservation-dates {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
    flex-wrap: wrap;
    gap: 16px;
}

.reservation-date {
    display: flex;
    align-items: center;
    gap: 12px;
}

.reservation-date-icon {
    width: 40px;
    height: 40px;
    background: var(--gray-100);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-600);
    font-size: 1rem;
}

.reservation-date-info .label {
    font-size: 0.688rem;
    color: var(--gray-500);
    margin-bottom: 2px;
}

.reservation-date-info .value {
    font-size: 1rem;
    font-weight: 600;
    color: var(--gray-800);
}

.reservation-date-info .time {
    font-size: 0.75rem;
    color: var(--gray-400);
}

.reservation-separator {
    color: var(--gray-300);
    font-size: 0.875rem;
}

.reservation-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 16px;
    padding: 16px 0;
    border-top: 1px dashed var(--gray-200);
    border-bottom: 1px dashed var(--gray-200);
    margin-bottom: 16px;
}

.reservation-detail-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.reservation-detail-label {
    font-size: 0.688rem;
    color: var(--gray-500);
}

.reservation-detail-value {
    font-size: 1rem;
    font-weight: 600;
    color: var(--gray-800);
}

.reservation-detail-value small {
    font-size: 0.75rem;
    font-weight: 400;
    color: var(--gray-500);
}

.reservation-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* Grille de réservations */
.reservations-grid {
    display: grid;
    gap: 20px;
}

/* Quick actions */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.quick-action-card {
    background: var(--gray-50);
    border-radius: 16px;
    padding: 20px;
    text-align: center;
    border: 1px solid var(--gray-200);
    transition: all 0.2s;
    cursor: pointer;
    text-decoration: none;
    color: var(--gray-700);
}

.quick-action-card:hover {
    background: white;
    border-color: var(--primary-200);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    color: var(--primary-700);
    text-decoration: none;
}

.quick-action-icon {
    width: 48px;
    height: 48px;
    background: var(--primary-100);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    color: var(--primary-700);
    font-size: 1.25rem;
    transition: all 0.2s;
}

.quick-action-card:hover .quick-action-icon {
    background: var(--primary-500);
    color: white;
}

.quick-action-title {
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 4px;
}

.quick-action-subtitle {
    font-size: 0.688rem;
    color: var(--gray-500);
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
.stagger-4 { animation-delay: 0.2s; }

/* Responsive */
@media (max-width: 768px) {
    .profile-page {
        padding: 16px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .profile-header {
        text-align: center;
    }
    
    .reservation-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .reservation-dates {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .reservation-separator {
        display: none;
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="profile-page">
    <!-- Breadcrumb -->
    <div class="breadcrumb-custom fade-in">
        <a href="{{ route('dashboard.index') }}"><i class="fas fa-home fa-xs me-1"></i>Dashboard</a>
        <span class="separator"><i class="fas fa-chevron-right fa-xs"></i></span>
        <a href="{{ route('customer.index') }}">Clients</a>
        <span class="separator"><i class="fas fa-chevron-right fa-xs"></i></span>
        <span class="current">Profil client</span>
    </div>

    <!-- En-tête -->
    <div class="page-header fade-in">
        <div class="header-title">
            <span class="header-icon">
                <i class="fas fa-user"></i>
            </span>
            <h1>{{ $customer->name }}</h1>
        </div>
        <p class="header-subtitle">Fiche client détaillée et historique des réservations</p>
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

    @if(session('error'))
    <div class="alert-modern alert-danger fade-in">
        <div class="alert-icon">
            <i class="fas fa-exclamation"></i>
        </div>
        <div class="flex-grow-1">{{ session('error') }}</div>
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Statistiques -->
    @php
        $totalReservations = $customer->transactions->count();
        $activeReservations = $customer->transactions->where('check_out', '>=', now())->count();
        $completedReservations = $customer->transactions->where('check_out', '<', now())->count();
        
        $totalNights = 0;
        foreach($customer->transactions as $transaction) {
            $checkIn = \Carbon\Carbon::parse($transaction->check_in);
            $checkOut = \Carbon\Carbon::parse($transaction->check_out);
            $totalNights += $checkIn->diffInDays($checkOut);
        }
    @endphp
    
    <div class="stats-grid fade-in">
        <div class="stat-card-modern primary stagger-1">
            <div class="stat-number">{{ $totalReservations }}</div>
            <div class="stat-label">Réservations totales</div>
            <div class="stat-footer">
                <i class="fas fa-calendar-check"></i>
                {{ $activeReservations }} en cours
            </div>
        </div>
        
        <div class="stat-card-modern success stagger-2">
            <div class="stat-number">{{ $totalNights }}</div>
            <div class="stat-label">Nuits passées</div>
            <div class="stat-footer">
                <i class="fas fa-moon"></i>
                {{ $totalNights > 0 ? round($totalNights / $totalReservations, 1) : 0 }} nuits/séjour
            </div>
        </div>
        
        <div class="stat-card-modern info stagger-3">
            <div class="stat-number">{{ $customer->created_at->format('d/m/Y') }}</div>
            <div class="stat-label">Client depuis</div>
            <div class="stat-footer">
                <i class="fas fa-clock"></i>
                {{ $customer->created_at->diffForHumans() }}
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Colonne gauche - Profil -->
        <div class="col-lg-4">
            <!-- Carte profil -->
            <div class="profile-card fade-in stagger-1">
                <div class="profile-header">
                    <div style="text-align: center;">
                        @php
                            $user = $customer->user;
                            $hasCustomAvatar = $user && !$user->hasDefaultAvatar();
                            $avatarUrl = $hasCustomAvatar ? $user->getAvatar() : "https://ui-avatars.com/api/?name=".urlencode($customer->name)."&background=cd853f&color=fff&size=120";
                        @endphp
                        
                        <img src="{{ $avatarUrl }}" 
                             alt="{{ $customer->name }}" 
                             class="profile-avatar"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background=cd853f&color=fff&size=120'">
                        
                        <h2 class="profile-name">{{ $customer->name }}</h2>
                        @if($customer->job)
                        <div class="profile-job">{{ $customer->job }}</div>
                        @endif
                        
                        <span class="profile-badge">
                            <i class="fas fa-user"></i>
                            Client #{{ $customer->id }}
                        </span>
                    </div>
                </div>
                
                <div class="profile-body">
                    <!-- Informations de contact -->
                    <div class="profile-section">
                        <h6 class="profile-section-title">
                            <i class="fas fa-address-card"></i>
                            Informations de contact
                        </h6>
                        
                        @if($customer->email)
                        <div class="profile-info-item">
                            <div class="profile-info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="profile-info-label">Email</div>
                                <div class="profile-info-value">
                                    <a href="mailto:{{ $customer->email }}" class="text-decoration-none" style="color: var(--primary-600);">
                                        {{ $customer->email }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if($customer->phone)
                        <div class="profile-info-item">
                            <div class="profile-info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="profile-info-label">Téléphone</div>
                                <div class="profile-info-value">
                                    <a href="tel:{{ $customer->phone }}" class="text-decoration-none" style="color: var(--gray-700);">
                                        {{ $customer->phone }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if($customer->address)
                        <div class="profile-info-item">
                            <div class="profile-info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="profile-info-label">Adresse</div>
                                <div class="profile-info-value">{{ $customer->address }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Informations personnelles -->
                    <div class="profile-section">
                        <h6 class="profile-section-title">
                            <i class="fas fa-user-circle"></i>
                            Informations personnelles
                        </h6>
                        
                        @if($customer->gender)
                        <div class="profile-info-item">
                            <div class="profile-info-icon">
                                <i class="fas fa-venus-mars"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="profile-info-label">Genre</div>
                                <div class="profile-info-value">{{ $customer->gender }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($customer->birthdate)
                        <div class="profile-info-item">
                            <div class="profile-info-icon">
                                <i class="fas fa-cake-candles"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="profile-info-label">Date de naissance</div>
                                <div class="profile-info-value">
                                    {{ \Carbon\Carbon::parse($customer->birthdate)->format('d/m/Y') }}
                                    ({{ \Carbon\Carbon::parse($customer->birthdate)->age }} ans)
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if($customer->job)
                        <div class="profile-info-item">
                            <div class="profile-info-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="profile-info-label">Profession</div>
                                <div class="profile-info-value">{{ $customer->job }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Actions rapides -->
                    <div class="profile-section">
                        <h6 class="profile-section-title">
                            <i class="fas fa-bolt"></i>
                            Actions rapides
                        </h6>
                        
                        <div class="quick-actions">
                            <a href="{{ route('customer.edit', $customer->id) }}" class="quick-action-card">
                                <div class="quick-action-icon">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div class="quick-action-title">Modifier</div>
                                <div class="quick-action-subtitle">Mettre à jour les infos</div>
                            </a>
                            
                            <a href="{{ route('transaction.reservation.createIdentity') }}?customer_id={{ $customer->id }}" 
                               class="quick-action-card">
                                <div class="quick-action-icon">
                                    <i class="fas fa-calendar-plus"></i>
                                </div>
                                <div class="quick-action-title">Nouvelle réservation</div>
                                <div class="quick-action-subtitle">Ajouter un séjour</div>
                            </a>
                            
                            <a href="{{ route('transaction.reservation.customerReservations', $customer->id) }}" 
                               class="quick-action-card">
                                <div class="quick-action-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <div class="quick-action-title">Historique</div>
                                <div class="quick-action-subtitle">Voir toutes les réservations</div>
                            </a>
                            
                            <a href="{{ route('customer.index') }}" class="quick-action-card">
                                <div class="quick-action-icon">
                                    <i class="fas fa-arrow-left"></i>
                                </div>
                                <div class="quick-action-title">Retour</div>
                                <div class="quick-action-subtitle">Liste des clients</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Colonne droite - Réservations -->
        <div class="col-lg-8">
            <!-- Réservations actuelles et à venir -->
            <div class="profile-card fade-in stagger-2">
                <div class="profile-header" style="background: linear-gradient(135deg, var(--gray-700), var(--gray-800));">
                    <h3 class="text-white mb-0" style="font-size: 1.25rem;">
                        <i class="fas fa-calendar-check me-2"></i>
                        Réservations actuelles et à venir
                    </h3>
                    <span class="profile-badge mt-2">
                        <i class="fas fa-clock me-1"></i>
                        {{ $activeReservations }} réservation(s)
                    </span>
                </div>
                
                <div class="profile-body">
                    @php
                        $activeStays = $customer->transactions()
                            ->where('check_out', '>=', now())
                            ->orderBy('check_in', 'desc')
                            ->with('room')
                            ->get();
                    @endphp
                    
                    @if($activeStays->count() > 0)
                        <div class="reservations-grid">
                            @foreach($activeStays as $transaction)
                                @php
                                    $isActive = $transaction->check_in <= now() && $transaction->check_out >= now();
                                    $isFuture = $transaction->check_in > now();
                                    
                                    $checkIn = \Carbon\Carbon::parse($transaction->check_in);
                                    $checkOut = \Carbon\Carbon::parse($transaction->check_out);
                                    $nights = $checkIn->diffInDays($checkOut);
                                    
                                    $totalPrice = $transaction->total_price;
                                    $balance = $transaction->getTotalPrice() - $transaction->getTotalPayment();
                                @endphp
                                
                                <div class="reservation-card">
                                    <div class="reservation-header">
                                        <div class="reservation-room">
                                            <div class="reservation-room-icon">
                                                <i class="fas fa-bed"></i>
                                            </div>
                                            <div class="reservation-room-info">
                                                <h6>Chambre {{ $transaction->room->number ?? 'N/A' }}</h6>
                                                <small>{{ $transaction->room->type->name ?? 'Standard' }}</small>
                                            </div>
                                        </div>
                                        
                                        <span class="reservation-status {{ $isActive ? 'status-active' : 'status-upcoming' }}">
                                            <i class="fas {{ $isActive ? 'fa-user-check' : 'fa-calendar' }}"></i>
                                            {{ $isActive ? 'En cours' : 'À venir' }}
                                        </span>
                                    </div>
                                    
                                    <div class="reservation-body">
                                        <div class="reservation-dates">
                                            <div class="reservation-date">
                                                <div class="reservation-date-icon">
                                                    <i class="fas fa-sign-in-alt"></i>
                                                </div>
                                                <div class="reservation-date-info">
                                                    <div class="label">Arrivée</div>
                                                    <div class="value">{{ $checkIn->format('d/m/Y') }}</div>
                                                    <div class="time">{{ $checkIn->format('H:i') }}</div>
                                                </div>
                                            </div>
                                            
                                            <div class="reservation-separator">
                                                <i class="fas fa-arrow-right"></i>
                                            </div>
                                            
                                            <div class="reservation-date">
                                                <div class="reservation-date-icon">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                </div>
                                                <div class="reservation-date-info">
                                                    <div class="label">Départ</div>
                                                    <div class="value">{{ $checkOut->format('d/m/Y') }}</div>
                                                    <div class="time">{{ $checkOut->format('H:i') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="reservation-details">
                                            <div class="reservation-detail-item">
                                                <span class="reservation-detail-label">Nuits</span>
                                                <span class="reservation-detail-value">{{ $nights }}</span>
                                            </div>
                                            
                                            <div class="reservation-detail-item">
                                                <span class="reservation-detail-label">Personnes</span>
                                                <span class="reservation-detail-value">{{ $transaction->person_count ?? 1 }}</span>
                                            </div>
                                            
                                            <div class="reservation-detail-item">
                                                <span class="reservation-detail-label">Prix total</span>
                                                <span class="reservation-detail-value">
                                                    {{ number_format($totalPrice, 0, ',', ' ') }} FCFA
                                                </span>
                                            </div>
                                            
                                            @if($balance > 0)
                                            <div class="reservation-detail-item">
                                                <span class="reservation-detail-label">Solde restant</span>
                                                <span class="reservation-detail-value" style="color: var(--amber-600);">
                                                    {{ number_format($balance, 0, ',', ' ') }} FCFA
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                        
                                        <div class="reservation-footer">
                                            <a href="{{ route('transaction.show', $transaction->id) }}" 
                                               class="btn-modern btn-sm-modern btn-outline-modern">
                                                <i class="fas fa-eye me-1"></i>Détails
                                            </a>
                                            
                                            @if($balance > 0)
                                            <a href="{{ route('transaction.payment.create', $transaction->id) }}" 
                                               class="btn-modern btn-sm-modern btn-primary-modern">
                                                <i class="fas fa-credit-card me-1"></i>Paiement
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3" style="opacity: 0.5;"></i>
                            <h6 class="text-dark mb-2">Aucune réservation en cours</h6>
                            <p class="text-muted mb-4 small">Ce client n'a pas de réservation active ou à venir</p>
                            <a href="{{ route('transaction.reservation.createIdentity', ['customer_id' => $customer->id]) }}" 
                               class="btn btn-hotel-primary btn-sm">
                                <i class="fas fa-plus-circle me-2" style="color: white !important;"></i>Créer une réservation
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Historique des réservations -->
            @php
                $pastStays = $customer->transactions()
                    ->where('check_out', '<', now())
                    ->orderBy('check_out', 'desc')
                    ->with('room')
                    ->take(5)
                    ->get();
            @endphp
            
            @if($pastStays->count() > 0)
            <div class="profile-card fade-in stagger-3 mt-4">
                <div class="profile-header" style="background: linear-gradient(135deg, var(--gray-600), var(--gray-700));">
                    <h3 class="text-white mb-0" style="font-size: 1.25rem;">
                        <i class="fas fa-history me-2"></i>
                        Historique des réservations
                    </h3>
                    <span class="profile-badge mt-2">
                        <i class="fas fa-check-circle me-1"></i>
                        {{ $completedReservations }} séjour(s) terminé(s)
                    </span>
                </div>
                
                <div class="profile-body">
                    <div class="reservations-grid">
                        @foreach($pastStays as $transaction)
                            @php
                                $checkIn = \Carbon\Carbon::parse($transaction->check_in);
                                $checkOut = \Carbon\Carbon::parse($transaction->check_out);
                                $nights = $checkIn->diffInDays($checkOut);
                                $totalPrice = $transaction->total_price;
                            @endphp
                            
                            <div class="reservation-card">
                                <div class="reservation-header">
                                    <div class="reservation-room">
                                        <div class="reservation-room-icon">
                                            <i class="fas fa-bed"></i>
                                        </div>
                                        <div class="reservation-room-info">
                                            <h6>Chambre {{ $transaction->room->number ?? 'N/A' }}</h6>
                                            <small>{{ $transaction->room->type->name ?? 'Standard' }}</small>
                                        </div>
                                    </div>
                                    
                                    <span class="reservation-status status-completed">
                                        <i class="fas fa-check-circle"></i>
                                        Terminé
                                    </span>
                                </div>
                                
                                <div class="reservation-body">
                                    <div class="reservation-dates mb-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <small class="text-muted">Du</small>
                                                <div class="fw-semibold">{{ $checkIn->format('d/m/Y') }}</div>
                                            </div>
                                            <i class="fas fa-arrow-right text-muted"></i>
                                            <div>
                                                <small class="text-muted">Au</small>
                                                <div class="fw-semibold">{{ $checkOut->format('d/m/Y') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="reservation-details">
                                        <div class="reservation-detail-item">
                                            <span class="reservation-detail-label">Nuits</span>
                                            <span class="reservation-detail-value">{{ $nights }}</span>
                                        </div>
                                        
                                        <div class="reservation-detail-item">
                                            <span class="reservation-detail-label">Total</span>
                                            <span class="reservation-detail-value">
                                                {{ number_format($totalPrice, 0, ',', ' ') }} FCFA
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="reservation-footer">
                                        <a href="{{ route('transaction.show', $transaction->id) }}" 
                                           class="btn-modern btn-sm-modern btn-outline-modern">
                                            <i class="fas fa-eye me-1"></i>Voir détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($completedReservations > 5)
                    <div class="text-center mt-4">
                        <a href="{{ route('transaction.reservation.customerReservations', $customer->id) }}" 
                           class="btn-modern btn-outline-modern">
                            <i class="fas fa-history me-2"></i>Voir tout l'historique
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss des alertes après 5 secondes
    const alerts = document.querySelectorAll('.alert-modern');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    // Raccourcis clavier
    document.addEventListener('keydown', function(e) {
        // E pour éditer
        if ((e.ctrlKey || e.metaKey) && e.key === 'e') {
            e.preventDefault();
            window.location.href = "{{ route('customer.edit', $customer->id) }}";
        }
        
        // N pour nouvelle réservation
        if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
            e.preventDefault();
            window.location.href = "{{ route('transaction.reservation.createIdentity') }}?customer_id={{ $customer->id }}";
        }
        
        // B pour retour à la liste
        if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
            e.preventDefault();
            window.location.href = "{{ route('customer.index') }}";
        }
        
        // ? pour aide
        if (e.key === '?' && !e.ctrlKey && !e.metaKey) {
            e.preventDefault();
            Swal.fire({
                title: 'Raccourcis clavier',
                html: `
                    <div style="text-align: left;">
                        <p><kbd>Ctrl+E</kbd> : Modifier le profil</p>
                        <p><kbd>Ctrl+N</kbd> : Nouvelle réservation</p>
                        <p><kbd>Ctrl+B</kbd> : Retour à la liste</p>
                    </div>
                `,
                icon: 'info',
                confirmButtonColor: '#cd853f'
            });
        }
    });
});
</script>
@endsection