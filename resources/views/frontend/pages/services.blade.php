@extends('frontend.layouts.master')

@section('title', 'Nos Services - Morada Lodge')

@section('content')
    <!-- Hero Section Services -->
    <section class="hero-section-services">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 mb-4">Nos Services</h1>
                    <p class="lead mb-4">Découvrez notre excellence et notre attention personnalisée</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Principaux -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Piscine Privée -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 service-card" style="background-color: white; border-top: 4px solid var(--primary-brown);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px; background-color: var(--primary-brown);">
                                <i class="fas fa-swimming-pool fa-3x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown);">Piscine Privée</h4>
                            <p class="text-muted">Détente absolue dans un cadre idyllique</p>
                        </div>
                    </div>
                </div>

                <!-- Gastronomie -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 service-card" style="background-color: white; border-top: 4px solid var(--primary-brown);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px; background-color: var(--primary-brown);">
                                <i class="fas fa-utensils fa-3x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown);">Gastronomie</h4>
                            <p class="text-muted">Cuisine raffinée locale et internationale</p>
                        </div>
                    </div>
                </div>

                <!-- Écologique -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 service-card" style="background-color: white; border-top: 4px solid var(--primary-brown);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px; background-color: var(--primary-brown);">
                                <i class="fas fa-leaf fa-3x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown);">Écologique</h4>
                            <p class="text-muted">Respect de l'environnement et développement durable</p>
                        </div>
                    </div>
                </div>

                <!-- Service 5 étoiles -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 service-card" style="background-color: white; border-top: 4px solid var(--primary-brown);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px; background-color: var(--primary-brown);">
                                <i class="fas fa-star fa-3x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown);">Service 5 étoiles</h4>
                            <p class="text-muted">Excellence et attention personnalisée</p>
                        </div>
                    </div>
                </div>

                <!-- Wi-Fi Haut Débit -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 service-card" style="background-color: white; border-top: 4px solid var(--primary-brown);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px; background-color: var(--primary-brown);">
                                <i class="fas fa-wifi fa-3x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown);">Wi-Fi Haut Débit</h4>
                            <p class="text-muted">Connexion internet gratuite dans tout l'établissement</p>
                        </div>
                    </div>
                </div>

                <!-- Parking Sécurisé -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 service-card" style="background-color: white; border-top: 4px solid var(--primary-brown);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px; background-color: var(--primary-brown);">
                                <i class="fas fa-car fa-3x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown);">Parking Sécurisé</h4>
                            <p class="text-muted">Stationnement gratuit et surveillance 24h/24</p>
                        </div>
                    </div>
                </div>

                <!-- Conciergerie -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 service-card" style="background-color: white; border-top: 4px solid var(--primary-brown);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px; background-color: var(--primary-brown);">
                                <i class="fas fa-concierge-bell fa-3x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown);">Conciergerie</h4>
                            <p class="text-muted">Service personnalisé pour organiser vos activités</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
.hero-section-services {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                url('{{ asset("img/room/piscineP.jpg") }}');
    background-size: cover;
    background-position: center;
    color: white;
    padding: 150px 0;
}

.service-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.service-card .rounded-circle {
    transition: background-color 0.3s ease;
}

.service-card:hover .rounded-circle {
    background-color: var(--dark-brown) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section-services {
        padding: 100px 0;
    }
    
    .hero-section-services h1 {
        font-size: 2.5rem;
    }
}
</style>
@endpush