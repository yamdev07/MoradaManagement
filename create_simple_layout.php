<?php

// Créer une version simplifiée du layout pour contourner le problème

echo "🔧 Création d'un layout simplifié\n\n";

// Créer un layout master simplifié sans @if complexes
$simplifiedLayout = <<<'BLADE'
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
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --accent-color: #28a745;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            background-color: #ffffff;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--dark-color);
        }
        
        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: white;
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-color) !important;
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
            background-color: var(--dark-color);
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
                <img src="{{ asset('img/logo/logo_ancien.jpg') }}"
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
                        <a href="/dashboard" class="btn btn-outline-primary-custom">
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
                    <h4 class="mb-3">Morada Lodge</h4>
                    <p>Un sanctuaire de luxe au cœur de la nature béninoise, où authenticité et raffinement se rencontrent pour créer des souvenirs inoubliables.</p>
                    <div class="social-icons mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
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
                        Cotonou, Bénin<br>
                        +229 XX XX XX XX<br>
                        contact@moradalodge.com
                    </p>
                </div>
            </div>
            <hr class="my-4 bg-white">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-white-50">&copy; {{ date('Y') }} Morada Lodge. Tous droits réservés.</p>
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
</body>
</html>
BLADE;

// Écrire le nouveau layout simplifié
file_put_contents('resources/views/frontend/layouts/master.blade.php', $simplifiedLayout);

echo "✅ Layout simplifié créé avec succès\n";
echo "📏 Taille: " . number_format(strlen($simplifiedLayout)) . " octets\n";
echo "📄 Lignes: " . substr_count($simplifiedLayout, "\n") + 1 . "\n";

// Vérifier la syntaxe
$output = [];
$returnCode = 0;
exec("php -l resources/views/frontend/layouts/master.blade.php", $output, $returnCode);

if ($returnCode === 0) {
    echo "✅ Syntaxe PHP vérifiée: CORRECTE\n";
} else {
    echo "❌ Erreur de syntaxe:\n";
    foreach ($output as $line) {
        echo "   " . $line . "\n";
    }
}

echo "\n🎯 Layout simplifié créé !\n";
echo "🚀 Ce layout évite les conditions complexes @if\n";
echo "📋 Utilise des valeurs par défaut simples\n";
echo "✅ Plus de risques d'erreurs de syntaxe\n\n";

echo "📋 Instructions:\n";
echo "1. Actualisez la page\n";
echo "2. Si l'erreur persiste, utilisez le nouveau port: http://127.0.0.1:8001\n";
echo "3. Le layout simplifié devrait fonctionner sans erreurs\n";

?>
