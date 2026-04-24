<?php

// Debug pour vérifier si les middlewares sont appelés correctement

echo "🔍 Debug des middlewares\n\n";

try {
    // Simuler l'appel direct au middleware
    $request = new \Illuminate\Http\Request();
    $request->server->add([
        'REQUEST_METHOD' => 'GET',
        'REQUEST_URI' => '/transaction/reservation/createIdentity',
        'HTTP_HOST' => '127.0.0.1:8000',
        'SERVER_NAME' => '127.0.0.1',
    ]);
    
    // Simuler la session
    $_SESSION['hotel_id'] = 64;
    $_SESSION['user_id'] = 100;
    
    echo "📋 Simulation de la session:\n";
    echo "   hotel_id: " . $_SESSION['hotel_id'] . "\n";
    echo "   user_id: " . $_SESSION['user_id'] . "\n";
    
    echo "\n📋 Test du middleware SetTenant:\n";
    $setTenant = new \App\Http\Middleware\SetTenant();
    $response = $setTenant->handle($request, function($req) {
        echo "   ✅ SetTenant exécuté\n";
        return $req;
    });
    
    echo "   hotel_id dans app: " . app('tenant_id') . "\n";
    
    echo "\n📋 Test du middleware TenantThemeMiddleware:\n";
    $tenantTheme = new \App\Http\Middleware\TenantThemeMiddleware();
    $response = $tenantTheme->handle($request, function($req) {
        echo "   ✅ TenantThemeMiddleware exécuté\n";
        return $req;
    });
    
    echo "   tenantColors dans view: " . (view()->shared('tenantColors') ? 'Oui' : 'Non') . "\n";
    if (view()->shared('tenantColors')) {
        echo "   tenantColors: " . json_encode(view()->shared('tenantColors')) . "\n";
    }
    
    echo "\n📋 Test du contrôleur createIdentity:\n";
    $controller = new \App\Http\Controllers\TransactionRoomReservationController();
    
    // Vérifier si la méthode existe
    if (method_exists($controller, 'createIdentity')) {
        echo "   ✅ Méthode createIdentity existe\n";
        
        try {
            $result = $controller->createIdentity();
            echo "   ✅ Contrôleur exécuté sans erreur\n";
            
            if (is_array($result)) {
                echo "   Résultat du contrôleur: " . json_encode(array_keys($result)) . "\n";
                if (isset($result['tenantColors'])) {
                    echo "   ✅ tenantColors dans le résultat du contrôleur: " . json_encode($result['tenantColors']) . "\n";
                } else {
                    echo "   ❌ tenantColors NON trouvé dans le résultat du contrôleur\n";
                }
            }
            
        } catch (Exception $e) {
            echo "   ❌ Erreur dans le contrôleur: " . $e->getMessage() . "\n";
        }
    } else {
        echo "   ❌ Méthode createIdentity NON trouvée\n";
    }
    
    echo "\n🎯 Conclusion:\n";
    echo "Si tout est OK ci-dessus, le problème est probablement:\n";
    echo "1. Dans le routage ou les middlewares de la route\n";
    echo "2. Dans la vue elle-même\n";
    echo "3. Dans le cache de Laravel\n";
    
} catch (Exception $e) {
    echo "❌ Erreur critique: " . $e->getMessage() . "\n";
    echo "   Trace: " . $e->getTraceAsString() . "\n";
}

?>
