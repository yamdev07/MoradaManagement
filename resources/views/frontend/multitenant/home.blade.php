@extends('frontend.layouts.master')

@section('title', $currentHotel->name ?? 'Morada Lodge - Accueil')

@push('styles')
<style>
:root {
    --primary-color: {{ $currentHotel->theme_settings['primary_color'] ?? '#8b4513' }};
    --secondary-color: {{ $currentHotel->theme_settings['secondary_color'] ?? '#a0522d' }};
    --accent-color: {{ $currentHotel->theme_settings['accent_color'] ?? '#cd853f' }};
    --background-color: {{ $currentHotel->theme_settings['background_color'] ?? '#f4f1e8' }};
    --text-color: {{ $currentHotel->theme_settings['text_color'] ?? '#2c3e50' }};
    --font-family: {{ $currentHotel->theme_settings['font_family'] ?? 'Inter' }};
}

body {
    font-family: var(--font-family), -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background-color: var(--background-color);
    color: var(--text-color);
}

.hero-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
    background-image: none !important;
    background-attachment: scroll !important;
    color: white;
    padding: 120px 0 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    display: none !important;
    content: none !important;
}

.hero-section::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
    transform: rotate(45deg);
    animation: shimmer 8s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

.hero-content h1 {
    font-size: 4rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    text-shadow: 3px 3px 6px rgba(0,0,0,0.4);
    animation: fadeInUp 1s ease-out;
}

.hero-content .lead {
    font-size: 1.4rem;
    margin-bottom: 2.5rem;
    opacity: 0.95;
    animation: fadeInUp 1s ease-out 0.2s both;
}

.hotel-info {
    background: rgba(255,255,255,0.15);
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 20px;
    padding: 2rem;
    display: inline-block;
    backdrop-filter: blur(15px);
    animation: fadeInUp 1s ease-out 0.4s both;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
}

.hotel-name {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: white;
}

.hotel-contact {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 0.3rem;
}

.cta-buttons {
    animation: fadeInUp 1s ease-out 0.6s both;
}

.btn-primary-custom {
    background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-color) 100%);
    border: none;
    color: white;
    padding: 15px 35px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.btn-primary-custom:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    color: white;
}

.btn-outline-custom {
    background: transparent;
    border: 2px solid white;
    color: white;
    padding: 15px 35px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.btn-outline-custom:hover {
    background: white;
    color: var(--primary-color);
    transform: translateY(-3px);
}

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
    .hero-content h1 {
        font-size: 2.5rem;
    }
    
    .hero-content .lead {
        font-size: 1.1rem;
    }
    
    .hotel-name {
        font-size: 1.6rem;
    }
    
    .btn-primary-custom, .btn-outline-custom {
        padding: 12px 25px;
        font-size: 1rem;
    }
}
</style>
@endpush

@section('content')
<!-- Section Hero avec thème personnalisé -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1>{{ $currentHotel->name ?? 'Morada Lodge' }}</h1>
            <p class="lead">
                {{ $currentHotel->description ?? 'Bienvenue dans votre hôtel de luxe' }}
            </p>
            
            <!-- Informations de l'hôtel -->
            <div class="hotel-info mb-4">
                <div class="hotel-name">{{ $currentHotel->name }}</div>
                @if($currentHotel->address)
                    <div class="hotel-contact">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        {{ $currentHotel->address }}
                    </div>
                @endif
                @if($currentHotel->contact_phone)
                    <div class="hotel-contact">
                        <i class="fas fa-phone me-2"></i>
                        {{ $currentHotel->contact_phone }}
                    </div>
                @endif
                @if($currentHotel->contact_email)
                    <div class="hotel-contact">
                        <i class="fas fa-envelope me-2"></i>
                        {{ $currentHotel->contact_email }}
                    </div>
                @endif
            </div>
            
            <!-- Boutons d'action -->
            <div class="cta-buttons">
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    @if($currentHotel->theme_settings['enable_booking'] ?? true)
                        <a href="{{ route('multitenant.reservation') }}" class="btn-primary-custom">
                            <i class="fas fa-calendar-check me-2"></i>
                            Réserver maintenant
                        </a>
                    @endif
                    
                    <a href="{{ route('multitenant.rooms') }}" class="btn-outline-custom">
                        <i class="fas fa-bed me-2"></i>
                        Voir les chambres
                    </a>
                    
                    @if($currentHotel->theme_settings['enable_restaurant'] ?? true)
                        <a href="{{ route('multitenant.restaurant') }}" class="btn-outline-custom">
                            <i class="fas fa-utensils me-2"></i>
                            Restaurant
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Chambres en Vedette -->
@if($featuredRooms->count() > 0)
<section class="featured-rooms" style="background-color: var(--background-color);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title" style="color: var(--text-color);">
                Nos Chambres Exceptionnelles
            </h2>
            <p class="lead" style="color: var(--text-color); opacity: 0.8;">
                Découvrez nos chambres luxueuses conçues pour votre confort
            </p>
        </div>
        
        <div class="row g-4">
            @foreach($featuredRooms as $room)
            <div class="col-lg-4 col-md-6">
                <div class="card room-card shadow-lg">
                    @if($room->images && $room->images->first())
                        <img src="{{ asset('storage/rooms/' . $room->images->first()->image) }}" 
                             alt="{{ $room->name }}" 
                             class="room-image">
                    @else
                        <div class="room-image d-flex align-items-center justify-content-center" 
                             style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
                            <i class="fas fa-bed fa-3x text-white"></i>
                        </div>
                    @endif
                    
                    <div class="room-body">
                        <h3 class="room-title">{{ $room->name ?? 'Chambre ' . $room->number }}</h3>
                        <p class="text-muted">{{ $room->description ?? 'Chambre confortable et élégante' }}</p>
                        
                        <div class="room-price">
                            {{ number_format($room->price, 0, ',', ' ') }} FCFA
                            <small class="text-muted">/ nuit</small>
                        </div>
                        
                        <div class="room-features">
                            <span class="feature-tag">
                                <i class="fas fa-users me-1"></i>
                                {{ $room->capacity }} personne{{ $room->capacity > 1 ? 's' : '' }}
                            </span>
                            @if($room->type)
                                <span class="feature-tag">
                                    <i class="fas fa-star me-1"></i>
                                    {{ $room->type->name }}
                                </span>
                            @endif
                        </div>
                        
                        <a href="{{ route('multitenant.room.details', $room->id) }}" 
                           class="btn-hotel w-100">
                            <i class="fas fa-eye me-2"></i>
                            Voir les détails
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('multitenant.rooms') }}" class="btn-primary-custom">
                <i class="fas fa-th-large me-2"></i>
                Voir toutes les chambres
            </a>
        </div>
    </div>
</section>
@endif

<!-- Section Services -->
@if($currentHotel->theme_settings['enable_restaurant'] ?? true)
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4">Services Premium</h2>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-utensils fa-2x me-3"></i>
                            <div>
                                <h5 class="mb-1">Restaurant Gastronomique</h5>
                                <small>Cuisine raffinée</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-spa fa-2x me-3"></i>
                            <div>
                                <h5 class="mb-1">Spa & Wellness</h5>
                                <small>Détente garantie</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-dumbbell fa-2x me-3"></i>
                            <div>
                                <h5 class="mb-1">Salle de Sport</h5>
                                <small>Équipement moderne</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-wifi fa-2x me-3"></i>
                            <div>
                                <h5 class="mb-1">WiFi High-Speed</h5>
                                <small>Connexion illimitée</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-concierge-bell fa-5x mb-3" style="opacity: 0.3;"></i>
                <h3>Service Client 24/7</h3>
                <p>Notre équipe est à votre disposition pour rendre votre séjour inoubliable</p>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Section Contact -->
<section class="py-5" style="background-color: var(--background-color);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="mb-4" style="color: var(--text-color);">Contactez-nous</h2>
                <p class="mb-4" style="color: var(--text-color); opacity: 0.8;">
                    Une question ? Une réservation spéciale ? Notre équipe est là pour vous aider.
                </p>
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-phone fa-2x mb-3" style="color: var(--primary-color);"></i>
                                <h5>Téléphone</h5>
                                <p class="text-muted">{{ $currentHotel->contact_phone ?? '+225 00 00 00 00' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope fa-2x mb-3" style="color: var(--primary-color);"></i>
                                <h5>Email</h5>
                                <p class="text-muted">{{ $currentHotel->contact_email ?? 'contact@morada.com' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marker-alt fa-2x mb-3" style="color: var(--primary-color);"></i>
                                <h5>Adresse</h5>
                                <p class="text-muted">{{ $currentHotel->address ?? 'Cocody, Abidjan' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('multitenant.contact') }}" class="btn-primary-custom">
                        <i class="fas fa-paper-plane me-2"></i>
                        Envoyer un message
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@if(request()->get('hotel_id') == 3 || (isset($currentHotel) && $currentHotel->id == 3))
<style>
    /* STYLE INLINE DIRECT DANS LA PAGE */
    body {
        background-color: #f0fdf4 !important;
    }
    
    .hero-section {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
        background-image: none !important;
        background-color: #28a745 !important;
    }
    
    .hero-section::before,
    .hero-section::after,
    *::before,
    *::after {
        display: none !important;
        content: none !important;
        background: none !important;
    }
    
    /* Remplacer le filtre par un filtre vert */
    .hero-section::before {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.4) 0%, rgba(30, 126, 52, 0.6) 100%) !important;
        display: block !important;
        content: '' !important;
    }
    
    .hero-section * {
        background: transparent !important;
    }
    
    .navbar {
        background-color: white !important;
    }
    
    .navbar-brand {
        color: #1e7e34 !important;
    }
    
    .nav-link {
        color: #1e7e34 !important;
    }
    
    .nav-link:hover {
        color: #28a745 !important;
    }
    
    .btn-primary-custom {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }
    
    .footer {
        background-color: #1e7e34 !important;
    }
</style>
@endif


<section class="hero-section" @if(request()->get('hotel_id') == 3 || (isset($currentHotel) && $currentHotel->id == 3)) style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important; background-image: none !important; background-color: #28a745 !important;" @endif>
    <div class="container">
        <div class="hero-content">
            @if($currentHotel)
            <div class="hotel-info">
                <div class="hotel-name">
                    <i class="fas fa-hotel me-2"></i>
                    {{ $currentHotel->name }}
                </div>
                <p class="mb-0">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    {{ $currentHotel->domain ?? 'Morada Lodge' }}
                </p>
            </div>
            @endif
            
            <h1>Bienvenue chez {{ $currentHotel ? $currentHotel->name : 'Morada Lodge' }}</h1>
            <p class="lead">
                Découvrez nos chambres de luxe et profitez d'un séjour inoubliable
            </p>
            
            <a href="{{ route('multitenant.rooms') }}" class="btn-hotel">
                <i class="fas fa-bed me-2"></i>
                Voir nos chambres
            </a>
        </div>
    </div>
</section>

<!-- Chambres en vedette -->
@if($featuredRooms->count() > 0)
<section class="featured-rooms">
    <div class="container">
        <h2 class="section-title">Chambres en vedette</h2>
        
        <div class="row">
            @foreach($featuredRooms as $room)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card room-card">
                    @if($room->images->count() > 0)
                    <img src="{{ asset('storage/' . $room->images->first()->image_path) }}" 
                         class="card-img-top room-image" 
                         alt="{{ $room->name }}">
                    @else
                    <div class="room-image d-flex align-items-center justify-content-center" 
                         style="background: var(--accent-color); color: var(--primary-color);">
                        <i class="fas fa-bed fa-3x"></i>
                    </div>
                    @endif
                    
                    <div class="card-body room-body">
                        <h5 class="room-title">{{ $room->name }}</h5>
                        
                        <div class="room-price">
                            {{ number_format($room->price, 0, ',', ' ') }} FCFA
                            <small>/nuit</small>
                        </div>
                        
                        <div class="room-features">
                            @if($room->capacity)
                            <span class="feature-tag">
                                <i class="fas fa-users me-1"></i>
                                {{ $room->capacity }} personnes
                            </span>
                            @endif
                            
                            @if($room->type)
                            <span class="feature-tag">
                                <i class="fas fa-tag me-1"></i>
                                {{ $room->type->name }}
                            </span>
                            @endif
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('multitenant.room.details', $room->id) }}" 
                               class="btn btn-hotel btn-sm">
                                <i class="fas fa-eye me-1"></i>
                                Détails
                            </a>
                            
                            <a href="{{ route('multitenant.reservation') }}?room_id={{ $room->id }}" 
                               class="btn btn-hotel btn-sm">
                                <i class="fas fa-calendar-check me-1"></i>
                                Réserver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('multitenant.rooms') }}" class="btn-hotel">
                <i class="fas fa-th me-2"></i>
                Voir toutes les chambres
            </a>
        </div>
    </div>
</section>
@else
<section class="featured-rooms">
    <div class="container">
        <div class="text-center py-5">
            <i class="fas fa-bed fa-4x mb-4" style="color: var(--primary-color);"></i>
            <h3>Aucune chambre disponible</h3>
            <p class="lead">Désolé, il n'y a actuellement aucune chambre disponible pour cet hôtel.</p>
            <a href="{{ route('multitenant.contact') }}" class="btn-hotel">
                <i class="fas fa-phone me-2"></i>
                Nous contacter
            </a>
        </div>
    </div>
</section>
@endif
@endsection

@if(request()->get('hotel_id') == 3 || (isset($currentHotel) && $currentHotel->id == 3))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Forcer le thème vert pour Hotel Paradise
        var heroElements = document.querySelectorAll('.hero-section');
        heroElements.forEach(function(element) {
            element.style.background = 'linear-gradient(135deg, #28a745 0%, #1e7e34 100%)';
            element.style.backgroundImage = 'none';
            element.style.backgroundColor = '#28a745';
        });
        
        // Supprimer tous les pseudo-éléments
        var style = document.createElement('style');
        style.innerHTML = `
            .hero-section::before,
            .hero-section::after,
            *::before,
            *::after {
                display: none !important;
                content: none !important;
                background: none !important;
            }
            
            .hero-section * {
                background: transparent !important;
            }
            
            body {
                background-color: #f0fdf4 !important;
            }
            
            .navbar {
                background-color: white !important;
            }
            
            .navbar-brand {
                color: #1e7e34 !important;
            }
            
            .nav-link {
                color: #1e7e34 !important;
            }
            
            .nav-link:hover {
                color: #28a745 !important;
            }
            
            .btn-primary-custom {
                background-color: #28a745 !important;
                border-color: #28a745 !important;
            }
            
            .footer {
                background-color: #1e7e34 !important;
            }
        `;
        document.head.appendChild(style);
        
        // Forcer le body en vert
        document.body.style.backgroundColor = '#f0fdf4';
        
        console.log('Hotel Paradise: Thème vert forcé dans la page multitenant');
    });
</script>
@endif
