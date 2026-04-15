<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== TEST DES GLOBAL SCOPES MULTITENANT ===" . PHP_EOL;
echo PHP_EOL;

// 1. Vérifier si les global scopes sont appliqués
echo "1. 🔍 VÉRIFICATION DES GLOBAL SCOPES" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

// Test sans middleware - tous les utilisateurs
echo "📊 TOUS les utilisateurs (sans filtre):" . PHP_EOL;
$allUsers = \App\Models\User::all();
echo "   Total: " . $allUsers->count() . PHP_EOL;

// Test avec global scope - seulement du tenant 4
echo PHP_EOL . "📊 UTILISATEURS du tenant 4 (avec filtre):" . PHP_EOL;
$tenant4Users = \App\Models\User::where('tenant_id', 4)->get();
echo "   Total: " . $tenant4Users->count() . PHP_EOL;

echo PHP_EOL;

// 2. Test du middleware SetTenant
echo "2. 🔧 TEST DU MIDDLEWARE SETTENANT" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

try {
    // Simuler le middleware
    $middleware = new \App\Http\Middleware\SetTenant();
    
    // Créer une requête mock
    $request = new \Illuminate\Http\Request();
    
    // Test avec un utilisateur authentifié
    $user = \App\Models\User::where('tenant_id', 4)->first();
    if ($user) {
        echo "✅ Utilisateur trouvé: " . $user->name . " (Tenant: " . $user->tenant_id . ")" . PHP_EOL;
        
        // Simuler l'authentification
        \Illuminate\Support\Facades\Auth::setUser($user);
        
        // Exécuter le middleware
        $next = function($req) {
            echo "✅ Middleware exécuté avec succès" . PHP_EOL;
            return new \Illuminate\Http\Response('OK');
        };
        
        $response = $middleware->handle($request, $next);
        echo "✅ Réponse du middleware: " . $response->getStatusCode() . PHP_EOL;
        
    } else {
        echo "❌ Aucun utilisateur trouvé pour le test" . PHP_EOL;
    }
    
} catch (Exception $e) {
    echo "❌ Erreur middleware: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL;

// 3. Test des requêtes avec et sans tenant_id
echo "3. 🏨 TEST DES REQUÊTES MULTITENANT" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

// Test des chambres
echo "🏠 Chambres par tenant:" . PHP_EOL;
$tenants = \App\Models\Tenant::where('status', 1)->get();
foreach ($tenants as $tenant) {
    $rooms = \App\Models\Room::where('tenant_id', $tenant->id)->get();
    echo "   Tenant {$tenant->name}: " . $rooms->count() . " chambres" . PHP_EOL;
}

echo PHP_EOL;

// Test des transactions
echo "💰 Transactions par tenant:" . PHP_EOL;
foreach ($tenants as $tenant) {
    $transactions = \App\Models\Transaction::where('tenant_id', $tenant->id)->get();
    echo "   Tenant {$tenant->name}: " . $transactions->count() . " transactions" . PHP_EOL;
}

echo PHP_EOL;

// 4. Test d'isolation réelle
echo "4. 🛡️ TEST D'ISOLATION RÉELLE" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

// Simuler un utilisateur du tenant 4 qui essaie d'accéder aux données du tenant 5
$userTenant4 = \App\Models\User::where('tenant_id', 4)->first();
if ($userTenant4) {
    echo "🔍 Test avec utilisateur: " . $userTenant4->name . PHP_EOL;
    
    // Tenter de récupérer toutes les chambres (doit retourner seulement celles du tenant 4)
    $allRooms = \App\Models\Room::all();
    echo "📊 Toutes les chambres visibles: " . $allRooms->count() . PHP_EOL;
    
    // Vérifier si ce sont bien celles du tenant 4
    $tenant4Rooms = $allRooms->where('tenant_id', 4);
    $otherRooms = $allRooms->where('tenant_id', '!=', 4);
    
    echo "   - Chambres du tenant 4: " . $tenant4Rooms->count() . PHP_EOL;
    echo "   - Chambres d'autres tenants: " . $otherRooms->count() . PHP_EOL;
    
    if ($otherRooms->count() == 0) {
        echo "✅ ISOLATION RÉUSSIE: Aucune donnée d'autres tenants visible" . PHP_EOL;
    } else {
        echo "❌ ISOLATION ÉCHOUÉE: Données d'autres tenants visibles!" . PHP_EOL;
    }
}

echo PHP_EOL;

// 5. Vérification des scopes dans les modèles
echo "5. 📋 VÉRIFICATION DES SCOPES DANS LES MODÈLES" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

$models = ['User', 'Room', 'Transaction', 'Customer'];
foreach ($models as $model) {
    try {
        $modelClass = "App\\Models\\{$model}";
        $modelInstance = new $modelClass();
        
        // Vérifier si le modèle a des global scopes
        $globalScopes = method_exists($modelInstance, 'getGlobalScopes') ? $modelInstance->getGlobalScopes() : [];
        
        if (!empty($globalScopes)) {
            echo "✅ $model : " . count($globalScopes) . " global scope(s)" . PHP_EOL;
            foreach ($globalScopes as $scopeName => $scope) {
                echo "   - $scopeName" . PHP_EOL;
            }
        } else {
            echo "⚠️  $model : Aucun global scope détecté" . PHP_EOL;
        }
        
    } catch (Exception $e) {
        echo "❌ $model : Erreur - " . $e->getMessage() . PHP_EOL;
    }
}

echo PHP_EOL;
echo "🎯 Test terminé - Vérifiez les résultats ci-dessus" . PHP_EOL;
