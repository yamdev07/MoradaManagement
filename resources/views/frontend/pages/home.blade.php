@extends('frontend.layouts.master')

@section('title', 'Morada Lodge - Havre de Luxe au Cœur de la Nature')

@section('content')
    <!-- Hero Section modernisé -->
    <section class="hero-modern">
        <div class="hero-content">
            <div class="container">
                <div class="row min-vh-100 align-items-center justify-content-center">
                    <div class="col-lg-10 text-center">
                        <div class="hero-badge mb-4" data-aos="fade-down">
                            <span class="badge-text">Luxury Nature Resort</span>
                        </div>
                        <h1 class="hero-title mb-4" data-aos="fade-up" data-aos-delay="100">
                            Découvrez le Luxe 
                            <span class="d-block" style="color: #cd853f;">
                                au Cœur de la Nature
                            </span>
                        </h1>
                        <p class="hero-subtitle mb-5" data-aos="fade-up" data-aos-delay="200">
                            Un sanctuaire de tranquillité où l'élégance rencontre l'authenticité africaine
                        </p>
                        <div class="hero-cta" data-aos="fade-up" data-aos-delay="300">
                            <a href="{{ route('frontend.rooms') }}" class="btn-modern btn-primary me-3">
                                Découvrir nos suites
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <a href="{{ route('frontend.reservation') }}" class="btn-modern btn-outline">
                                Réserver maintenant
                                <i class="fas fa-calendar-check ms-2"></i>
                            </a>
                        </div>
                        
                        <!-- Formulaire intégré dans l'héros -->
                        <div class="booking-in-hero mt-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="booking-form-inline">
                                <form action="{{ route('frontend.rooms') }}" method="GET" class="booking-form">
                                    <div class="form-group">
                                        <label>Arrivée</label>
                                        <input type="date" name="check_in" class="form-input" id="hero_check_in" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Départ</label>
                                        <input type="date" name="check_out" class="form-input" id="hero_check_out" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Invités</label>
                                        <select name="guests" class="form-input">
                                            <option value="1">1 Adulte</option>
                                            <option value="2" selected>2 Adultes</option>
                                            <option value="3">3 Adultes</option>
                                            <option value="4">4 Adultes</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn-search">
                                        <i class="fas fa-search"></i>
                                        Rechercher
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scroll indicator -->
        <div class="scroll-indicator">
            <div class="mouse"></div>
            <span>Défiler</span>
        </div>
    </section>

    <!-- Section Introduction -->
    <section class="intro-section py-7">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="intro-image-wrapper">
                        <div class="main-image">
                            <img src="http://moradalodge.com/images/accueil_entree.jpg" 
                                 alt="Morada Lodge Nature Resort" 
                                 class="img-fluid border-radius-20 shadow-lg">
                        </div>
                        <div class="floating-badge">
                            <div class="badge-content">
                                <h3>5★</h3>
                                <p>Luxe & Nature</p>
                            </div>
                        </div>
                        <div class="decoration-element"></div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="section-header mb-4">
                        <span class="section-tag">Bienvenue</span>
                        <h2 class="section-title">Un Sanctuaire de Sérénité</h2>
                    </div>
                    <p class="lead-text mb-4">
                        Découvrez Morada Lodge, un véritable havre de paix situé à Covè. Notre établissement allie le raffinement du luxe contemporain à l'authenticité de la nature béninoise pour vous offrir une expérience inoubliable.
                    </p>
                    <div class="features-grid">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-swimming-pool"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Piscine Privée</h4>
                                <p>Détente absolue dans un cadre idyllique</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Écologique</h4>
                                <p>Respect de l'environnement et développement durable</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Chambres -->
    <section class="rooms-section py-7">
        <div class="container">
            <div class="text-center mb-6" data-aos="fade-up">
                <span class="section-tag">Nos Hébergements</span>
                <h2 class="section-title">Nos Suites de Prestige</h2>
                <p class="section-subtitle mx-auto">
                    Chaque hébergement est conçu comme un havre de paix, alliant confort moderne et charme authentique africain.
                </p>
            </div>

            <div class="row g-4">
                @foreach($featuredRooms as $room)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="room-card-modern">
                        <div class="room-image-wrapper">
                            @php
                                // Gestion des images - priorité aux images de la chambre
                                $roomImage = asset('img/default/default-room.png'); // Image par défaut
                                
                                if($room->images && $room->images->count() > 0) {
                                    $firstImage = $room->images->first();
                                    $testPath = 'img/room/' . $room->number . '/' . $firstImage->url;
                                    if(file_exists(public_path($testPath))) {
                                        $roomImage = asset($testPath);
                                    } else {
                                        // Essayer sans le numéro de chambre
                                        $testPath2 = 'img/room/' . $firstImage->url;
                                        if(file_exists(public_path($testPath2))) {
                                            $roomImage = asset($testPath2);
                                        }
                                    }
                                }
                            @endphp
                            
                            <img src="{{ $roomImage }}" 
                                 alt="{{ $room->name }}"
                                 class="room-image"
                                 onerror="this.onerror=null; this.src='{{ asset('img/room/gamesetting.png') }}';">
                                 
                            <div class="room-status">
                                @php
                                    // Vérifier la disponibilité réelle
                                    $today = now()->startOfDay();
                                    $isOccupied = \App\Models\Transaction::where('room_id', $room->id)
                                        ->where('check_in', '<=', $today)
                                        ->where('check_out', '>=', $today)
                                        ->whereIn('status', ['active', 'reservation'])
                                        ->exists();
                                    $isAvailable = !$isOccupied && $room->room_status_id == 1;
                                @endphp
                                
                                @if($isAvailable)
                                <span class="status-badge available">
                                    <i class="fas fa-check"></i> Disponible
                                </span>
                                @else
                                <span class="status-badge on-request">
                                    <i class="fas fa-clock"></i> Sur demande
                                </span>
                                @endif
                            </div>
                            <button class="wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        
                        <div class="room-details">
                            <div class="room-header">
                                <div>
                                    <h3 class="room-name">{{ $room->name }}</h3>
                                    <p class="room-type">{{ $room->type->name ?? 'Suite Premium' }}</p>
                                </div>
                                <span class="capacity-badge">
                                    <i class="fas fa-user"></i> {{ $room->capacity }}
                                </span>
                            </div>
                            
                            @if($room->view)
                            <p class="room-description">{{ Str::limit($room->view, 100) }}</p>
                            @endif
                            
                            <div class="room-specs">
                                <div class="spec-item">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                    <span>{{ $room->size ?? '--' }} m²</span>
                                </div>
                                @if($room->view)
                                <div class="spec-item">
                                    <i class="fas fa-eye"></i>
                                    <span>Vue exceptionnelle</span>
                                </div>
                                @endif
                            </div>
                            
                            <div class="room-footer">
                                <div class="price-info">
                                    <span class="price">{{ number_format($room->price, 0, ',', ' ') }} FCFA</span>
                                    <span class="price-label">par nuit</span>
                                </div>
                                <a href="{{ route('frontend.room.details', $room->id) }}" class="btn-view">
                                    Voir détails
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('frontend.rooms') }}" class="btn-modern btn-outline-lg">
                    Voir toutes les suites
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="gallery-section py-7" id="galerie">
        <div class="container">
            <div class="text-center mb-6" data-aos="fade-up">
                <span class="section-tag">Galerie</span>
                <h2 class="section-title">Moments d'Exception</h2>
                <p class="section-subtitle mx-auto">
                    Découvrez l'atmosphère unique de Morada Lodge à travers ces images capturent l'essence de notre havre de paix.
                </p>
            </div>

            <div class="row g-4 overflow-hidden">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="0">
                    <div class="gallery-item">
                        <img src="http://moradalodge.com/images/piscineP.jpg" alt="Piscine Principale">
                        <div class="gallery-overlay">
                            <span>Piscine Principale</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="gallery-item">
                        <img src="http://moradalodge.com/images/jardin.jpg" alt="Jardins">
                        <div class="gallery-overlay">
                            <span>Jardins Tropicaux</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="gallery-item">
                        <img src="http://moradalodge.com/images/Photo10.jpeg" alt="Restaurant">
                        <div class="gallery-overlay">
                            <span>Restaurant Paillote</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Témoignages -->
    <section class="testimonials-section py-7">
        <div class="container">
            <div class="text-center mb-6" data-aos="fade-up">
                <span class="section-tag brown-text">Témoignages</span>
                <h2 class="section-title text-dark">Ce Que Nos Clients Disent</h2>
                <p class="section-subtitle text-muted mx-auto">
                    L'excellence reconnue par nos clients les plus exigeants
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="testimonial-card-modern">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="rating mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "Un séjour absolument magique ! L'accueil chaleureux, la cuisine exceptionnelle et le cadre paradisiaque ont rendu notre lune de miel inoubliable."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-icon-circle"><i class="fas fa-user"></i></div>
                            <div class="author-info">
                                <h5>Sophie & Pierre Martin</h5>
                                <p>France</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card-modern">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="rating mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "La tranquillité du lieu et la qualité des services font de Morada Lodge une adresse incontournable. Nous reviendrons sans hésiter !"
                        </p>
                        <div class="testimonial-author">
                            <div class="author-icon-circle"><i class="fas fa-user"></i></div>
                            <div class="author-info">
                                <h5>James Thompson</h5>
                                <p>Canada</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card-modern">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="rating mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">
                            "Un véritable havre de paix où service impeccable rime avec authenticité. La découverte culinaire a été un vrai bonheur !"
                        </p>
                        <div class="testimonial-author">
                            <div class="author-icon-circle"><i class="fas fa-user"></i></div>
                            <div class="author-info">
                                <h5>Amina Diallo</h5>
                                <p>Sénégal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="stats-row mt-6 pt-5" data-aos="fade-up">
                <div class="row g-4">
                    <div class="col-lg-3 col-6">
                        <div class="stat-item">
                            <h3 class="stat-number">4.9</h3>
                            <p class="stat-label">Note moyenne</p>
                            <div class="stat-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stat-item">
                            <h3 class="stat-number">98%</h3>
                            <p class="stat-label">Satisfaction client</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stat-item">
                            <h3 class="stat-number">5★</h3>
                            <p class="stat-label">Classement officiel</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stat-item">
                            <h3 class="stat-number">25+</h3>
                            <p class="stat-label">Récompenses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="cta-section py-7">
        <div class="container">
            <div class="cta-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-7" data-aos="fade-right">
                        <h2 class="cta-title">Réservez votre Séjour d'Exception</h2>
                        <p class="cta-text">
                            Notre équipe est à votre disposition pour organiser un séjour sur mesure qui dépassera toutes vos attentes.
                        </p>
                        <div class="cta-actions">
                            <a href="{{ route('frontend.reservation') }}" class="btn-modern btn-primary-lg">
                                <i class="fas fa-calendar-check me-2"></i>
                                Réserver maintenant
                            </a>
                            <a href="tel:+2290167836481" class="btn-modern btn-white-lg">
                                <i class="fas fa-phone me-2"></i>
                                (+229) 01 67 83 64 81
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center" data-aos="fade-left">
                        <div class="offer-badge">
                            <div class="badge-circle">
                                <span class="discount">-25%</span>
                                <span class="offer-label">Offre exclusive</span>
                                <span class="offer-desc">Réservation en ligne</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
<style>
/* ============================================
   VARIABLES & BASE
   ============================================ */
:root {
    --primary-brown: #654321;
    --secondary-brown: #C5A059;
    --dark-brown: #654321;
    --gold-accent: #C5A059;
    --light-bg: #FDFBF7;
    --white: #FFFFFF;
    --text-dark: #654321;
    --text-gray: #666666;
    --border-color: #EEEEEE;

    --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.text-gold-accent {
    color: var(--brown-old-accent) !important;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: var(--text-dark);
    line-height: 1.6;
    overflow-x: hidden;
    padding-top: 0;
}

.py-7 {
    padding: 100px 0;
}

/* ============================================
   HERO SECTION
   ============================================ */
.hero-modern {
    position: relative;
    min-height: 100vh;
    background: linear-gradient(rgba(101, 67, 33, 0.85), rgba(101, 67, 33, 0.9)), 
                url('http://moradalodge.com/images/accueil.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
    display: flex;
    align-items: center;
}

.hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
}

.hero-badge {
    display: inline-block;
    margin-bottom: 30px;
}

.badge-text {
    display: inline-block;
    padding: 8px 24px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    color: var(--brown-old-accent);
    font-size: 13px;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    backdrop-filter: blur(10px);
}

.hero-title {
    font-size: clamp(3rem, 8vw, 7rem);
    font-weight: 300;
    color: var(--white);
    letter-spacing: -2px;
    margin-bottom: 20px;
    line-height: 1.1;
}

.hero-subtitle {
    font-size: clamp(1.1rem, 2vw, 1.5rem);
    color: rgba(255, 255, 255, 0.85);
    max-width: 700px;
    margin: 0 auto 40px;
    font-weight: 300;
}

.hero-cta {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 60px;
}

/* Formulaire intégré dans l'héros */
.booking-in-hero {
    max-width: 900px;
    margin: 0 auto;
}

.booking-form-inline {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 30px;
    box-shadow: var(--shadow-lg);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.booking-form {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    align-items: end;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-size: 13px;
    font-weight: 500;
    color: var(--text-gray);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.form-input {
    padding: 14px 18px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    font-size: 15px;
    transition: var(--transition-smooth);
    background: var(--white);
    width: 100%;
}

.form-input:focus {
    outline: none;
    border-color: var(--primary-brown);
    box-shadow: 0 0 0 4px rgba(101, 67, 33, 0.1);
}

.btn-search {
    padding: 14px 30px;
    background: var(--primary-brown);
    color: var(--white);
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition-smooth);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    height: 52px;
}

.btn-search:hover {
    background: var(--secondary-brown);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* Scroll Indicator */
.scroll-indicator {
    position: absolute;
    bottom: 20px; /* Rapproché du bas pour laisser plus d'espace au-dessus */
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    color: rgba(255, 255, 255, 0.6);
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    z-index: 3;
}

.mouse {
    width: 24px;
    height: 40px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 15px;
    position: relative;
}

.mouse::before {
    content: '';
    width: 4px;
    height: 8px;
    background: rgba(255, 255, 255, 0.6);
    position: absolute;
    top: 8px;
    left: 50%;
    transform: translateX(-50%);
    border-radius: 2px;
    animation: scroll 1.5s infinite;
}

@keyframes scroll {
    0% { top: 8px; opacity: 1; }
    50% { top: 20px; opacity: 0.5; }
    100% { top: 8px; opacity: 1; }
}

/* ============================================
   BUTTONS
   ============================================ */
.btn-modern {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 15px 35px;
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
    border-radius: 8px;
    transition: var(--transition-smooth);
    cursor: pointer;
    border: none;
    letter-spacing: 0.5px;
}

.btn-primary {
    background: var(--white);
    color: var(--primary-brown);
}

.btn-primary:hover {
    background: var(--brown-old-accent);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(201, 169, 97, 0.3);
}

.btn-outline {
    background: transparent;
    color: var(--white);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.btn-outline:hover {
    background: var(--white);
    border-color: var(--white);
    color: var(--primary-brown) !important;
}

.btn-outline-lg {
    padding: 18px 45px;
    font-size: 16px;
    background: transparent;
    color: var(--primary-brown);
    border: 2px solid var(--primary-brown);
}

.btn-outline-lg:hover {
    background: var(--primary-brown);
    color: var(--white);
}

.btn-primary-lg {
    padding: 18px 45px;
    font-size: 16px;
    background: var(--primary-brown);
    color: var(--white);
}

.btn-primary-lg:hover {
    background: var(--secondary-brown);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-white-lg {
    padding: 18px 45px;
    font-size: 16px;
    background: var(--white);
    color: var(--primary-brown);
    border: 2px solid var(--white);
}

.btn-white-lg:hover {
    background: transparent;
    color: var(--white);
}

/* ============================================
   SECTIONS COMMUNES
   ============================================ */
.section-tag {
    display: inline-block;
    padding: 6px 20px;
    background: rgba(101, 67, 33, 0.1);
    color: var(--primary-brown);
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 15px;
}

.section-tag.light {
    background: rgba(255, 255, 255, 0.1);
    color: var(--brown-old-accent);
}

.section-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 15px;
    letter-spacing: -1px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--text-gray);
    max-width: 650px;
    line-height: 1.7;
}

/* ============================================
   INTRO SECTION
   ============================================ */
.intro-section {
    background: var(--light-bg);
}

.intro-image-wrapper {
    position: relative;
}

.main-image {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}

.main-image img {
    width: 100%;
    height: auto;
    display: block;
}

.floating-badge {
    position: absolute;
    bottom: 30px;
    right: -30px;
    background: var(--white);
    padding: 30px;
    border-radius: 16px;
    box-shadow: var(--shadow-lg);
    text-align: center;
}

.floating-badge h3 {
    font-size: 3rem;
    font-weight: 700;
    color: var(--primary-brown);
    margin-bottom: 5px;
}

.floating-badge p {
    font-size: 14px;
    color: var(--text-gray);
    margin: 0;
}

.decoration-element {
    position: absolute;
    top: -20px;
    left: -20px;
    width: 150px;
    height: 150px;
    background: var(--brown-old-accent);
    opacity: 0.15;
    border-radius: 20px;
    z-index: -1;
}

.lead-text {
    font-size: 1.1rem;
    color: var(--text-gray);
    line-height: 1.8;
}

.features-grid {
    display: grid;
    gap: 25px;
    margin-top: 30px;
}

.feature-item {
    display: flex;
    gap: 20px;
    align-items: start;
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-brown), var(--secondary-brown));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 24px;
    flex-shrink: 0;
}

.feature-content h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 5px;
}

.feature-content p {
    font-size: 0.95rem;
    color: var(--text-gray);
    margin: 0;
}

/* ============================================
   ROOMS SECTION
   ============================================ */
.rooms-section {
    background: var(--white);
}

.room-card-modern {
    background: var(--white);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: var(--transition-smooth);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.room-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.room-image-wrapper {
    position: relative;
    height: 280px;
    overflow: hidden;
}

.room-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.room-card-modern:hover .room-image {
    transform: scale(1.08);
}

.room-status {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 2;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

.status-badge.available {
    background: rgba(201, 169, 97, 0.95); /* Gold Accent */
    color: var(--white);
    box-shadow: 0 4px 12px rgba(201, 169, 97, 0.3);
}

.status-badge.on-request {
    background: rgba(101, 67, 33, 0.85); /* Primary Brown */
    color: var(--white);
}

.wishlist-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition-smooth);
    z-index: 2;
}

.wishlist-btn:hover {
    background: var(--primary-brown);
    color: var(--white);
    transform: scale(1.1);
}

.room-details {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.room-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 15px;
}

.room-name {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 5px;
}

.room-type {
    font-size: 0.9rem;
    color: var(--text-gray);
    margin: 0;
}

.capacity-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: rgba(101, 67, 33, 0.1);
    color: var(--primary-brown);
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
}

.room-description {
    font-size: 0.95rem;
    color: var(--text-gray);
    margin-bottom: 20px;
    line-height: 1.6;
}

.room-specs {
    display: flex;
    gap: 20px;
    padding: 15px 0;
    border-top: 1px solid var(--border-color);
    border-bottom: 1px solid var(--border-color);
    margin-bottom: 20px;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: var(--text-gray);
}

.spec-item i {
    color: var(--primary-brown);
}

.room-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.price-info {
    display: flex;
    flex-direction: column;
}

.price {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-brown);
}

.price-label {
    font-size: 0.85rem;
    color: var(--text-gray);
}

.btn-view {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: var(--primary-brown);
    color: var(--white);
    text-decoration: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    transition: var(--transition-smooth);
}

.btn-view:hover {
    background: var(--secondary-brown);
    transform: translateX(3px);
}

/* ============================================
   SERVICES SECTION
   ============================================ */
.services-section {
    background: var(--light-bg);
}

.brown-text {
    color: var(--primary-brown) !important;
}

.service-card-modern {
    background: var(--white);
    padding: 40px 30px;
    border-radius: 16px;
    text-align: center;
    transition: var(--transition-smooth);
    height: 100%;
    border: 2px solid transparent;
}

.service-card-modern:hover {
    border-color: var(--primary-brown);
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
}

.service-icon-wrapper {
    width: 80px;
    height: 80px;
    background: var(--white);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 32px;
    color: var(--primary-brown);
    box-shadow: var(--shadow-md);
    transition: var(--transition-smooth);
}

.service-card-modern:hover .service-icon-wrapper {
    transform: scale(1.1) rotate(5deg);
}

.service-card-modern h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 15px;
}

.service-card-modern p {
    font-size: 0.95rem;
    color: var(--text-gray);
    margin-bottom: 20px;
    line-height: 1.6;
}

.service-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--primary-brown);
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    transition: var(--transition-smooth);
}

.service-link:hover {
    gap: 12px;
    color: var(--secondary-brown);
}

/* ============================================
   TESTIMONIALS SECTION
   ============================================ */
.testimonials-section {
    background: var(--light-bg);
    position: relative;
    color: var(--text-dark);
}

.testimonials-section::before {
    display: none;
}

.testimonials-section .container {
    position: relative;
    z-index: 2;
}

.testimonial-card-modern {
    background: var(--white);
    padding: 35px;
    border-radius: 16px;
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-sm);
    transition: var(--transition-smooth);
    height: 100%;
}

.testimonial-card-modern:hover {
    background: rgba(255, 255, 255, 0.12);
    transform: translateY(-5px);
    border-color: var(--brown-old-accent);
}

.quote-icon {
    font-size: 2rem;
    color: var(--brown-old-accent);
    opacity: 0.5;
    margin-bottom: 20px;
}

.rating {
    display: flex;
    gap: 5px;
}

.rating i {
    color: var(--brown-old-accent);
    font-size: 14px;
}

.testimonial-text {
    font-size: 1rem;
    font-style: italic;
    color: var(--text-dark);
    margin-bottom: 25px;
    line-height: 1.7;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 15px;
}

.author-icon-circle {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: var(--primary-brown);
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: var(--shadow-sm);
}

.author-info h5 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 2px;
}

.author-info p {
    font-size: 0.8rem;
    color: var(--text-gray);
    margin-bottom: 0;
}

/* ============================================
   GALLERY SECTION
   ============================================ */
.gallery-section {
    background: var(--white);
}

.gallery-item {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    height: 350px;
    cursor: pointer;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.gallery-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    display: flex;
    align-items: flex-end;
    padding: 30px;
    opacity: 0;
    transition: var(--transition-smooth);
}

.gallery-overlay span {
    color: var(--white);
    font-size: 1.2rem;
    font-weight: 600;
    transform: translateY(20px);
    transition: var(--transition-smooth);
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-item:hover .gallery-overlay span {
    transform: translateY(0);
}

/* Stats */
.stats-row {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.stat-item {
    text-align: center;
    padding: 20px;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary-brown);
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    color: var(--text-gray);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.stat-stars {
    color: var(--brown-old-accent);
    font-size: 0.8rem;
    display: flex;
    gap: 3px;
    justify-content: center;
    margin-top: 8px;
}

.stat-stars i {
    color: var(--brown-old-accent);
    font-size: 14px;
}

/* ============================================
   CTA SECTION
   ============================================ */
.cta-section {
    background: var(--light-bg);
}

.cta-wrapper {
    background: linear-gradient(135deg, var(--primary-brown), var(--secondary-brown));
    border-radius: 24px;
    padding: 80px 60px;
    position: relative;
    overflow: hidden;
}

.cta-wrapper::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(201, 169, 97, 0.2) 0%, transparent 70%);
}

.cta-title {
    font-size: clamp(2rem, 4vw, 2.8rem);
    font-weight: 700;
    color: var(--white);
    margin-bottom: 15px;
    letter-spacing: -1px;
}

.cta-text {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 35px;
}

.cta-actions {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.offer-badge {
    position: relative;
}

.badge-circle {
    width: 240px;
    height: 240px;
    background: var(--white);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    animation: float 3s ease-in-out infinite;
    padding: 20px;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.discount {
    font-size: 3rem;
    font-weight: 700;
    color: var(--primary-brown);
    line-height: 1;
}

.offer-label {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-top: 8px;
}

.offer-desc {
    font-size: 0.85rem;
    color: var(--text-gray);
    margin-top: 5px;
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 991px) {
    .py-7 {
        padding: 70px 0;
    }
    
    .booking-form {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .floating-badge {
        position: static;
        margin-top: 30px;
        max-width: 250px;
    }
    
    .cta-wrapper {
        padding: 50px 30px;
        text-align: center;
    }
    
    .cta-actions {
        justify-content: center;
    }
    
    .badge-circle {
        margin: 30px auto 0;
    }
}

@media (max-width: 768px) {
    .hero-cta {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
    }
    
    .btn-modern {
        width: 100%;
    }
    
    .scroll-indicator {
        display: none;
    }
    
    .booking-form-inline {
        padding: 20px;
    }
    
    .stats-row .row {
        gap: 30px;
    }
    
    .booking-form {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: clamp(2.5rem, 6vw, 4rem);
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .booking-form-inline {
        margin: 0 -15px;
        border-radius: 0;
    }
    
    .cta-actions {
        flex-direction: column;
    }
    
    .btn-modern {
        width: 100%;
        justify-content: center;
    }
}

    </style>
@endpush

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
    
    // Gestion des dates de réservation
    const dateInputs = document.querySelectorAll('input[type="date"]');
    const today = new Date().toISOString().split('T')[0];
    
    if (dateInputs.length >= 2) {
        // Date d'arrivée
        dateInputs[0].min = today;
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        dateInputs[0].value = tomorrow.toISOString().split('T')[0];
        
        // Date de départ
        dateInputs[1].min = tomorrow.toISOString().split('T')[0];
        const dayAfter = new Date(tomorrow);
        dayAfter.setDate(dayAfter.getDate() + 2);
        dateInputs[1].value = dayAfter.toISOString().split('T')[0];
        
        // Update departure min when arrival changes
        dateInputs.forEach((input, index) => {
            if (index === 0) {
                input.addEventListener('change', function() {
                    const arrivalDate = new Date(this.value);
                    arrivalDate.setDate(arrivalDate.getDate() + 1);
                    
                    dateInputs[1].min = arrivalDate.toISOString().split('T')[0];
                    
                    if (new Date(dateInputs[1].value) <= new Date(this.value)) {
                        const newDeparture = new Date(this.value);
                        newDeparture.setDate(newDeparture.getDate() + 1);
                        dateInputs[1].value = newDeparture.toISOString().split('T')[0];
                    }
                });
            }
        });
    }
    
    // Wishlist buttons
    const wishlistBtns = document.querySelectorAll('.wishlist-btn');
    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const icon = this.querySelector('i');
            
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.style.color = '#8B0000';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.style.color = '';
            }
        });
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Counter animation for stats
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };
    
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumbers = entry.target.querySelectorAll('.stat-number');
                statNumbers.forEach(stat => {
                    const text = stat.textContent;
                    if (text.includes('%') || text.includes('+')) {
                        const number = parseInt(text);
                        animateCounter(stat, 0, number, 2000, text.includes('%') ? '%' : '+');
                    }
                });
                statsObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    const statsRow = document.querySelector('.stats-row');
    if (statsRow) {
        statsObserver.observe(statsRow);
    }
    
    function animateCounter(element, start, end, duration, suffix = '') {
        let startTime = null;
        
        function animation(currentTime) {
            if (!startTime) startTime = currentTime;
            const progress = Math.min((currentTime - startTime) / duration, 1);
            const current = Math.floor(progress * (end - start) + start);
            element.textContent = current + suffix;
            
            if (progress < 1) {
                requestAnimationFrame(animation);
            }
        }
        
        requestAnimationFrame(animation);
    }
    
    // Validation des formulaires de réservation
    const bookingForms = document.querySelectorAll('.booking-form');
    bookingForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const arrivalInput = this.querySelector('input[type="date"]:nth-of-type(1)');
            const departureInput = this.querySelector('input[type="date"]:nth-of-type(2)');
            
            if (arrivalInput && departureInput) {
                const arrivalDate = new Date(arrivalInput.value);
                const departureDate = new Date(departureInput.value);
                
                if (departureDate <= arrivalDate) {
                    alert('La date de départ doit être postérieure à la date d\'arrivée.');
                    departureInput.focus();
                    return false;
                }
                
                // Redirection vers la page des chambres avec les dates
                window.location.href = '{{ route("frontend.rooms") }}?check_in=' + arrivalInput.value + '&check_out=' + departureInput.value + '&guests=' + (this.querySelector('select[name="guests"]')?.value || '2');
            }
        });
    });
});
</script>
@endpush