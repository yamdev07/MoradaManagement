<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e($currentHotel->name ?? 'Morada Lodge'); ?> - <?php echo e($currentHotel->description ?? 'Havre de luxe au cœur de la nature à Covè, Bénin'); ?>">
    <title><?php echo $__env->yieldContent('title', $currentHotel->name ?? 'Morada Lodge' . ' - Luxury Nature Resort'); ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon-16x16.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('apple-touch-icon.png')); ?>">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Styles personnalisés -->
    <style>
        :root {
            <?php if(!empty($currentHotel)): ?>
            /* Couleurs du Tenant - utiliser les couleurs du tenant */
            <?php
            $theme = $currentHotel->theme_settings ?? [];
            if (is_string($theme)) {
                $theme = json_decode($theme, true);
            }
            $primaryColor = $theme['primary_color'] ?? '#007bff';
            $secondaryColor = $theme['secondary_color'] ?? '#6c757d';
            $accentColor = $theme['accent_color'] ?? '#28a745';
            ?>
            --primary-brown: {{ $primaryColor }};
            --secondary-brown: {{ $secondaryColor }};
            --accent-gold: {{ $accentColor }};
            --dark-brown: #343a40;
            --light-brown: #f8f9fa;
            --warm-beige: #ffffff;
            
            /* Legacy variables for compatibility */
            --primary-color: {{ $primaryColor }};
            --secondary-color: {{ $secondaryColor }};
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --accent-color: {{ $accentColor }};
            ?>
            <?php else: ?>
            /* Couleurs neutres - SEULEMENT si pas de tenant */
            --primary-brown: #007bff;
            --secondary-brown: #6c757d;
            --accent-gold: #007bff;
            --dark-brown: #343a40;
            --light-brown: #f8f9fa;
            --warm-beige: #ffffff;
            
            /* Legacy variables for compatibility */
            --primary-color: var(--primary-brown);
            --secondary-color: var(--secondary-brown);
            --light-color: var(--warm-beige);
            --dark-color: var(--dark-brown);
            --accent-color: var(--light-brown);
            <?php endif; ?>
        }
        
        body {
            font-family: 'Inter', sans-serif;
            <?php if(!empty($currentHotel)): ?>
            color: #333;
            background-color: #ffffff;
            <?php else: ?>
            color: #333;
            background-color: var(--warm-beige);
            <?php endif; ?>
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            <?php if(!empty($currentHotel)): ?>
            color: #333;
            <?php else: ?>
            color: var(--dark-color);
            <?php endif; ?>
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
            <?php if(!empty($currentHotel)): ?>
            background-color: #666;
            border-color: #666;
            <?php else: ?>
            background-color: var(--secondary-brown);
            border-color: var(--secondary-brown);
            <?php endif; ?>
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            <?php if(!empty($currentHotel)): ?>
            color: #333 !important;
            <?php else: ?>
            color: var(--dark-color) !important;
            <?php endif; ?>
        }
        
        .nav-link {
            <?php if(!empty($currentHotel)): ?>
            color: #333 !important;
            <?php else: ?>
            color: var(--dark-color) !important;
            <?php endif; ?>
            font-weight: 500;
        }
        
        .nav-link:hover {
            <?php if(!empty($currentHotel)): ?>
            color: #666 !important;
            <?php else: ?>
            color: var(--primary-color) !important;
            <?php endif; ?>
        }
        
        .btn-outline-primary-custom {
            <?php if(!empty($currentHotel)): ?>
            color: #666;
            border-color: #666;
            <?php else: ?>
            color: var(--primary-color);
            border-color: var(--primary-color);
            <?php endif; ?>
        }
        
        .btn-outline-primary-custom:hover {
            <?php if(!empty($currentHotel)): ?>
            background-color: #666;
            border-color: #666;
            <?php else: ?>
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            <?php endif; ?>
            color: white;
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
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.4) 0%, rgba(30, 126, 52, 0.6) 100%);
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
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.2);
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
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('frontend.home')); ?>">
                <?php if(!empty($currentHotel) && $currentHotel->logo): ?>
                    <img src="<?php echo e(asset('storage/' . $currentHotel->logo)); ?>"
                        alt="<?php echo e($currentHotel->name); ?>"
                        class="me-2"
                        style="height: 45px; width: auto;">
                <?php else: ?>
                    <img src="<?php echo e(asset('img/logo/logo_ancien.jpg')); ?>"
                        alt="Morada Lodge"
                        class="me-2"
                        style="height: 45px; width: auto;">
                <?php endif; ?>
                <span><?php if(!empty($currentHotel)): ?> <?php echo e($currentHotel->name); ?> <?php else: ?> Morada Lodge <?php endif; ?></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('frontend.home')); ?><?php echo e(request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : ''); ?>">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('frontend.rooms')); ?><?php echo e(request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : ''); ?>">Chambres & Suites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('frontend.restaurant')); ?><?php echo e(request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : ''); ?>">Restaurant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('frontend.services')); ?><?php echo e(request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : ''); ?>">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('frontend.contact')); ?><?php echo e(request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : ''); ?>">Contact</a>
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
                    <h4 class="mb-3"><?php if(!empty($currentHotel)): ?> <?php echo e($currentHotel->name); ?> <?php else: ?> Morada Lodge <?php endif; ?></h4>
                    <p><?php if(!empty($currentHotel)): ?> <?php echo e($currentHotel->description ?? 'Un établissement de luxe où authenticité et raffinement se rencontrent pour créer des souvenirs inoubliables.'); ?> <?php else: ?> Un sanctuaire de luxe au cœur de la nature béninoise, où authenticité et raffinement se rencontrent pour créer des souvenirs inoubliables. <?php endif; ?></p>
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
                        <li><a href="<?php echo e(route('frontend.home')); ?><?php echo e(request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : ''); ?>" class="text-white text-decoration-none">Accueil</a></li>
                        <li><a href="<?php echo e(route('frontend.rooms')); ?><?php echo e(request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : ''); ?>" class="text-white text-decoration-none">Chambres</a></li>
                        <li><a href="<?php echo e(route('frontend.restaurant')); ?><?php echo e(request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : ''); ?>" class="text-white text-decoration-none">Restaurant</a></li>
                        <li><a href="<?php echo e(route('frontend.services')); ?><?php echo e(request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : ''); ?>" class="text-white text-decoration-none">Services</a></li>
                        <li><a href="<?php echo e(route('frontend.contact')); ?><?php echo e(request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : ''); ?>" class="text-white text-decoration-none">Contact</a></li>
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
    
    <!-- Thème dynamique basé sur currentHotel -->
    <?php if(!empty($currentHotel)): ?>
    <script>
        (function() {
            console.log('🎨 DÉMARRAGE THÈME DYNAMIQUE');
            console.log('📋 Tenant ID: <?php echo e($currentHotel->id); ?>');
            console.log('📋 Tenant Nom: <?php echo e($currentHotel->name); ?>');
            
            var themeSettings = <?php echo json_encode($currentHotel->theme_settings ?? [], 15, 512) ?>;
            console.log('🎨 Thème Settings:', themeSettings);
            
            // Vérifier si les couleurs existent
            if (!themeSettings || typeof themeSettings !== 'object') {
                console.warn('⚠️ Thème settings invalide:', themeSettings);
                return;
            }
            
            var primaryColor = themeSettings.primary_color || '#007bff';
            var secondaryColor = themeSettings.secondary_color || '#6c757d';
            var accentColor = themeSettings.accent_color || '#28a745';
            var backgroundColor = themeSettings.background_color || '#ffffff';
            var textColor = themeSettings.text_color || '#333333';
            var fontFamily = themeSettings.font_family || 'Inter';
            
            console.log('🎨 Couleurs à appliquer:', {
                primary: primaryColor,
                secondary: secondaryColor,
                accent: accentColor,
                background: backgroundColor,
                text: textColor,
                font: fontFamily
            });
            
            // 1. Créer et injecter les CSS
            var style = document.createElement('style');
            style.id = 'dynamic-theme-css';
            style.innerHTML = `
                /* Thème dynamique pour <?php echo e($currentHotel->name); ?> */
                body {
                    background-color: ${backgroundColor} !important;
                    color: ${textColor} !important;
                    font-family: '${fontFamily}', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
                }
                
                .hero-section {
                    background: linear-gradient(135deg, ${primaryColor} 0%, ${secondaryColor} 100%) !important;
                    background-image: none !important;
                    background-color: ${primaryColor} !important;
                }
                
                .btn-primary, .btn-primary-custom {
                    background-color: ${accentColor} !important;
                    border-color: ${accentColor} !important;
                    color: white !important;
                }
                
                .btn-primary:hover, .btn-primary-custom:hover {
                    background-color: ${primaryColor} !important;
                    border-color: ${primaryColor} !important;
                }
                
                .btn-outline-primary, .btn-outline-primary-custom {
                    border-color: ${primaryColor} !important;
                    color: ${primaryColor} !important;
                }
                
                .btn-outline-primary:hover, .btn-outline-primary-custom:hover {
                    background-color: ${primaryColor} !important;
                    color: white !important;
                }
                
                .navbar {
                    background-color: white !important;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
                }
                
                .navbar-brand {
                    color: ${primaryColor} !important;
                }
                
                .nav-link {
                    color: ${textColor} !important;
                }
                
                .nav-link:hover {
                    color: ${primaryColor} !important;
                }
                
                .footer {
                    background-color: ${primaryColor} !important;
                    color: white !important;
                }
                
                .card {
                    border-color: ${primaryColor} !important;
                }
                
                .text-primary-custom {
                    color: ${primaryColor} !important;
                }
                
                .bg-primary-custom {
                    background-color: ${primaryColor} !important;
                }
            `;
            
            document.head.appendChild(style);
            console.log('✅ CSS injecté dans le head');
            
            // 2. Application forcée des styles
            function applyThemeForcibly() {
                console.log('🔥 Application forcée du thème');
                
                // Body
                document.body.style.backgroundColor = backgroundColor;
                document.body.style.color = textColor;
                document.body.style.fontFamily = `'${fontFamily}', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif`;
                
                // Hero section
                var heroElements = document.querySelectorAll('.hero-section');
                heroElements.forEach(function(element) {
                    element.style.background = `linear-gradient(135deg, ${primaryColor} 0%, ${secondaryColor} 100%)`;
                    element.style.backgroundImage = 'none';
                    element.style.backgroundColor = primaryColor;
                });
                
                // Boutons
                var btnPrimary = document.querySelectorAll('.btn-primary, .btn-primary-custom');
                btnPrimary.forEach(function(btn) {
                    btn.style.backgroundColor = accentColor;
                    btn.style.borderColor = accentColor;
                    btn.style.color = 'white';
                });
                
                var btnOutline = document.querySelectorAll('.btn-outline-primary, .btn-outline-primary-custom');
                btnOutline.forEach(function(btn) {
                    btn.style.borderColor = primaryColor;
                    btn.style.color = primaryColor;
                });
                
                console.log('✅ Thème appliqué avec succès');
            }
            
            // Application immédiate
            applyThemeForcibly();
            
            // Application après chargement DOM
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', applyThemeForcibly);
            } else {
                applyThemeForcibly();
            }
            
            // Application retardée pour les éléments qui pourraient se charger plus tard
            setTimeout(applyThemeForcibly, 100);
            setTimeout(applyThemeForcibly, 500);
            setTimeout(applyThemeForcibly, 1000);
            
            console.log('🎯 Thème dynamique terminé pour <?php echo e($currentHotel->name); ?>');
        })();
    </script>
    <?php else: ?>
    <script>
        console.log('ℹ️ Aucun currentHotel disponible - thème par défaut appliqué');
    </script>
    <?php endif; ?>
</body>
</html>
<?php /**PATH C:\Users\Majorelle V\Documents\MoradaManagement\resources\views/frontend/layouts/master.blade.php ENDPATH**/ ?>