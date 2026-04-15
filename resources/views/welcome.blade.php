@extends('frontend.layouts.master')

@section('title', 'Check-Sys - Système Multitenant')

@push('styles')
<style>
/* Styles pour les cartes de tenants */
.tenant-card {
    transition: all 0.3s ease;
    position: relative;
}

.tenant-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.tenant-header {
    position: relative;
    overflow: hidden;
}

.tenant-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
    transform: rotate(45deg);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

.stat-item {
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: scale(1.05);
}

.tenant-info .d-flex {
    transition: all 0.2s ease;
}

.tenant-info .d-flex:hover {
    transform: translateX(5px);
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

/* Animation d'apparition */
.tenant-card {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.tenant-card:nth-child(1) { animation-delay: 0.1s; }
.tenant-card:nth-child(2) { animation-delay: 0.2s; }
.tenant-card:nth-child(3) { animation-delay: 0.3s; }
.tenant-card:nth-child(4) { animation-delay: 0.4s; }
.tenant-card:nth-child(5) { animation-delay: 0.5s; }
.tenant-card:nth-child(6) { animation-delay: 0.6s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .tenant-card {
        margin-bottom: 1.5rem;
    }
    
    .stat-item {
        font-size: 0.9rem;
    }
}
</style>
@endpush

@section('content')
<div class="container-fluid py-5" style="background-color: #f4f1e8; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold mb-4" style="color: #654321;">
                    <i class="fas fa-building me-3" style="color: #8b4513;"></i>
                    Check-Sys
                </h1>
                <p class="lead" style="color: #a0522d;">
                    Système de gestion multitenant pour hôtels
                </p>
            </div>

            @php
                    try {
                        $tenants = \App\Models\Tenant::where('status', 1)->get();
                        $dbError = null;
                    } catch (\Exception $e) {
                        $tenants = collect([]);
                        $dbError = $e->getMessage();
                    }
                @endphp

            @if(isset($dbError))
            <!-- Message d'erreur de connexion -->
            <div class="alert alert-danger text-center mb-4" style="background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 10px; padding: 15px;">
                <h5 style="color: #721c24;">
                    <i class="fas fa-database me-2"></i>
                    Erreur de Connexion MySQL
                </h5>
                <p class="mb-2" style="color: #721c24;">
                    Impossible de se connecter à la base de données pour récupérer les tenants.
                </p>
                <p class="mb-2" style="color: #856404; font-size: 0.85rem;">
                    <strong>Détail technique :</strong><br>
                    {{ substr($dbError, 0, 150) }}...
                </p>
                <p class="mb-0" style="color: #721c24;">
                    <strong>Solution immédiate :</strong><br>
                    1. Démarrer MySQL dans XAMPP Control Panel<br>
                    2. Rafraîchir cette page (F5)<br>
                    3. Les tenants s'afficheront automatiquement
                </p>
            </div>
            @else
            <!-- Message d'information normal -->
            <div class="alert alert-info text-center mb-4" style="background-color: #d1ecf1; border: 1px solid #bee5eb; border-radius: 10px; padding: 15px;">
                <h5 style="color: #0c5460;">
                    <i class="fas fa-info-circle me-2"></i>
                    Système Multitenant Check-Sys
                </h5>
                <p class="mb-0" style="color: #0c5460;">
                    @if($tenants->count() > 0)
                        {{ $tenants->count() }} hôtel{{ $tenants->count() > 1 ? 's' : '' }} configuré{{ $tenants->count() > 1 ? 's' : '' }} dans le système
                    @else
                        Aucun hôtel configuré dans le système. <br>
                        <small>Contactez l'administrateur pour ajouter un nouveau tenant.</small>
                    @endif
                </p>
            </div>
            @endif

            <!-- Liste des tenants -->
            <div class="row">
                
                @if($tenants->count() > 0)
                    @foreach($tenants as $tenant)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-0 shadow-lg h-100 tenant-card" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); border-radius: 20px; border: none; overflow: hidden; transition: all 0.3s ease;">
                            <!-- Header avec logo ou icône -->
                            <div class="tenant-header" style="background: linear-gradient(135deg, {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }} 0%, {{ $tenant->theme_settings['secondary_color'] ?? '#a0522d' }} 100%); padding: 20px; text-align: center;">
                                @if($tenant->logo)
                                    <img src="{{ asset('storage/logos/' . $tenant->logo) }}" alt="{{ $tenant->name }}" style="width: 60px; height: 60px; border-radius: 12px; object-fit: cover; border: 3px solid rgba(255,255,255,0.3);">
                                @else
                                    <div style="width: 60px; height: 60px; border-radius: 12px; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                        <i class="fas fa-hotel fa-2x" style="color: white;"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="card-body p-4">
                                <h4 class="card-title mb-2" style="color: #2c3e50; font-weight: 700;">{{ $tenant->name }}</h4>
                                
                                @if($tenant->description)
                                <p class="card-text mb-3" style="color: #6c757d; font-size: 0.9rem; line-height: 1.5;">
                                    {{ Str::limit($tenant->description, 100) }}
                                </p>
                                @else
                                <p class="card-text mb-3" style="color: #6c757d; font-size: 0.9rem;">
                                    Système de gestion hôtelière complet
                                </p>
                                @endif

                                <!-- Informations de contact -->
                                <div class="tenant-info mb-3">
                                    @if($tenant->contact_email)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope me-2" style="color: {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }}; font-size: 0.8rem;"></i>
                                        <small style="color: #6c757d;">{{ $tenant->contact_email }}</small>
                                    </div>
                                    @endif
                                    
                                    @if($tenant->contact_phone)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-phone me-2" style="color: {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }}; font-size: 0.8rem;"></i>
                                        <small style="color: #6c757d;">{{ $tenant->contact_phone }}</small>
                                    </div>
                                    @endif
                                    
                                    @if($tenant->address)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt me-2" style="color: {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }}; font-size: 0.8rem;"></i>
                                        <small style="color: #6c757d;">{{ Str::limit($tenant->address, 50) }}</small>
                                    </div>
                                    @endif
                                </div>

                                <!-- Statistiques -->
                                <div class="tenant-stats mb-3">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <div class="stat-item">
                                                <div style="font-size: 1.2rem; font-weight: 700; color: {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }};">
                                                    {{ App\Models\Room::where('tenant_id', $tenant->id)->count() }}
                                                </div>
                                                <small style="color: #6c757d; font-size: 0.75rem;">Chambres</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="stat-item">
                                                <div style="font-size: 1.2rem; font-weight: 700; color: {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }};">
                                                    {{ App\Models\Transaction::where('tenant_id', $tenant->id)->whereIn('status', ['active', 'reservation'])->count() }}
                                                </div>
                                                <small style="color: #6c757d; font-size: 0.75rem;">Réservations</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="stat-item">
                                                <div style="font-size: 1.2rem; font-weight: 700; color: {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }};">
                                                    {{ App\Models\User::where('tenant_id', $tenant->id)->count() }}
                                                </div>
                                                <small style="color: #6c757d; font-size: 0.75rem;">Utilisateurs</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Badge de statut -->
                                <div class="mb-3">
                                    <span class="badge" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Actif et Opérationnel
                                    </span>
                                </div>

                                <!-- Bouton d'accès -->
                                @if($tenant->id)
                                    <a href="{{ url('/hotel') }}?hotel_id={{ $tenant->id }}" class="btn w-100" style="background: linear-gradient(135deg, {{ $tenant->theme_settings['primary_color'] ?? '#8b4513' }} 0%, {{ $tenant->theme_settings['secondary_color'] ?? '#a0522d' }} 100%); border: none; color: white; padding: 12px; border-radius: 10px; font-weight: 600; transition: all 0.3s ease; text-decoration: none; display: block;">
                                        <i class="fas fa-sign-in-alt me-2"></i>
                                        Accéder à {{ $tenant->name }}
                                    </a>
                                @else
                                    <button class="btn btn-secondary w-100" disabled style="background-color: #6c757d; border-color: #6c757d; padding: 12px; border-radius: 10px;">
                                        <i class="fas fa-lock me-2"></i>
                                        Non configuré
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-warning text-center" style="border-radius: 15px; border: none; background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3" style="color: #f39c12;"></i>
                            <h4 class="mb-3">Aucun hôtel actif</h4>
                            <p class="mb-0">Aucun hôtel n'est actuellement configuré dans le système.</p>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Section pour les nouveaux hotels -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card border-0 shadow" style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); border-radius: 15px; color: white;">
                        <div class="card-body text-center p-5">
                            <div class="mb-4">
                                <i class="fas fa-hotel fa-4x"></i>
                            </div>
                            <h3 class="card-title mb-3">Vous êtes un nouvel hôtel ?</h3>
                            <p class="card-text mb-4" style="opacity: 0.9;">
                                Rejoignez Check-Sys et bénéficiez d'une solution de gestion complète avec interface personnalisable
                            </p>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('tenant.landing') }}" class="btn btn-light btn-lg" style="background: white; color: #28a745; border: 2px solid white;">
                                    <i class="fas fa-rocket me-2"></i>
                                    Découvrir nos offres
                                </a>
                                <a href="{{ route('tenant.register') }}" class="btn btn-outline-light btn-lg" style="border: 2px solid white; color: white;">
                                    <i class="fas fa-plus-circle me-2"></i>
                                    Créer mon compte
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
