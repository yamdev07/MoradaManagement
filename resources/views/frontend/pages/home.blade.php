@extends('frontend.layouts.master')

@section('title', ($currentHotel->name ?? 'Morada Lodge') . ' - ' . ($currentHotel->description ?? 'Havre de Luxe au Cœur de la Nature'))

@section('content')
    <!-- Hero Section modernisé -->
    <section class="hero-modern">
        <div class="hero-content">
            <div class="container">
                <div class="row min-vh-100 align-items-center justify-content-center">
                    <div class="col-lg-10 text-center">
                        <div class="hero-badge mb-4" data-aos="fade-down">
                            <span class="badge-text">{{ $currentHotel ? $currentHotel->description : 'Le luxe au cœur de la nature' }}</span>
                        </div>
                        <h1 class="hero-title mb-4" data-aos="fade-up" data-aos-delay="100">
                            @if(!empty($currentHotel)) {{ $currentHotel->name }} @else Morada Lodge @endif
                        </h1>
                        <p class="hero-subtitle mb-5" data-aos="fade-up" data-aos-delay="200">
                            @if(!empty($currentHotel)) {{ $currentHotel ? $currentHotel->description : 'Un sanctuaire de tranquillité où l\'élégance rencontre l\'authenticité africaine' }} @else Un sanctuaire de tranquillité où l'élégance rencontre l'authenticité africaine @endif
                        </p>
                        <div class="hero-cta" data-aos="fade-up" data-aos-delay="300">
                            <a href="{{ route('frontend.rooms') }}" class="btn-modern btn-primary me-3">
                                Découvrir nos hébergements
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
                            <img src="{{ asset('img/room/Photo10.jpeg') }}" 
                                 alt="{{ $currentHotel ? $currentHotel->name : 'Morada Lodge' }}" 
                                 class="img-fluid">
                        </div>
                        <div class="floating-badge">
                            <div class="badge-content">
                                <h3><i class="fas fa-hotel"></i></h3>
                                <p>Expérience unique</p>
                            </div>
                        </div>
                        <div class="decoration-element"></div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="section-header mb-4">
                        <span class="section-tag">{{ $currentHotel ? $currentHotel->name : 'Morada Lodge' }}</span>
                        <h2 class="section-title">Une expérience unique au Bénin</h2>
                    </div>
                    <p class="lead-text mb-4">
                        Situé à Covè, {{ $currentHotel ? $currentHotel->name : 'Morada Lodge' }} offre un cadre paisible où nature, confort et hospitalité béninoise se rencontrent. 
                        Entre hébergements élégants, piscine extérieure et restaurant aux saveurs locales et internationales, 
                        chaque séjour est pensé pour offrir détente, bien-être et authenticité.
                    </p>
                    <p class="lead-text mb-4">
                        Que ce soit pour une escapade de détente ou un séjour spécial, {{ $currentHotel ? $currentHotel->name : 'Morada Lodge' }} vous accueille 
                        dans un environnement naturel et raffiné propice à des moments inoubliables.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Chambres -->
    <section class="rooms-section py-7">
        <div class="container">
            <div class="text-center mb-6" data-aos="fade-up">
                <span class="section-tag">Nos Suites</span>
                <h2 class="section-title">Chambres & Suites d'Exception</h2>
                <p class="section-subtitle mx-auto">
                    Des espaces où le raffinement rencontre le confort absolu
                </p>
            </div>

            <div class="row g-4">
                <!-- Bungalows Majestueux -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="room-card-modern">
                        <div class="room-image-wrapper">
                            <img src="{{ asset('img/room/buglow.jpg') }}" 
                                 alt="Bungalows Majestueux"
                                 class="room-image">
                            <div class="room-status">
                                <span class="status-badge premium">
                                    <i class="fas fa-crown"></i> Premium
                                </span>
                            </div>
                            <button class="wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        
                        <div class="room-details">
                            <div class="room-header">
                                <div>
                                    <h3 class="room-name">Bungalows Majestueux</h3>
                                    <p class="room-type">Authenticité et Sérénité</p>
                                </div>
                                <span class="capacity-badge">
                                    <i class="fas fa-user"></i> 2-4
                                </span>
                            </div>
                            
                            <p class="room-description">
                                Authenticité et sérénité dans des hébergements traditionnels réinventés avec tout le confort moderne.
                            </p>
                            
                            <div class="room-specs">
                                <div class="spec-item">
                                    <i class="fas fa-tree"></i>
                                    <span>Terrasse privée avec vue jardin</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-snowflake"></i>
                                    <span>Climatisation et ventilateur</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-bath"></i>
                                    <span>Salle de bain privée luxueuse</span>
                                </div>
                            </div>
                            
                            <div class="room-footer">
                                <div class="price-info">
                                    <span class="price">125 000</span>
                                    <span class="price-label">FCFA/nuit</span>
                                </div>
                                <a href="{{ route('frontend.reservation') }}?room=Bungalows&room_type=Bungalows Majestueux&price=125000" class="btn-view">
                                    Réserver
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chambre Confort -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="room-card-modern">
                        <div class="room-image-wrapper">
                            <img src="{{ asset('img/room/lit.jpg') }}" 
                                 alt="Chambre Confort"
                                 class="room-image">
                            <div class="room-status">
                                <span class="status-badge classic">
                                    <i class="fas fa-star"></i> Classic
                                </span>
                            </div>
                            <button class="wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        
                        <div class="room-details">
                            <div class="room-header">
                                <div>
                                    <h3 class="room-name">Chambre Confort</h3>
                                    <p class="room-type">Élégance et Pratique</p>
                                </div>
                                <span class="capacity-badge">
                                    <i class="fas fa-user"></i> 1-2
                                </span>
                            </div>
                            
                            <p class="room-description">
                                Élégantes et pratiques, parfaites pour un séjour alliant simplicité et raffinement à prix accessible.
                            </p>
                            
                            <div class="room-specs">
                                <div class="spec-item">
                                    <i class="fas fa-bed"></i>
                                    <span>Lit queen size confortable</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-wifi"></i>
                                    <span>Wi-Fi haut débit gratuit</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-tv"></i>
                                    <span>Minibar et télévision HD</span>
                                </div>
                            </div>
                            
                            <div class="room-footer">
                                <div class="price-info">
                                    <span class="price">20 000</span>
                                    <span class="price-label">FCFA/nuit</span>
                                </div>
                                <a href="{{ route('frontend.reservation') }}?room=Confort&room_type=Chambre Confort&price=20000" class="btn-view">
                                    Réserver
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Suite Présidentielle -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="room-card-modern">
                        <div class="room-image-wrapper">
                            <img src="{{ asset('img/room/suite.jpg') }}" 
                                 alt="Suite Présidentielle"
                                 class="room-image">
                            <div class="room-status">
                                <span class="status-badge prestige">
                                    <i class="fas fa-gem"></i> Prestige
                                </span>
                            </div>
                            <button class="wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        
                        <div class="room-details">
                            <div class="room-header">
                                <div>
                                    <h3 class="room-name">Suite Présidentielle</h3>
                                    <p class="room-type">Prestige et Luxe</p>
                                </div>
                                <span class="capacity-badge">
                                    <i class="fas fa-user"></i> 2-4
                                </span>
                            </div>
                            
                            <p class="room-description">
                                L'expérience ultime du luxe avec vue panoramique, service personnalisé et prestations d'exception.
                            </p>
                            
                            <div class="room-specs">
                                <div class="spec-item">
                                    <i class="fas fa-door-open"></i>
                                    <span>Suite 2 pièces avec salon privé</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-mountain"></i>
                                    <span>Balcon avec vue panoramique</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-concierge-bell"></i>
                                    <span>Service de conciergerie 24h/24</span>
                                </div>
                            </div>
                            
                            <div class="room-footer">
                                <div class="price-info">
                                    <span class="price">250 000</span>
                                    <span class="price-label">FCFA/nuit</span>
                                </div>
                                <a href="{{ route('frontend.reservation') }}?room=Presidentielle&room_type=Suite Présidentielle&price=250000" class="btn-view">
                                    Réserver
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('frontend.rooms') }}" class="btn-modern btn-outline-lg">
                    Voir toutes les suites
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Section Services -->
    <section class="services-section py-7">
        <div class="container">
            <div class="text-center mb-6" data-aos="fade-up">
                <span class="section-tag">Expériences</span>
                <h2 class="section-title">Services d'Exception</h2>
                <p class="section-subtitle mx-auto">
                    Des prestations sur-mesure pour sublimer votre séjour
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="0">
                    <div class="service-card-modern">
                        <div class="service-icon-wrapper">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h3>Gastronomie</h3>
                        <p>Saveurs d'Afrique & du Monde<br>Notre restaurant vous invite à un</p>
                        <a href="{{ route('frontend.contact') }}?subject=Restaurant" class="service-link">
                            Découvrir <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="service-card-modern">
                        <div class="service-icon-wrapper">
                            <i class="fas fa-swimming-pool"></i>
                        </div>
                        <h3>Piscine Extérieure</h3>
                        <p>Piscine avec vue jardin pour détente et rafraîchissement</p>
                        <a href="{{ route('frontend.contact') }}?subject=Piscine" class="service-link">
                            Découvrir <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-card-modern">
                        <div class="service-icon-wrapper">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h3>Wi-Fi Gratuit</h3>
                        <p>Internet haut débit disponible dans tout l'établissement</p>
                        <a href="{{ route('frontend.contact') }}?subject=WiFi" class="service-link">
                            Découvrir <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="service-card-modern">
                        <div class="service-icon-wrapper">
                            <i class="fas fa-parking"></i>
                        </div>
                        <h3>Parking Sécurisé</h3>
                        <p>Stationnement gratuit et surveillé 24h/24 pour nos clients</p>
                        <a href="{{ route('frontend.contact') }}?subject=Parking" class="service-link">
                            Découvrir <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Témoignages -->
    <section class="testimonials-section py-7">
        <div class="container">
            <div class="text-center mb-6" data-aos="fade-up">
                <span class="section-tag light">Témoignages</span>
                <h2 class="section-title text-white">Ce que disent nos hôtes</h2>
                <p class="section-subtitle text-white-50 mx-auto">
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
                            Un séjour absolument magique ! L'accueil chaleureux, la cuisine exceptionnelle et le cadre paradisiaque ont rendu notre lune de miel inoubliable.
                        </p>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" 
                                 alt="Sophie Martin"
                                 class="author-avatar">
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
                            La tranquillité du lieu et la qualité des services font de {{ $currentHotel ? $currentHotel->name : 'Morada Lodge' }} une adresse incontournable. Nous reviendrons sans hésiter !
                        </p>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                                 alt="James Thompson"
                                 class="author-avatar">
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
                            Un véritable havre de paix où service impeccable rime avec authenticité. La découverte culinaire a été un vrai bonheur !
                        </p>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                                 alt="Amina Diallo"
                                 class="author-avatar">
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
                        <h2 class="cta-title">Vivez l'Expérience {{ $currentHotel ? $currentHotel->name : 'Morada Lodge' }}</h2>
                        <p class="cta-text">
                            Réservez dès maintenant et bénéficiez d'une offre exclusive de bienvenue
                        </p>
                        <div class="cta-actions">
                            <a href="{{ route('frontend.contact') }}" class="btn-modern btn-primary-lg">
                                <i class="fas fa-calendar-check me-2"></i>
                                Réserver maintenant
                            </a>
                            <a href="tel:+2290167836481" class="btn-modern btn-white-lg">
                                <i class="fas fa-phone me-2"></i>
                                +229 0167836481
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center" data-aos="fade-left">
                        <div class="availability-badge">
                            <div class="badge-circle">
                                <span class="availability-text">Disponible</span>
                                <span class="availability-hours">24h/24</span>
                                <span class="availability-desc">Service client</span>
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

<!-- Style spécifique pour Hotel Paradise -->
@if(request()->get('hotel_id') == 3 || (isset($currentHotel) && $currentHotel->id == 3))
<style>
    .hero-modern {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.8) 0%, rgba(30, 126, 52, 0.6) 100%), 
                    url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') !important;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        overflow: hidden;
        display: flex;
        align-items: center;
    }
    
    /* Forcer le fond vert sur tous les éléments */
    .hero-modern * {
        background-color: transparent !important;
    }
    
    /* S'assurer que le fond reste vert */
    body .hero-modern {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.8) 0%, rgba(30, 126, 52, 0.6) 100%), 
                    url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') !important;
    }
    
    /* Styles Hotel Paradise pour les sections */
    .services-section {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%) !important;
    }
    
    .service-card-modern {
        background: white;
        border: 2px solid rgba(40, 167, 69, 0.1);
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.1);
    }
    
    .service-card-modern::before {
        background: linear-gradient(90deg, #007bff, #0056b3);
    }
    
    .service-icon-wrapper {
        background: linear-gradient(135deg, #007bff, #0056b3);
        box-shadow: 0 10px 25px rgba(0, 123, 255, 0.3);
    }
    
    .service-card-modern h3 {
        color: #0056b3;
    }
    
    .service-link {
        color: #007bff;
    }
    
    .service-link:hover {
        color: #0056b3;
    }
    
    .testimonials-section {
        background: linear-gradient(135deg, #0056b3 0%, #007bff 100%) !important;
    }
    
    .testimonial-card-modern {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid rgba(0, 123, 255, 0.2);
    }
    
    .quote-icon {
        background: #007bff;
    }
    
    .rating i {
        color: #007bff;
    }
    
    .author-avatar {
        border-color: #007bff;
    }
    
    .stats-row {
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(0, 123, 255, 0.3);
    }
    
    .cta-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
    }
    
    .cta-wrapper {
        background: white;
        border: 2px solid rgba(0, 123, 255, 0.1);
        box-shadow: 0 20px 40px rgba(0, 123, 255, 0.15);
    }
    
    .cta-title {
        color: #0056b3;
    }
    
    /* Cercle Service client - couleur neutre */
    .badge-circle {
        background: linear-gradient(135deg, #007bff, #0056b3) !important;
        border: 3px solid #007bff !important;
        box-shadow: 0 10px 30px rgba(0, 123, 255, 0.3) !important;
    }
    
    .availability-text {
        color: white !important;
        font-weight: 600 !important;
    }
    
    .availability-hours {
        color: #f8f9fa !important;
        font-weight: 700 !important;
    }
    
    .availability-desc {
        color: rgba(255, 255, 255, 0.9) !important;
    }
    
    .badge-circle:hover {
        background: linear-gradient(135deg, #0056b3, #007bff) !important;
        border-color: #0056b3 !important;
        box-shadow: 0 15px 40px rgba(0, 123, 255, 0.4) !important;
    }
    
    /* Correction superposition entre hero et introduction */
    .hero-modern {
        position: relative !important;
        z-index: 1 !important;
        overflow: hidden !important;
    }
    
    .intro-section {
        position: relative !important;
        z-index: 2 !important;
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%) !important;
        margin-top: 0 !important;
        padding-top: 100px !important;
    }
    
    /* Correction superposition des textes dans les cartes de chambres */
    .room-card-modern {
        background: white !important;
        border: 2px solid rgba(40, 167, 69, 0.1) !important;
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.1) !important;
        overflow: hidden !important;
        position: relative !important;
        z-index: 1 !important;
    }
    
    .room-card-modern:hover {
        box-shadow: 0 15px 40px rgba(40, 167, 69, 0.2) !important;
        z-index: 2 !important;
    }
    
    .room-details {
        background: white !important;
        position: relative !important;
        z-index: 3 !important;
        padding: 25px !important;
    }
    
    .room-header {
        background: transparent !important;
        position: relative !important;
        z-index: 4 !important;
    }
    
    .room-name {
        color: #1e7e34 !important;
        background: transparent !important;
        position: relative !important;
        z-index: 5 !important;
    }
    
    .room-type {
        color: rgba(40, 167, 69, 0.7) !important;
        background: transparent !important;
    }
    
    .room-description {
        color: var(--text-gray) !important;
        background: transparent !important;
        position: relative !important;
        z-index: 5 !important;
        line-height: 1.6 !important;
        margin-bottom: 15px !important;
    }
    
    .room-specs {
        background: transparent !important;
        position: relative !important;
        z-index: 5 !important;
    }
    
    .spec-item {
        color: var(--text-gray) !important;
        background: transparent !important;
    }
    
    .spec-item i {
        color: #007bff !important;
    }
    
    .room-footer {
        background: white !important;
        border-top: 1px solid rgba(40, 167, 69, 0.2) !important;
        position: relative !important;
        z-index: 6 !important;
    }
    
    .price {
        color: #007bff !important;
        background: transparent !important;
    }
    
    .btn-view {
        background: #007bff !important;
        color: white !important;
        border: none !important;
        position: relative !important;
        z-index: 7 !important;
    }
    
    .btn-view:hover {
        background: #0056b3 !important;
        color: white !important;
    }
    
    .status-badge {
        background: rgba(255, 255, 255, 0.95) !important;
        border: 1px solid rgba(40, 167, 69, 0.2) !important;
        position: relative !important;
        z-index: 10 !important;
    }
    
    .status-badge.premium {
        color: #007bff !important;
        background: rgba(0, 123, 255, 0.1) !important;
        border-color: #007bff !important;
    }
    
    .status-badge.classic {
        color: var(--text-gray) !important;
        background: rgba(107, 114, 128, 0.1) !important;
        border-color: rgba(107, 114, 128, 0.3) !important;
    }
    
    .wishlist-btn {
        background: rgba(255, 255, 255, 0.95) !important;
        border: 1px solid rgba(40, 167, 69, 0.2) !important;
        position: relative !important;
        z-index: 10 !important;
    }
    
    /* Animations de superposition désactivées pour Hotel Paradise */
</style>
@endif
<style>
/* ============================================
   VARIABLES & BASE
   ============================================ */
:root {
    /* Couleurs neutres - PLUS de marron */
    --primary-brown: #007bff;
    --secondary-brown: #6c757d;
    --accent-gold: #007bff;
    --dark-brown: #343a40;
    --light-brown: #f8f9fa;
    --warm-beige: #ffffff;
    
    /* Legacy variables for compatibility */
    --cactus-green: var(--primary-brown);
    --cactus-light: var(--secondary-brown);
    --cactus-dark: var(--dark-brown);
    --gold-accent: var(--accent-gold);
    --light-bg: var(--warm-beige);
    --white: #FFFFFF;
    --text-dark: #1A1A1A;
    --text-gray: #6B7280;
    --border-color: #E5E7EB;
    
    --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    --shadow-sm: 0 2px 8px rgba(139, 69, 19, 0.08);
    --shadow-md: 0 8px 24px rgba(139, 69, 19, 0.12);
    --shadow-lg: 0 16px 48px rgba(139, 69, 19, 0.16);
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
    background: linear-gradient(135deg, rgba(101, 67, 33, 0.8) 0%, rgba(139, 69, 19, 0.6) 100%), 
                url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
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
    color: var(--gold-accent);
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
    border-color: var(--cactus-green);
    box-shadow: 0 0 0 4px rgba(123, 104, 86, 0.1);
}

.btn-search {
    padding: 14px 30px;
    background: var(--cactus-green);
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
    background: var(--cactus-light);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* Scroll Indicator */
.scroll-indicator {
    position: absolute;
    bottom: 40px;
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
    border: 2px solid rgba(255, 255, 255, 0.6);
    border-radius: 12px;
    position: relative;
}

.mouse::before {
    content: '';
    position: absolute;
    top: 8px;
    left: 50%;
    transform: translateX(-50%);
    width: 4px;
    height: 8px;
    background: rgba(255, 255, 255, 0.6);
    border-radius: 2px;
    animation: scroll 2s infinite;
}

@keyframes scroll {
    0% { transform: translateX(-50%) translateY(0); opacity: 1; }
    100% { transform: translateX(-50%) translateY(12px); opacity: 0; }
}

/* ============================================
   INTRODUCTION SECTION
   ============================================ */
.intro-section {
    background: var(--warm-beige);
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
    transition: transform 0.6s ease;
}

.main-image:hover img {
    transform: scale(1.05);
}

.floating-badge {
    position: absolute;
    top: 30px;
    right: 30px;
    z-index: 2;
}

.badge-content {
    background: var(--primary-brown);
    color: white;
    padding: 20px;
    border-radius: 16px;
    text-align: center;
    box-shadow: var(--shadow-md);
    min-width: 100px;
}

.badge-content h3 {
    font-size: 2rem;
    margin-bottom: 5px;
    font-weight: 700;
}

.badge-content p {
    font-size: 0.9rem;
    margin: 0;
    font-weight: 500;
}

/* Availability Badge Styles */
.availability-badge {
    display: flex;
    justify-content: center;
    align-items: center;
}

.badge-circle {
    width: 160px;
    height: 160px;
    background: rgba(255, 255, 255, 0.1);
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.badge-circle:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.5);
    transform: scale(1.05);
}

.availability-text {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--white);
    line-height: 1;
}

.availability-hours {
    font-size: 2rem;
    font-weight: 700;
    color: var(--gold-accent);
    line-height: 1;
    margin: 5px 0;
}

.availability-desc {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.8);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.decoration-element {
    position: absolute;
    bottom: -20px;
    left: -20px;
    width: 100px;
    height: 100px;
    background: var(--accent-gold);
    border-radius: 50%;
    opacity: 0.3;
    z-index: -1;
}

.section-tag {
    display: inline-block;
    padding: 6px 20px;
    background: rgba(139, 69, 19, 0.1);
    color: var(--primary-brown);
    border-radius: 50px;
    font-size: 13px;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 15px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--dark-brown);
    margin-bottom: 20px;
}

.lead-text {
    font-size: 1.1rem;
    color: var(--text-gray);
    line-height: 1.8;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.feature-icon {
    width: 50px;
    height: 50px;
    background: var(--light-brown);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-brown);
    font-size: 1.2rem;
    flex-shrink: 0;
}

.feature-content h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--dark-brown);
    margin-bottom: 5px;
}

.feature-content p {
    font-size: 0.9rem;
    color: var(--text-gray);
    margin: 0;
}

/* ============================================
   ROOMS SECTION
   ============================================ */
.rooms-section {
    background: white;
}

.room-card-modern:hover {
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
    filter: brightness(1.05);
}

.room-status {
    position: absolute;
    top: 15px;
    right: 15px;
}

.status-badge {
    background: rgba(255, 255, 255, 0.9);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    backdrop-filter: blur(10px);
}

.status-badge.available {
    color: #22c55e;
}

.status-badge.on-request {
    color: #f59e0b;
}

.status-badge.premium {
    color: #007bff;
    background: rgba(0, 123, 255, 0.1);
}

.status-badge.classic {
    color: #6b7280;
    background: rgba(107, 114, 128, 0.1);
}

.status-badge.prestige {
    color: #6c757d;
    background: rgba(108, 117, 125, 0.1);
}

.wishlist-btn {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.wishlist-btn:hover {
    background: white;
    color: #ef4444;
}

.room-details {
    padding: 25px;
}

.room-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.room-name {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--dark-brown);
    margin: 0;
}

.room-type {
    color: var(--text-gray);
    margin: 5px 0;
}

.capacity-badge {
    background: var(--light-brown);
    color: var(--primary-brown);
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.room-description {
    color: var(--text-gray);
    margin-bottom: 15px;
    line-height: 1.5;
}

.room-specs {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 20px;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-gray);
    font-size: 0.9rem;
}

.spec-item i {
    color: var(--primary-brown);
    width: 16px;
}

.room-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid var(--border-color);
}

.price {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-brown);
}

.price-label {
    color: var(--text-gray);
    font-size: 0.9rem;
}

.btn-view {
    background: var(--primary-brown);
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-view:hover {
    background: var(--secondary-brown);
    color: white;
}

/* ============================================
   BUTTONS STYLES
   ============================================ */
.btn-modern {
    padding: 15px 30px;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition-smooth);
    display: inline-flex;
    align-items: center;
    gap: 10px;
    border: 2px solid transparent;
}

.btn-modern.btn-primary {
    background: var(--primary-brown);
    color: white;
}

.btn-modern.btn-primary:hover {
    background: var(--secondary-brown);
    box-shadow: var(--shadow-md);
}

.btn-modern.btn-outline {
    background: transparent;
    color: white;
    border-color: white;
}

.btn-modern.btn-outline:hover {
    background: white;
    color: var(--primary-brown);
}

.btn-modern.btn-outline-lg {
    background: transparent;
    color: var(--primary-brown);
    border-color: var(--primary-brown);
}

.btn-modern.btn-outline-lg:hover {
    background: var(--primary-brown);
    color: white;
}

.btn-modern.btn-primary-lg {
    background: var(--accent-gold);
    color: var(--dark-brown);
}

.btn-modern.btn-primary-lg:hover {
    background: white;
    color: var(--primary-brown);
}

.btn-modern.btn-white-lg {
    background: transparent;
    color: white;
    border-color: white;
}

.btn-modern.btn-white-lg:hover {
    background: white;
    color: var(--primary-brown);
}

/* ============================================
   SERVICES SECTION
   ============================================ */
.services-section {
    background: var(--warm-beige);
    padding: 100px 0;
}

.service-card-modern {
    background: white;
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(139, 69, 19, 0.1);
    height: 100%;
    position: relative;
    overflow: hidden;
}

.service-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-brown), var(--accent-gold));
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.service-card-modern:hover::before {
    transform: scaleX(1);
}

.service-card-modern:hover {
    box-shadow: 0 20px 40px rgba(139, 69, 19, 0.15);
    border-color: var(--primary-brown);
}

.service-icon-wrapper {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-brown), var(--secondary-brown));
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    transition: all 0.3s ease;
    color: white;
    font-size: 2rem;
}

.service-card-modern:hover .service-icon-wrapper {
    box-shadow: 0 10px 25px rgba(139, 69, 19, 0.3);
}

.service-card-modern h3 {
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--dark-brown);
    margin-bottom: 15px;
}

.service-card-modern p {
    color: var(--text-gray);
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.service-link {
    color: var(--primary-brown);
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.service-link:hover {
    color: var(--secondary-brown);
}

/* ============================================
   TESTIMONIALS SECTION
   ============================================ */
.testimonials-section {
    background: linear-gradient(135deg, var(--dark-brown) 0%, var(--primary-brown) 100%);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}

.testimonials-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.testimonial-card-modern {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 35px;
    position: relative;
    transition: all 0.4s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
    height: 100%;
}

.testimonial-card-modern:hover {
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    background: rgba(255, 255, 255, 0.98);
}

.quote-icon {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    background: var(--accent-gold);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    opacity: 0.8;
}

.rating {
    display: flex;
    gap: 5px;
    margin-bottom: 20px;
}

.rating i {
    color: var(--accent-gold);
    font-size: 1.1rem;
}

.testimonial-text {
    color: var(--text-dark);
    line-height: 1.7;
    font-style: italic;
    margin-bottom: 25px;
    font-size: 1rem;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 15px;
}

.author-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--accent-gold);
}

.author-info h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--dark-brown);
    margin: 0;
}

.author-info p {
    color: var(--text-gray);
    margin: 0;
    font-size: 0.9rem;
}

/* ============================================
   STATS SECTION
   ============================================ */
.stats-row {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.stat-item {
    text-align: center;
    padding: 20px;
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: white;
    margin-bottom: 10px;
    display: block;
    animation: countUp 2s ease-out;
}

.stat-label {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1rem;
    margin-bottom: 15px;
}

.stat-stars {
    display: flex;
    justify-content: center;
    gap: 3px;
}

.stat-stars i {
    color: var(--accent-gold);
    font-size: 1rem;
}

@keyframes countUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ============================================
   CTA SECTION
   ============================================ */
.cta-section {
    background: var(--warm-beige);
    padding: 100px 0;
}

.cta-wrapper {
    background: white;
    border-radius: 20px;
    padding: 60px;
    box-shadow: 0 20px 40px rgba(139, 69, 19, 0.1);
    border: 1px solid rgba(139, 69, 19, 0.1);
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--dark-brown);
    margin-bottom: 20px;
}

.cta-text {
    color: var(--text-gray);
    font-size: 1.1rem;
    margin-bottom: 30px;
    line-height: 1.6;
}

.cta-actions {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

/* ============================================
   RESPONSIVE DESIGN
   ============================================ */
@media (max-width: 768px) {
    .booking-form {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .cta-actions {
        flex-direction: column;
    }
    
    .cta-title {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .room-specs {
        flex-direction: column;
        gap: 10px;
    }
    
    .room-footer {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .hero-cta {
        flex-direction: column;
        align-items: center;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    // Formulaire de recherche
    document.querySelector('.booking-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const params = new URLSearchParams();
        
        for (let [key, value] of formData.entries()) {
            if (value) params.append(key, value);
        }
        
        window.location.href = '{{ route("frontend.rooms") }}?' + params.toString();
    });

    // Wishlist buttons
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            this.querySelector('i').classList.toggle('far');
            this.querySelector('i').classList.toggle('fas');
        });
    });

    // Animations améliorées pour les services
    const serviceCards = document.querySelectorAll('.service-card-modern');
    serviceCards.forEach((card, index) => {
        card.addEventListener('mouseenter', function() {
            // Animation de l'icône
            const icon = this.querySelector('.service-icon-wrapper');
            if (icon) {
                icon.style.transform = 'scale(1.2) rotate(10deg)';
                icon.style.transition = 'all 0.3s ease';
            }
            
            // Animation du texte
            const title = this.querySelector('h3');
            if (title) {
                title.style.color = '#007bff';
                title.style.transition = 'all 0.3s ease';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            const icon = this.querySelector('.service-icon-wrapper');
            if (icon) {
                icon.style.transform = 'scale(1) rotate(0deg)';
            }
            
            const title = this.querySelector('h3');
            if (title) {
                title.style.color = '';
            }
        });
    });

    // Animations pour les témoignages
    const testimonialCards = document.querySelectorAll('.testimonial-card-modern');
    testimonialCards.forEach((card, index) => {
        // Animation au scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        entry.target.style.transition = 'all 0.6s ease';
                    }, index * 200);
                }
            });
        }, { threshold: 0.1 });
        
        observer.observe(card);
        
        // Animation au hover
        card.addEventListener('mouseenter', function() {
            const quote = this.querySelector('.quote-icon');
            if (quote) {
                quote.style.transform = 'scale(1.2) rotate(15deg)';
                quote.style.transition = 'all 0.3s ease';
            }
            
            const avatar = this.querySelector('.author-avatar');
            if (avatar) {
                avatar.style.transform = 'scale(1.1)';
                avatar.style.transition = 'all 0.3s ease';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            const quote = this.querySelector('.quote-icon');
            if (quote) {
                quote.style.transform = 'scale(1) rotate(0deg)';
            }
            
            const avatar = this.querySelector('.author-avatar');
            if (avatar) {
                avatar.style.transform = 'scale(1)';
            }
        });
    });

    // Animation des statistiques - DÉSACTIVÉE
    /*
    const statNumbers = document.querySelectorAll('.stat-number');
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalValue = parseFloat(target.textContent);
                let currentValue = 0;
                const increment = finalValue / 50;
                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        currentValue = finalValue;
                        clearInterval(timer);
                    }
                    
                    if (target.textContent.includes('.')) {
                        target.textContent = currentValue.toFixed(1);
                    } else if (target.textContent.includes('+')) {
                        target.textContent = Math.floor(currentValue) + '+';
                    } else if (target.textContent.includes('★')) {
                        target.textContent = '5★';
                    } else {
                        target.textContent = Math.floor(currentValue) + '%';
                    }
                }, 30);
                
                statsObserver.unobserve(target);
            }
        });
    }, { threshold: 0.5 });
    
    statNumbers.forEach(stat => statsObserver.observe(stat));
    */

    // Animation pour la section CTA - DÉSACTIVÉE
    /*
    const ctaSection = document.querySelector('.cta-section');
    if (ctaSection) {
        const ctaObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const wrapper = entry.target.querySelector('.cta-wrapper');
                    if (wrapper) {
                        wrapper.style.opacity = '0';
                        wrapper.style.transform = 'translateY(30px)';
                        wrapper.style.transition = 'all 0.8s ease';
                        
                        setTimeout(() => {
                            wrapper.style.opacity = '1';
                            wrapper.style.transform = 'translateY(0)';
                        }, 200);
                    }
                    
                    const badge = entry.target.querySelector('.badge-circle');
                    if (badge) {
                        badge.style.transform = 'scale(0)';
                        badge.style.transition = 'all 0.6s ease';
                        
                        setTimeout(() => {
                            badge.style.transform = 'scale(1)';
                        }, 600);
                    }
                    
                    ctaObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        
        ctaObserver.observe(ctaSection);
    }
    */

    // Effet de parallaxe pour l'hero - DÉSACTIVÉ
    /*
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero-modern');
        if (hero) {
            hero.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });
    */

    // Animation des liens de service - DÉSACTIVÉE
    /*
    document.querySelectorAll('.service-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const icon = this.querySelector('i');
            if (icon) {
                icon.style.transform = 'translateX(10px)';
                icon.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    window.location.href = this.href;
                }, 300);
            } else {
                window.location.href = this.href;
            }
        });
    });
    */
</script>
@endpush
