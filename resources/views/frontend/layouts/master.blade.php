<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hôtel de luxe - Réservez votre séjour dans notre établissement 5 étoiles">
    <title>@yield('title', 'Hôtel Morada Lodge')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('img/logo_morada.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo_morada.jpg') }}">
    <link rel="shortcut icon" href="{{ asset('img/logo_morada.jpg') }}">
    

    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Styles personnalisés -->
    <style>
        :root {
            --primary-color: #654321; /* Brun Profond Riche */
            --secondary-color: #C5A059; /* Or Mat / Champagne */
            --accent-gold: #D4AF37; /* Or Brillant */
            --light-color: #FDFBF7; /* Crème Luxueux */
            --dark-color: #654321; /* Anthracite Brunâtre */
            --text-main: #333333; /* Gris foncé pour lisibilité */
            --text-muted: #666666;
        }
        
        body { 
            background-color: #FFFFFF;
            color: var(--text-main);
            font-family: 'Montserrat', sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--dark-color);
        }
        
        .bg-primary-custom {
            background-color: var(--primary-color) !important;
        }
        
        .text-brown-custom {
            color: var(--primary-color) !important;
        }

        .text-gold-accent {
            color: var(--secondary-color) !important;
        }
        
        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--dark-color);
            border-color: var(--dark-color);
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color) !important;
        }
        
        .hero-section {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 180px 0;
            position: relative;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }
        
        .hero-section .container {
            position: relative;
            z-index: 2;
        }
        
        .room-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .footer {
            background-color: var(--dark-color);
            color: rgba(255,255,255,0.8);
        }
        
        .social-icons a {
            color: white;
            margin: 0 10px;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }
        
        .social-icons a:hover {
            color: var(--secondary-color);
        }
        
        .nav-link {
            color: var(--dark-color) !important;
            font-weight: 500;
        }
        
        .nav-link:hover {
            color: var(--secondary-color) !important;
        }
        
        .btn-outline-primary-custom {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            background: transparent;
            font-weight: 600;
        }
        
        .btn-outline-primary-custom:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Styles pour les formulaires */
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(197, 160, 89, 0.2);
        }
        
        /* Cartes et conteneurs */
        .card {
            border: 1px solid rgba(0, 0, 0, 0.05);
            background-color: white;
            border-radius: 12px;
        }
        
        .card-header {
            background-color: var(--light-color);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            color: var(--primary-color);
            font-weight: 600;
        }
        
        /* Tables */
        .table-hover tbody tr:hover {
            background-color: rgba(197, 160, 89, 0.05);
        }
        
        /* Alertes */
        .alert-success {
            background-color: #E8F5E9;
            border-color: #C8E6C9;
            color: #654321;
        }
        
        /* Badges et Utilitaires */
        .bg-hotel-brown {
            background-color: var(--primary-color) !important;
            color: white !important;
        }
        
        .bg-hotel-gold {
            background-color: var(--secondary-color) !important;
            color: white !important;
        }
        
        .bg-hotel-light {
            background-color: var(--light-color) !important;
        }
        
        .text-hotel-brown {
            color: var(--primary-color) !important;
        }
        
        .text-hotel-gold {
            color: var(--secondary-color) !important;
        }
 
        /* Contrast Fixes */
        .bg-primary, .bg-hotel-brown, .bg-dark { color: #ffffff !important; }
        .btn-primary { 
            background-color: var(--primary-color) !important; 
            border-color: var(--primary-color) !important;
            color: #fff !important;
        }
        
        /* Force links to be visible and balanced */
        .navbar-nav .nav-link {
            color: #654321 !important;
            font-weight: 600 !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        /* Conflict Fixes between Tailwind and Bootstrap */
        .collapse:not(.navbar-collapse) {
            visibility: visible !important;
        }
        
        .collapse.navbar-collapse {
            visibility: visible !important;
        }
        
        .navbar-toggler {
            z-index: 1000;
        }

        /* Common Design Fixes */
        .bg-primary, .bg-hotel-brown, .bg-dark { color: #ffffff !important; }
        .text-white { color: #ffffff !important; }
        
        .room-stat-badge { color: var(--primary-color) !important; background: var(--secondary-color) !important; }
        
        .bg-primary { background-color: var(--primary-color) !important; }
        .text-primary { color: var(--primary-color) !important; }
        .btn-primary { 
            background-color: var(--primary-color) !important; 
            border-color: var(--primary-color) !important;
            color: #ffffff !important;
        }
        .btn-primary:hover { 
            background-color: var(--dark-color) !important; 
            border-color: var(--dark-color) !important; 
            color: #ffffff !important;
        }
        .card-header.bg-primary { background-color: var(--primary-color) !important; }
        .existing-customer-info { background-color: #FFFFFF !important; border-left: 4px solid var(--primary-color) !important; }
        .existing-customer-info h5 { color: var(--primary-color) !important; }
        
        .status-badge-available {
            background-color: rgba(197, 160, 89, 0.15);
            color: var(--primary-color);
            border: 1px solid var(--secondary-color);
            padding: 4px 12px;
            border-radius: 50px;
            font-weight: 600;
        }

        .status-badge-unavailable {
            background-color: rgba(0, 0, 0, 0.05);
            color: #666;
            border: 1px solid #ccc;
            padding: 4px 12px;
            border-radius: 50px;
            font-weight: 600;
        }

        /* Outline Brown Button */
        .btn-outline-hotel-brown {
            color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            background-color: transparent !important;
            transition: all 0.3s ease !important;
        }
        .btn-outline-hotel-brown:hover {
            background-color: var(--primary-color) !important;
            color: #ffffff !important;
        }
    </style>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        amber: {
                            600: '#654321',
                            700: '#654321',
                            800: '#4d3319',
                        }
                    },
                    fontFamily: {
                        playfair: ['Playfair Display', 'serif'],
                        montserrat: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top" style="z-index: 9999;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('frontend.home') }}">
                <img src="{{ asset('img/logo_morada.jpg') }}"
                    alt="Morada Lodge"
                    class="me-2"
                    style="height: 45px; width: auto;">
                <span style="color: #654321 !important; font-weight: 700;">Morada Lodge</span>
            </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.home') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.rooms') }}">Chambres & Suites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.restaurant') }}">Restaurant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.contact') }}">Contact</a>
                    </li>
                    
                    <!-- Bouton dashboard pour les utilisateurs connectés -->
                    @auth
                    <li class="nav-item ms-2">
                        <a href="{{ route('dashboard.index') }}" class="btn btn-outline-primary-custom">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    @else
                    <li class="nav-item ms-2">
                        <a href="{{ route('login') }}" class="btn btn-primary-custom">
                            <i class="fas fa-sign-in-alt me-1"></i> Connexion
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main style="padding-top: 76px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-amber-600 to-amber-800 rounded-xl flex items-center justify-center">
                            <i class="fas fa-leaf text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-playfair font-bold text-white">Morada Lodge</h3>
                            <p class="text-xs text-gray-500">Luxury Nature Resort</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed mb-6">Un sanctuaire de luxe au cœur de la nature béninoise, où authenticité et raffinement se rencontrent pour créer des souvenirs inoubliables.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-amber-600 transition-colors"><i class="fab fa-facebook-f text-sm"></i></a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-amber-600 transition-colors"><i class="fab fa-instagram text-sm"></i></a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-amber-600 transition-colors"><i class="fab fa-tripadvisor text-sm"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-6">Liens Rapides</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('frontend.rooms') }}" class="hover:text-amber-400 transition-colors">Hébergements</a></li>
                        <li><a href="{{ route('frontend.restaurant') }}" class="hover:text-amber-400 transition-colors">Restaurant & Bar</a></li>
                        <li><a href="{{ route('frontend.services') }}" class="hover:text-amber-400 transition-colors">Services</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Galerie</a></li>
                        <li><a href="{{ route('frontend.contact') }}" class="hover:text-amber-400 transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-6">Services</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Réservation en ligne</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Service de conciergerie</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Transfert aéroport</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Excursions</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition-colors">Événements privés</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-6">Newsletter</h4>
                    <p class="text-sm text-gray-400 mb-4">Restez informés de nos offres spéciales et nouveautés</p>
                    <div class="flex">
                        <input type="email" placeholder="Votre email" class="flex-1 px-4 py-2 bg-gray-800 text-white rounded-l-lg focus:outline-none focus:ring-2 focus:ring-amber-600">
                        <button class="bg-amber-600 hover:bg-amber-700 px-4 py-2 rounded-r-lg transition-colors"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-500">© {{ date('Y') }} Morada Lodge - Tous droits réservés.</p>
                <div class="flex space-x-6 mt-4 md:mt-0 text-sm">
                    <a href="#" class="hover:text-amber-400 transition-colors">Conditions générales</a>
                    <a href="#" class="hover:text-amber-400 transition-colors">Politique de confidentialité</a>
                    <a href="#" class="hover:text-amber-400 transition-colors">Mentions légales</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts personnalisés -->
    @stack('scripts')
</body>
</html>