<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== TEST SIMULATION D'ACCÈS MULTITENANT ===" . PHP_EOL;
echo PHP_EOL;

// Simuler l'accès comme un utilisateur du tenant 4
echo "1. 🔑 SIMULATION CONNEXION UTILISATEUR TENANT 4" . PHP_EOL;
echo str_repeat("-", 60) . PHP_EOL;

$user = \App\Models\User::where('tenant_id', 4)->where('role', 'Admin')->first();
if ($user) {
    echo "✅ Utilisateur: " . $user->name . PHP_EOL;
    echo "✅ Email: " . $user->email . PHP_EOL;
    echo "✅ Rôle: " . $user->role . PHP_EOL;
    echo "✅ Tenant ID: " . $user->tenant_id . PHP_EOL;
    
    // Simuler l'authentification
    \Illuminate\Support\Facades\Auth::setUser($user);
    
    // Appliquer le middleware
    $middleware = new \App\Http\Middleware\SetTenant();
    $request = new \Illuminate\Http\Request();
    
    $next = function($req) {
        return new \Illuminate\Http\Response('OK');
    };
    
    $middleware->handle($request, $next);
    
    echo "✅ Middleware SetTenant appliqué" . PHP_EOL;
    
} else {
    echo "❌ Utilisateur non trouvé" . PHP_EOL;
    exit;
}

echo PHP_EOL;

// 2. Test des requêtes avec le contexte tenant
echo "2. 📊 REQUÊTES AVEC CONTEXTE TENANT" . PHP_EOL;
echo str_repeat("-", 60) . PHP_EOL;

// Test 1: Récupérer les utilisateurs (ne doit voir que ceux du tenant 4)
echo "👥 Utilisateurs visibles:" . PHP_EOL;
$users = \App\Models\User::all();
echo "   Total: " . $users->count() . PHP_EOL;
foreach ($users as $u) {
    echo "   - " . $u->name . " (Tenant: " . $u->tenant_id . ")" . PHP_EOL;
}

echo PHP_EOL;

// Test 2: Récupérer les chambres
echo "🏠 Chambres visibles:" . PHP_EOL;
$rooms = \App\Models\Room::all();
echo "   Total: " . $rooms->count() . PHP_EOL;
foreach ($rooms as $room) {
    echo "   - " . $room->name . " (Tenant: " . $room->tenant_id . ")" . PHP_EOL;
}

echo PHP_EOL;

// Test 3: Récupérer les transactions
echo "💰 Transactions visibles:" . PHP_EOL;
$transactions = \App\Models\Transaction::all();
echo "   Total: " . $transactions->count() . PHP_EOL;
foreach ($transactions as $trans) {
    echo "   - Transaction #" . $trans->id . " (Tenant: " . $trans->tenant_id . ")" . PHP_EOL;
}

echo PHP_EOL;

// Test 4: Récupérer les clients
echo "🧑‍🤝‍🧑 Clients visibles:" . PHP_EOL;
$customers = \App\Models\Customer::all();
echo "   Total: " . $customers->count() . PHP_EOL;
foreach ($customers as $customer) {
    echo "   - " . $customer->name . " (Tenant: " . $customer->tenant_id . ")" . PHP_EOL;
}

echo PHP_EOL;

// 3. Test cross-tenant (ne doit PAS fonctionner)
echo "3. 🚫 TEST CROSS-TENANT (DOIT ÉCHOUER)" . PHP_EOL;
echo str_repeat("-", 60) . PHP_EOL;

// Tenter de récupérer directement les données du tenant 5
echo "🔍 Tentative d'accès aux données du tenant 5:" . PHP_EOL;

// Utiliser une requête directe (bypass global scopes)
$tenant5UsersDirect = \Illuminate\Support\Facades\DB::table('users')->where('tenant_id', 5)->get();
echo "   Utilisateurs tenant 5 (DB direct): " . $tenant5UsersDirect->count() . PHP_EOL;

$tenant5UsersModel = \App\Models\User::where('tenant_id', 5)->get();
echo "   Utilisateurs tenant 5 (Model avec scopes): " . $tenant5UsersModel->count() . PHP_EOL;

if ($tenant5UsersModel->count() == 0) {
    echo "✅ Global scopes fonctionnent: Accès cross-tenant bloqué" . PHP_EOL;
} else {
    echo "❌ Global scopes ne fonctionnent pas: Accès cross-tenant permis!" . PHP_EOL;
}

echo PHP_EOL;

// 4. Test de création de données
echo "4. ➕ TEST CRÉATION DE DONNÉES" . PHP_EOL;
echo str_repeat("-", 60) . PHP_EOL;

try {
    // Créer une nouvelle chambre (doit automatiquement avoir tenant_id = 4)
    $newRoom = new \App\Models\Room();
    $newRoom->name = 'Chambre Test Multitenant';
    $newRoom->type_id = 1;
    $newRoom->status_id = 1;
    $newRoom->price = 100.00;
    $newRoom->save();
    
    echo "✅ Nouvelle chambre créée: " . $newRoom->name . PHP_EOL;
    echo "✅ Tenant ID automatique: " . $newRoom->tenant_id . PHP_EOL;
    
    // Vérifier que la chambre est bien visible
    $visibleRooms = \App\Models\Room::all();
    echo "✅ Chambres visibles après création: " . $visibleRooms->count() . PHP_EOL;
    
    // Nettoyer
    $newRoom->delete();
    echo "✅ Chambre de test supprimée" . PHP_EOL;
    
} catch (Exception $e) {
    echo "❌ Erreur création: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL;

// 5. Test avec un utilisateur du tenant 5
echo "5. 🔄 CHANGEMENT DE CONTEXTE VERS TENANT 5" . PHP_EOL;
echo str_repeat("-", 60) . PHP_EOL;

$user5 = \App\Models\User::where('tenant_id', 5)->where('role', 'Admin')->first();
if ($user5) {
    echo "✅ Changement vers: " . $user5->name . PHP_EOL;
    
    // Réinitialiser et changer de contexte
    \Illuminate\Support\Facades\Auth::setUser($user5);
    
    // Réappliquer le middleware
    $middleware->handle($request, $next);
    
    // Vérifier les utilisateurs visibles
    $users5 = \App\Models\User::all();
    echo "👥 Utilisateurs visibles du tenant 5: " . $users5->count() . PHP_EOL;
    
    foreach ($users5 as $u) {
        echo "   - " . $u->name . " (Tenant: " . $u->tenant_id . ")" . PHP_EOL;
    }
    
    if ($users5->count() > 0 && $users5->first()->tenant_id == 5) {
        echo "✅ Changement de contexte réussi" . PHP_EOL;
    } else {
        echo "❌ Changement de contexte échoué" . PHP_EOL;
    }
}

echo PHP_EOL;
echo "🎯 Test terminé - Le multitenant est " . PHP_EOL;
echo "   ✅ FONCTIONNEL si les tests ci-dessus sont réussis" . PHP_EOL;
echo "   ❌ DÉFECTUEUX si des données cross-tenant sont visibles" . PHP_EOL;
