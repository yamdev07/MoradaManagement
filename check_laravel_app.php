<?php

// Vérification de l'application Laravel elle-même

echo "🔍 Vérification de l'application Laravel\n\n";

try {
    // Inclure l'autoload de Laravel
    require_once 'vendor/autoload.php';
    
    echo "📋 Étape 1: Test de l'application Laravel\n";
    
    // Test de l'application
    $app = require_once 'bootstrap/app.php';
    
    if ($app) {
        echo "✅ Application Laravel chargée\n";
    } else {
        echo "❌ Impossible de charger l'application Laravel\n";
        exit;
    }
    
    echo "\n📋 Étape 2: Vérification de la configuration\n";
    
    // Vérifier la configuration de la base de données
    $dbConfig = [
        'default' => config('database.default'),
        'connection' => config('database.connections.mysql'),
    ];
    
    echo "   Database default: " . $dbConfig['default'] . "\n";
    echo "   Database host: " . $dbConfig['connection']['host'] . "\n";
    echo "   Database port: " . $dbConfig['connection']['port'] . "\n";
    echo "   Database name: " . $dbConfig['connection']['database'] . "\n";
    
    echo "\n📋 Étape 3: Test de connexion via Laravel\n";
    
    try {
        $connection = \DB::connection();
        $pdo = $connection->getPdo();
        echo "✅ Connexion Laravel à la base de données: OK\n";
        
        // Test de requête simple
        $count = \DB::table('tenants')->where('is_active', 1)->count();
        echo "✅ Requête Laravel: " . $count . " tenants actifs\n";
        
    } catch (Exception $e) {
        echo "❌ Erreur connexion Laravel: " . $e->getMessage() . "\n";
    }
    
    echo "\n📋 Étape 4: Vérification des routes\n";
    
    try {
        $routes = app('router')->getRoutes();
        echo "✅ Routes chargées: " . $routes->count() . " routes\n";
        
        // Vérifier la route de réservation
        $reservationRoute = \Route::getRoutes()->getByName('transaction.reservation.createIdentity');
        if ($reservationRoute) {
            echo "✅ Route transaction.reservation.createIdentity trouvée\n";
        } else {
            echo "❌ Route transaction.reservation.createIdentity NON trouvée\n";
        }
        
    } catch (Exception $e) {
        echo "❌ Erreur vérification routes: " . $e->getMessage() . "\n";
    }
    
    echo "\n📋 Étape 5: Test du contrôleur\n";
    
    try {
        // Simuler l'appel au contrôleur
        $controller = new \App\Http\Controllers\TransactionRoomReservationController();
        
        // Tester la méthode createIdentity
        if (method_exists($controller, 'createIdentity')) {
            echo "✅ Méthode createIdentity existe\n";
            
            // Essayer d'appeler la méthode (sans exécuter vraiment)
            $reflection = new ReflectionMethod($controller, 'createIdentity');
            $parameters = $reflection->getParameters();
            echo "   Paramètres: " . count($parameters) . "\n";
            
        } else {
            echo "❌ Méthode createIdentity NON trouvée\n";
        }
        
    } catch (Exception $e) {
        echo "❌ Erreur contrôleur: " . $e->getMessage() . "\n";
    }
    
    echo "\n📋 Étape 6: Vérification des middlewares\n";
    
    try {
        // Vérifier les middlewares de la route
        $route = \Route::getRoutes()->getByName('transaction.reservation.createIdentity');
        if ($route) {
            $middleware = $route->middleware();
            echo "   Middlewares: " . implode(', ', $middleware) . "\n";
            
            // Vérifier si les middlewares existent
            foreach ($middleware as $mw) {
                if (class_exists($mw)) {
                    echo "   ✅ $mw: Existe\n";
                } else {
                    echo "   ❌ $mw: NON trouvé\n";
                }
            }
        }
        
    } catch (Exception $e) {
        echo "❌ Erreur middlewares: " . $e->getMessage() . "\n";
    }
    
    echo "\n📋 Étape 7: Test de la vue\n";
    
    try {
        // Vérifier si la vue existe
        $viewPath = resource_path('views/transaction/reservation/createIdentity.blade.php');
        if (file_exists($viewPath)) {
            echo "✅ Vue createIdentity.blade.php existe\n";
            echo "   Taille: " . filesize($viewPath) . " bytes\n";
            echo "   Modifié: " . date('Y-m-d H:i:s', filemtime($viewPath)) . "\n";
        } else {
            echo "❌ Vue createIdentity.blade.php NON trouvée\n";
            echo "   Chemin recherché: " . $viewPath . "\n";
        }
        
    } catch (Exception $e) {
        echo "❌ Erreur vue: " . $e->getMessage() . "\n";
    }
    
    echo "\n🎯 Diagnostic Laravel terminé\n";
    echo "Si tout est OK ci-dessus, essayez:\n";
    echo "1. php artisan serve --port=8001\n";
    echo "2. Accédez à: http://127.0.0.1:8001/login\n";
    echo "3. Connectez-vous avec les identifiants fournis\n";
    
} catch (Exception $e) {
    echo "❌ Erreur critique Laravel: " . $e->getMessage() . "\n";
    echo "   Trace: " . $e->getTraceAsString() . "\n";
}

?>
