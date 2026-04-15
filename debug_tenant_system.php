<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🔍 DIAGNOSTIC COMPLET DU SYSTÈME TENANT\n\n";

// 1. Vérifier le tenant 25
$tenant = \App\Models\Tenant::find(25);
if (!$tenant) {
    echo "❌ Tenant 25 non trouvé\n";
    exit;
}

echo "📋 Tenant 25 trouvé:\n";
echo "   Nom: {$tenant->name}\n";
echo "   ID: {$tenant->id}\n";
echo "   Domaine: {$tenant->domain}\n";

// 2. Vérifier les thèmes
echo "\n🎨 Thème du tenant:\n";
$theme = $tenant->theme_settings;
if (is_string($theme)) {
    $theme = json_decode($theme, true);
    echo "   Type: " . gettype($theme) . "\n";
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "   ❌ Erreur JSON: " . json_last_error_msg() . "\n";
    }
} else {
    echo "   Type: " . gettype($theme) . "\n";
}

if (is_array($theme)) {
    echo "   Primaire: " . ($theme['primary_color'] ?? 'Non défini') . "\n";
    echo "   Secondaire: " . ($theme['secondary_color'] ?? 'Non défini') . "\n";
    echo "   Accent: " . ($theme['accent_color'] ?? 'Non défini') . "\n";
    echo "   Background: " . ($theme['background_color'] ?? 'Non défini') . "\n";
    echo "   Texte: " . ($theme['text_color'] ?? 'Non défini') . "\n";
    echo "   Police: " . ($theme['font_family'] ?? 'Non défini') . "\n";
} else {
    echo "   ❌ Thème n'est pas un array\n";
    echo "   Contenu brut: " . var_export($theme, true) . "\n";
}

echo "   Logo: " . ($tenant->logo ?? 'Non défini') . "\n";

// 3. Vérifier le middleware
echo "\n🔧 Vérification du middleware:\n";
$middlewareFile = 'app/Http/Middleware/SetHotelContext.php';
if (file_exists($middlewareFile)) {
    $middlewareContent = file_get_contents($middlewareFile);
    
    $hasAutoDetection = str_contains($middlewareContent, 'tenant_id) pour les pages frontend');
    $hasViewShared = str_contains($middlewareContent, "view()->share('currentHotel'");
    $hasAppInstance = str_contains($middlewareContent, "app()->instance('current_hotel'");
    
    echo "   Middleware: ✅ Existe\n";
    echo "   Détection automatique: " . ($hasAutoDetection ? '✅' : '❌') . "\n";
    echo "   Partage dans les vues: " . ($hasViewShared ? '✅' : '❌') . "\n";
    echo "   Instance dans app(): " . ($hasAppInstance ? '✅' : '❌') . "\n";
} else {
    echo "   ❌ Middleware non trouvé\n";
}

// 4. Vérifier le FrontendController
echo "\n🎮 Vérification du FrontendController:\n";
$controllerFile = 'app/Http/Controllers/FrontendController.php';
if (file_exists($controllerFile)) {
    $controllerContent = file_get_contents($controllerFile);
    
    $hasViewShared = str_contains($controllerContent, "view()->shared('currentHotel')");
    $noAppCurrentHotel = !str_contains($controllerContent, "app('current_hotel')");
    
    echo "   Controller: ✅ Existe\n";
    echo "   Utilisation view()->shared(): " . ($hasViewShared ? '✅' : '❌') . "\n";
    echo "   Plus de app('current_hotel'): " . ($noAppCurrentHotel ? '✅' : '❌') . "\n";
} else {
    echo "   ❌ Controller non trouvé\n";
}

// 5. Vérifier le layout master
echo "\n🎨 Vérification du layout master:\n";
$layoutFile = 'resources/views/frontend/layouts/master.blade.php';
if (file_exists($layoutFile)) {
    $layoutContent = file_get_contents($layoutFile);
    
    $hasDynamicTheme = str_contains($layoutContent, 'Thème dynamique basé sur currentHotel');
    $hasCurrentHotelCheck = str_contains($layoutContent, '@if(!empty($currentHotel))');
    $hasThemeSettings = str_contains($layoutContent, '$currentHotel->theme_settings');
    
    echo "   Layout: ✅ Existe\n";
    echo "   Thème dynamique: " . ($hasDynamicTheme ? '✅' : '❌') . "\n";
    echo "   Vérification currentHotel: " . ($hasCurrentHotelCheck ? '✅' : '❌') . "\n";
    echo "   Utilisation theme_settings: " . ($hasThemeSettings ? '✅' : '❌') . "\n";
} else {
    echo "   ❌ Layout non trouvé\n";
}

// 6. Vérifier les logs récents
echo "\n📋 Vérification des logs Laravel:\n";
$logFile = 'storage/logs/laravel.log';
if (file_exists($logFile)) {
    $logContent = file_get_contents($logFile);
    $recentLogs = substr($logContent, -2000); // 2000 derniers caractères
    
    $hasSetHotelContext = str_contains($recentLogs, 'SetHotelContext:');
    $hasCurrentHotel = str_contains($recentLogs, 'currentHotel');
    $hasHotelId25 = str_contains($recentLogs, 'hotel_id.*25');
    
    echo "   Fichier de log: ✅ Existe\n";
    echo "   Logs SetHotelContext: " . ($hasSetHotelContext ? '✅' : '❌') . "\n";
    echo "   Logs currentHotel: " . ($hasCurrentHotel ? '✅' : '❌') . "\n";
    echo "   Logs hotel_id 25: " . ($hasHotelId25 ? '✅' : '❌') . "\n";
    
    if ($hasSetHotelContext) {
        echo "\n   Derniers logs SetHotelContext:\n";
        preg_match_all('/SetHotelContext:.*$/m', $recentLogs, $matches);
        foreach (array_slice($matches[0], -5) as $match) {
            echo "   " . trim($match) . "\n";
        }
    }
} else {
    echo "   ❌ Fichier de log non trouvé\n";
}

// 7. Test de simulation
echo "\n🧪 Test de simulation:\n";
try {
    // Simuler une requête avec hotel_id=25
    $_GET['hotel_id'] = 25;
    
    // Créer une requête simulée
    $request = \Illuminate\Http\Request::create('/hotel?hotel_id=25', 'GET', ['hotel_id' => 25]);
    
    // Simuler le middleware
    $middleware = new \App\Http\Middleware\SetHotelContext();
    
    // Créer un response simulé
    $next = function($req) {
        return new \Illuminate\Http\Response('OK');
    };
    
    // Exécuter le middleware
    $response = $middleware->handle($request, $next);
    
    // Vérifier si currentHotel est partagé
    $sharedHotel = view()->shared('currentHotel');
    
    echo "   Middleware exécuté: ✅\n";
    echo "   currentHotel partagé: " . ($sharedHotel ? '✅' : '❌') . "\n";
    
    if ($sharedHotel) {
        echo "   Nom de l'hôtel: " . $sharedHotel->name . "\n";
        echo "   ID de l'hôtel: " . $sharedHotel->id . "\n";
    }
    
} catch (Exception $e) {
    echo "   ❌ Erreur lors du test: " . $e->getMessage() . "\n";
}

echo "\n🎯 CONCLUSION:\n";
echo "Le système de personnalisation des tenants dépend de plusieurs facteurs:\n";
echo "1. ✅ Les données du tenant doivent exister en base\n";
echo "2. ✅ Le middleware doit détecter le hotel_id ou le tenant_id de l'utilisateur\n";
echo "3. ✅ Le currentHotel doit être partagé dans les vues\n";
echo "4. ✅ Le layout doit utiliser $currentHotel->theme_settings\n";
echo "5. ✅ Le JavaScript doit appliquer les couleurs dynamiquement\n\n";

echo "Si tout est ✅ mais que ça ne fonctionne pas, le problème peut être:\n";
echo "- Cache Laravel/Blade (php artisan view:clear)\n";
echo "- Cache navigateur (Ctrl+F5)\n";
echo "- Erreur JavaScript dans la console (F12)\n";
echo "- Les theme_settings ne sont pas au bon format JSON\n";
