@extends('frontend.layouts.master')

@section('title', 'Nos Services - Hôtel Morada Lodge')

@section('head')
<!-- Les styles globaux sont dans le master layout -->
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
<style>
    /* ── HERO ── */
    .hero-section-services {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                    url('https://i.pinimg.com/1200x/16/c3/14/16c314a98e9b5921685b93a028c34926.jpg');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 150px 0;
    }
    .light-brown-bg {
        background-color: #f8f4f0 !important;
    }
    .service-icon-box {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 10px 25px rgba(101, 67, 33, 0.1);
        transition: all 0.3s ease;
    }
    .service-icon-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(101, 67, 33, 0.15);
    }
    .brown-text {
        color: #654321 !important;
    }
    /* Fix pour le texte du bouton au survol */
    .btn-primary-custom:hover {
        color: #FFFFFF !important;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section pour les services -->
    <section class="hero-section-services">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 mb-4">Nos Services Premium</h1>
                    <p class="lead mb-4">L'excellence au service de votre confort pour un séjour inoubliable</p>
                </div>
            </div>
        </div>
    </section>
    
    <section id="services" class="py-20 light-brown-bg">
        <div class="container overflow-hidden">
            <div class="text-center mb-16 reveal active" data-aos="fade-up">
                <span class="brown-text font-semibold tracking-wider uppercase text-sm">Services</span>
                <h2 class="text-4xl md:text-5xl font-playfair font-bold mt-2 mb-6">Expériences Premium</h2>
                <p class="text-xl text-muted max-w-3xl mx-auto leading-relaxed">Profitez d'une gamme complète de services conçus pour rendre votre séjour inoubliable</p>
            </div>

            <div class="row g-4 reveal active">
                <!-- Restaurant -->
                <div class="col-md-6 col-lg-3 text-center mb-4" data-aos="zoom-in" data-aos-delay="0">
                    <div class="service-icon-box">
                        <i class="fas fa-utensils brown-text fa-2x"></i>
                    </div>
                    <h3 class="h5 font-semibold mb-3">Saveurs d'Afrique</h3>
                    <p class="text-muted small leading-relaxed">Cuisine raffinée locale et internationale sous une paillote majestueuse</p>
                    <a href="{{ route('frontend.restaurant') }}" class="brown-text text-decoration-none small fw-bold">Découvrir <i class="fas fa-arrow-right ms-1"></i></a>
                </div>

                <!-- Piscine -->
                <div class="col-md-6 col-lg-3 text-center mb-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="service-icon-box">
                        <i class="fas fa-swimming-pool brown-text fa-2x"></i>
                    </div>
                    <h3 class="h5 font-semibold mb-3">Piscine & Détente</h3>
                    <p class="text-muted small leading-relaxed">Piscine extérieure avec transats et service poolside</p>
                    <a href="#" class="brown-text text-decoration-none small fw-bold">Découvrir <i class="fas fa-arrow-right ms-1"></i></a>
                </div>

                <!-- Wi-Fi -->
                <div class="col-md-6 col-lg-3 text-center mb-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-icon-box">
                        <i class="fas fa-wifi brown-text fa-2x"></i>
                    </div>
                    <h3 class="h5 font-semibold mb-3">Wi-Fi Haut Débit</h3>
                    <p class="text-muted small leading-relaxed">Connexion internet gratuite dans tout l'établissement</p>
                    <a href="#" class="brown-text text-decoration-none small fw-bold">Découvrir <i class="fas fa-arrow-right ms-1"></i></a>
                </div>

                <!-- Parking -->
                <div class="col-md-6 col-lg-3 text-center mb-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="service-icon-box">
                        <i class="fas fa-car brown-text fa-2x"></i>
                    </div>
                    <h3 class="h5 font-semibold mb-3">Parking Sécurisé</h3>
                    <p class="text-muted small leading-relaxed">Stationnement gratuit et surveillance 24h/24</p>
                    <a href="#" class="brown-text text-decoration-none small fw-bold">Découvrir <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Reservation CTA -->
    <section class="py-5 text-center">
        <div class="container">
            <a href="{{ route('frontend.home') }}" class="btn btn-primary-custom px-5 py-3 rounded-pill">
                <i class="fas fa-calendar-check me-2"></i> Réserver maintenant
            </a>
        </div>
    </section>

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS (Animate On Scroll)
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 50
    });
});
</script>
@endpush
@endsection