<?php

// Recréation complète du layout master pour corriger définitivement le problème

echo "🔧 Recréation complète du layout master.blade.php\n\n";

// Lire le fichier actuel
$currentFile = 'resources/views/frontend/layouts/master.blade.php';
$backupFile = 'resources/views/frontend/layouts/master.blade.php.backup';

// 1. Créer une sauvegarde
if (file_exists($currentFile)) {
    copy($currentFile, $backupFile);
    echo "✅ Sauvegarde créée: master.blade.php.backup\n";
}

// 2. Recréer le fichier avec une structure propre
$newContent = <<<'BLADE'
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Morada Lodge') - Hôtel de Luxe</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Styles personnalisés -->
    <style>
        :root {
            @if(!empty($currentHotel))
            /* Couleurs du Tenant - utiliser les couleurs du tenant */
            @php
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
            @endphp
            @else
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
            @endif
        }
        
        body {
            font-family: 'Inter', sans-serif;
            @if(!empty($currentHotel))
            color: #333;
            background-color: #ffffff;
            @else
            color: #333;
            background-color: var(--warm-beige);
            @endif
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            @if(!empty($currentHotel))
            color: #333;
            @else
            color: var(--dark-color);
            @endif
        }
        
        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary-custom:hover {
            background-color: #666;
            border-color: #666;
            color: white;
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            @if(!empty($currentHotel))
            color: #333 !important;
            @else
            color: var(--dark-color) !important;
            @endif
        }
        
        .nav-link {
            @if(!empty($currentHotel))
            color: #333 !important;
            @else
            color: var(--dark-color) !important;
            @endif
            font-weight: 500;
        }
        
        .nav-link:hover {
            @if(!empty($currentHotel))
            color: #666 !important;
            @else
            color: var(--primary-color) !important;
            @endif
        }
        
        .btn-outline-primary-custom {
            @if(!empty($currentHotel))
            color: #666;
            border-color: #666;
            @else
            color: var(--primary-color);
            border-color: var(--primary-color);
            @endif
        }
        
        .btn-outline-primary-custom:hover {
            @if(!empty($currentHotel))
            background-color: #666;
            border-color: #666;
            @else
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            @endif
            color: white;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 100px 0;
        }
        
        .feature-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .footer {
            background-color: var(--dark-brown);
            color: white;
            padding: 50px 0;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('frontend.home') }}">
                @if(!empty($currentHotel) && $currentHotel->logo)
                    <img src="{{ asset('storage/' . $currentHotel->logo) }}"
                        alt="{{ $currentHotel->name }}"
                        class="me-2"
                        style="height: 45px; width: auto;">
                @else
                    <img src="{{ asset('img/logo/logo_ancien.jpg') }}"
                        alt="Morada Lodge"
                        class="me-2"
                        style="height: 45px; width: auto;">
                @endif
                <span>@if(!empty($currentHotel)) {{ $currentHotel->name }} @else Morada Lodge @endif</span>
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
                        <a class="nav-link" href="{{ route('frontend.rooms') }}{{ request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : '' }}">Chambres & Suites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.restaurant') }}{{ request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : '' }}">Restaurant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.services') }}{{ request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : '' }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.contact') }}{{ request()->get('hotel_id') ? '?hotel_id=' . request()->get('hotel_id') : '' }}">Contact</a>
                    </li>
                    
                    <!-- Bouton dashboard pour les utilisateurs connectés -->
                    @auth
                    <li class="nav-item ms-2">
                        <a href="@if(auth()->user()->role === 'Super')/super-admin/dashboard@elseif(auth()->user()->role === 'Admin' && auth()->user()->tenant_id)/tenant/dashboard@else/dashboard@endif" class="btn btn-outline-primary-custom">
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
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="mb-3">@if(!empty($currentHotel)) {{ $currentHotel->name }} @else Morada Lodge @endif</h4>
                    <p>@if(!empty($currentHotel)) {{ $currentHotel->description ?? 'Un établissement de luxe où authenticité et raffinement se rencontrent pour créer des souvenirs inoubliables.' }} @else Un sanctuaire de luxe au cœur de la nature béninoise, où authenticité et raffinement se rencontrent pour créer des souvenirs inoubliables. @endif</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('frontend.rooms') }}" class="text-white-50">Chambres</a></li>
                        <li><a href="{{ route('frontend.restaurant') }}" class="text-white-50">Restaurant</a></li>
                        <li><a href="{{ route('frontend.services') }}" class="text-white-50">Services</a></li>
                        <li><a href="{{ route('frontend.contact') }}" class="text-white-50">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">Contact</h5>
                    <p class="text-white-50">
                        @if(!empty($currentHotel))
                        {{ $currentHotel->address ?? 'Adresse non spécifiée' }}<br>
                        {{ $currentHotel->phone ?? 'Téléphone non spécifié' }}<br>
                        {{ $currentHotel->email ?? 'Email non spécifié' }}
                        @else
                        Cotonou, Bénin<br>
                        +229 XX XX XX XX<br>
                        contact@moradalodge.com
                        @endif
                    </p>
                </div>
            </div>
            <hr class="my-4 bg-white">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-white-50">&copy; {{ date('Y') }} @if(!empty($currentHotel)) {{ $currentHotel->name }} @else Morada Lodge @endif. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="text-white-50">Développé avec <i class="fas fa-heart text-danger"></i> par Morada Management</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    
    <!-- Thème dynamique basé sur currentHotel -->
    @if(!empty($currentHotel))
    <script>
        (function() {
            console.log('🎨 DÉMARRAGE THÈME DYNAMIQUE pour {{ $currentHotel->name }}');
            
            // Fonction pour appliquer le thème de force
            function applyThemeForcibly() {
                try {
                    // Variables CSS
                    const root = document.documentElement;
                    const primaryColor = '{{ $theme['primary_color'] ?? '#007bff' }}';
                    const secondaryColor = '{{ $theme['secondary_color'] ?? '#6c757d' }}';
                    const accentColor = '{{ $theme['accent_color'] ?? '#28a745' }}';
                    
                    // Appliquer les variables CSS
                    root.style.setProperty('--primary-color', primaryColor);
                    root.style.setProperty('--secondary-color', secondaryColor);
                    root.style.setProperty('--accent-color', accentColor);
                    
                    // Appliquer aux éléments spécifiques
                    const elements = [
                        '.btn-primary-custom',
                        '.navbar-brand',
                        '.hero-section',
                        '.nav-link'
                    ];
                    
                    elements.forEach(selector => {
                        const el = document.querySelector(selector);
                        if (el) {
                            if (selector === '.btn-primary-custom') {
                                el.style.backgroundColor = primaryColor;
                                el.style.borderColor = primaryColor;
                            } else if (selector === '.navbar-brand') {
                                el.style.color = '#333';
                            } else if (selector === '.hero-section') {
                                el.style.background = `linear-gradient(135deg, ${primaryColor} 0%, ${secondaryColor} 100%)`;
                            }
                        }
                    });
                    
                    console.log('✅ Thème appliqué avec succès');
                } catch (error) {
                    console.error('❌ Erreur lors de l\'application du thème:', error);
                }
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
            
            console.log('🎯 Thème dynamique terminé pour {{ $currentHotel->name }}');
        })();
    </script>
    @else
    <script>
        console.log('ℹ️ Aucun currentHotel disponible - thème par défaut appliqué');
    </script>
    @endif
</body>
</html>
BLADE;

// 3. Écrire le nouveau fichier
file_put_contents($currentFile, $newContent);

echo "✅ Fichier master.blade.php recréé avec succès\n";
echo "📏 Taille: " . number_format(strlen($newContent)) . " octets\n";
echo "📄 Nombre de lignes: " . substr_count($newContent, "\n") + 1 . "\n";

// 4. Vérifier la syntaxe
$output = [];
$returnCode = 0;
exec("php -l " . escapeshellarg($currentFile), $output, $returnCode);

if ($returnCode === 0) {
    echo "✅ Syntaxe PHP vérifiée: CORRECTE\n";
} else {
    echo "❌ Erreur de syntaxe:\n";
    foreach ($output as $line) {
        echo "   " . $line . "\n";
    }
}

echo "\n🎯 Layout master.blade.php recréé avec succès !\n";
echo "🚀 Actualisez la page pour voir les changements\n";

?>
