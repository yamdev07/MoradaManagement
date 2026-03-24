<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Morada Lodge - Havre de luxe au cœur de la nature à Covè, Bénin">
    <title><?php echo $__env->yieldContent('title', 'Morada Lodge - Luxury Nature Resort'); ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon-16x16.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('apple-touch-icon.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('site.webmanifest')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>">
    

    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Styles personnalisés -->
    <link rel="stylesheet" href="<?php echo e(asset('css/morada-lodge.css')); ?>">
    <style>
        :root {
            /* Morada Lodge Base Colors */
            --primary-brown: #8b4513;
            --secondary-brown: #a0522d;
            --accent-gold: #cd853f;
            --dark-brown: #654321;
            --light-brown: #f5e6d3;
            --warm-beige: #f4f1e8;
            
            /* Legacy variables for compatibility */
            --primary-color: var(--primary-brown);
            --secondary-color: var(--secondary-brown);
            --light-color: var(--warm-beige);
            --dark-color: var(--dark-brown);
            --accent-color: var(--light-brown);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            background-color: var(--warm-beige);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--dark-color);
        }
        
        .bg-primary-custom {
            background-color: var(--primary-color) !important;
        }
        
        .text-primary-custom {
            color: var(--primary-color) !important;
        }
        
        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--secondary-brown);
            border-color: var(--secondary-brown);
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-color) !important;
        }
        
        .hero-section {
            background: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
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
            background: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }
        
        .hero-section .container {
            position: relative;
            z-index: 2;
        }
        
        .room-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(139, 69, 19, 0.2);
        }
        
        .footer {
            background-color: var(--dark-color);
            color: white;
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
            color: var(--primary-color) !important;
        }
        
        .btn-outline-primary-custom {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary-custom:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        /* Styles pour les formulaires */
        .form-control:focus {
            border-color: var(--secondary-brown);
            box-shadow: 0 0 0 0.25rem rgba(160, 82, 45, 0.25);
        }
        
        /* Cartes et conteneurs */
        .card {
            border: 1px solid rgba(139, 69, 19, 0.1);
            background-color: white;
        }
        
        .card-header {
            background-color: var(--accent-color);
            border-bottom: 1px solid rgba(139, 69, 19, 0.1);
        }
        
        /* Tables */
        .table-hover tbody tr:hover {
            background-color: var(--accent-color);
        }
        
        /* Alertes */
        .alert-success {
            background-color: var(--accent-color);
            border-color: var(--secondary-color);
            color: var(--dark-color);
        }
        
        /* Badges */
        .badge.bg-primary {
            background-color: var(--primary-color) !important;
        }
        
        /* Boutons Hero Section */
        .hero-section .btn-primary-custom {
            background-color: var(--primary-brown);
            border-color: var(--primary-brown);
        }
        
        .hero-section .btn-primary-custom:hover {
            background-color: var(--dark-brown);
            border-color: var(--dark-brown);
        }
        
        .hero-section .btn-outline-light {
            border-color: white;
            color: white;
        }
        
        .hero-section .btn-outline-light:hover {
            background-color: white;
            color: var(--dark-color);
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('frontend.home')); ?>">
                <img src="<?php echo e(asset('img/logo/logo_ancien.jpg')); ?>"
                    alt="Morada Lodge"
                    class="me-2"
                    style="height: 45px; width: auto;">
                <span>Morada Lodge</span>
            </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('frontend.home')); ?>">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('frontend.rooms')); ?>">Chambres & Suites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('frontend.restaurant')); ?>">Restaurant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('frontend.services')); ?>">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('frontend.contact')); ?>">Contact</a>
                    </li>
                    
                    <!-- Bouton dashboard pour les utilisateurs connectés -->
                    <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item ms-2">
                        <a href="<?php echo e(route('dashboard.index')); ?>" class="btn btn-outline-primary-custom">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item ms-2">
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-primary-custom">
                            <i class="fas fa-sign-in-alt me-1"></i> Connexion
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main style="padding-top: 76px;">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="footer py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="mb-3">Morada Lodge</h4>
                    <p>Un sanctuaire de luxe au cœur de la nature béninoise, où authenticité et raffinement se rencontrent pour créer des souvenirs inoubliables.</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo e(route('frontend.home')); ?>" class="text-white text-decoration-none">Accueil</a></li>
                        <li><a href="<?php echo e(route('frontend.rooms')); ?>" class="text-white text-decoration-none">Chambres</a></li>
                        <li><a href="<?php echo e(route('frontend.restaurant')); ?>" class="text-white text-decoration-none">Restaurant</a></li>
                        <li><a href="<?php echo e(route('frontend.services')); ?>" class="text-white text-decoration-none">Services</a></li>
                        <li><a href="<?php echo e(route('frontend.contact')); ?>" class="text-white text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">Contact & Localisation</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Covè, République du Bénin</p>
                    <p><i class="fas fa-phone me-2"></i> +229 0167836481</p>
                    <p><i class="fas fa-envelope me-2"></i> admin@moradalodge.com</p>
                </div>
            </div>
            
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
            
            <div class="text-center">
                <p class="mb-0">&copy; <?php echo e(date('Y')); ?> Morada Lodge - Covè, Bénin. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts personnalisés -->
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\HP ELITEBOOK\Desktop\dev\HotelManagement\resources\views/frontend/layouts/master.blade.php ENDPATH**/ ?>