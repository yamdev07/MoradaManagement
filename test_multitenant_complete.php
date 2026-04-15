<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== TEST COMPLET DU MULTITENANT ===" . PHP_EOL;
echo PHP_EOL;

// 1. Vérification des tables avec tenant_id
echo "1. 📊 TABLES AVEC TENANT_ID" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

$tables = ['users', 'rooms', 'transactions', 'customers'];
foreach ($tables as $table) {
    try {
        $columns = \Illuminate\Support\Facades\Schema::getColumnListing($table);
        if (in_array('tenant_id', $columns)) {
            echo "✅ $table : COLONNE tenant_id PRÉSENTE" . PHP_EOL;
        } else {
            echo "❌ $table : COLONNE tenant_id MANQUANTE" . PHP_EOL;
        }
    } catch (Exception $e) {
        echo "❌ $table : ERREUR - " . $e->getMessage() . PHP_EOL;
    }
}

echo PHP_EOL;

// 2. Vérification du modèle Tenant
echo "2. 🏨 MODÈLE TENANT" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

try {
    $tenantModel = new \App\Models\Tenant();
    echo "✅ Modèle Tenant : PRÉSENT" . PHP_EOL;
    
    $tenants = \App\Models\Tenant::all();
    echo "✅ Tenants trouvés : " . $tenants->count() . PHP_EOL;
    
    foreach ($tenants as $tenant) {
        echo "   - {$tenant->name} (ID: {$tenant->id})" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "❌ Modèle Tenant : ERREUR - " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL;

// 3. Vérification du middleware SetTenant
echo "3. 🔧 MIDDLEWARE SETTENANT" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

try {
    $middlewarePath = app_path('Http/Middleware/SetTenant.php');
    if (file_exists($middlewarePath)) {
        echo "✅ Middleware SetTenant : PRÉSENT" . PHP_EOL;
        
        // Vérifier s'il est enregistré dans Kernel.php
        $kernelContent = file_get_contents(app_path('Http/Kernel.php'));
        if (strpos($kernelContent, 'SetTenant') !== false) {
            echo "✅ Middleware SetTenant : ENREGISTRÉ dans Kernel.php" . PHP_EOL;
        } else {
            echo "❌ Middleware SetTenant : NON ENREGISTRÉ dans Kernel.php" . PHP_EOL;
        }
    } else {
        echo "❌ Middleware SetTenant : MANQUANT" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "❌ Middleware SetTenant : ERREUR - " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL;

// 4. Vérification du trait BelongsToTenant
echo "4. 🏷️ TRAIT BELONGSTOTENANT" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

try {
    $traitPath = app_path('Traits/BelongsToTenant.php');
    if (file_exists($traitPath)) {
        echo "✅ Trait BelongsToTenant : PRÉSENT" . PHP_EOL;
    } else {
        echo "❌ Trait BelongsToTenant : MANQUANT" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "❌ Trait BelongsToTenant : ERREUR - " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL;

// 5. Vérification des modèles avec tenant_id
echo "5. 📋 MODÈLES AVEC TENANT_ID" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

$models = ['User', 'Room', 'Transaction', 'Customer'];
foreach ($models as $model) {
    try {
        $modelClass = "App\\Models\\{$model}";
        $modelInstance = new $modelClass();
        
        // Vérifier si le modèle utilise le trait
        $traits = class_uses($modelInstance);
        if (isset($traits['App\\Traits\\BelongsToTenant'])) {
            echo "✅ $model : UTILISE BelongsToTenant" . PHP_EOL;
        } else {
            echo "⚠️  $model : N'UTILISE PAS BelongsToTenant" . PHP_EOL;
        }
        
        // Vérifier si tenant_id est dans fillable
        $fillable = $modelInstance->getFillable();
        if (in_array('tenant_id', $fillable)) {
            echo "✅ $model : tenant_id dans fillable" . PHP_EOL;
        } else {
            echo "❌ $model : tenant_id PAS dans fillable" . PHP_EOL;
        }
        
    } catch (Exception $e) {
        echo "❌ $model : ERREUR - " . $e->getMessage() . PHP_EOL;
    }
}

echo PHP_EOL;

// 6. Test d'isolation des données
echo "6. 🛡️ TEST D'ISOLATION DES DONNÉES" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

$tenants = \App\Models\Tenant::where('status', 1)->get();
foreach ($tenants as $tenant) {
    echo PHP_EOL . "🏨 Tenant: {$tenant->name} (ID: {$tenant->id})" . PHP_EOL;
    
    // Test utilisateurs
    $users = \App\Models\User::where('tenant_id', $tenant->id)->get();
    echo "   👥 Utilisateurs: " . $users->count() . PHP_EOL;
    
    // Test chambres
    try {
        $rooms = \App\Models\Room::where('tenant_id', $tenant->id)->get();
        echo "   🏠 Chambres: " . $rooms->count() . PHP_EOL;
    } catch (Exception $e) {
        echo "   🏠 Chambres: ERREUR - " . $e->getMessage() . PHP_EOL;
    }
    
    // Test transactions
    try {
        $transactions = \App\Models\Transaction::where('tenant_id', $tenant->id)->get();
        echo "   💰 Transactions: " . $transactions->count() . PHP_EOL;
    } catch (Exception $e) {
        echo "   💰 Transactions: ERREUR - " . $e->getMessage() . PHP_EOL;
    }
    
    // Test clients
    try {
        $customers = \App\Models\Customer::where('tenant_id', $tenant->id)->get();
        echo "   🧑‍🤝‍🧑 Clients: " . $customers->count() . PHP_EOL;
    } catch (Exception $e) {
        echo "   🧑‍🤝‍🧑 Clients: ERREUR - " . $e->getMessage() . PHP_EOL;
    }
}

echo PHP_EOL;

// 7. Vérification des routes multitenant
echo "7. 🛣️ ROUTES MULTITENANT" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

try {
    $routesPath = base_path('routes/web.php');
    $routesContent = file_get_contents($routesPath);
    
    if (strpos($routesContent, 'tenant/') !== false) {
        echo "✅ Routes tenant : PRÉSENTES" . PHP_EOL;
        
        // Chercher les routes spécifiques
        if (strpos($routesContent, 'tenant/{subdomain}/dashboard') !== false) {
            echo "✅ Route dashboard multitenant : PRÉSENTE" . PHP_EOL;
        }
    } else {
        echo "❌ Routes tenant : MANQUANTES" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "❌ Routes : ERREUR - " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL;

// 8. Vérification du contrôleur TenantAdminController
echo "8. 🎛️ CONTRÔLEUR TENANTADMINCONTROLLER" . PHP_EOL;
echo str_repeat("-", 50) . PHP_EOL;

try {
    $controllerPath = app_path('Http/Controllers/TenantAdminController.php');
    if (file_exists($controllerPath)) {
        echo "✅ TenantAdminController : PRÉSENT" . PHP_EOL;
        
        // Vérifier les méthodes
        $controllerContent = file_get_contents($controllerPath);
        if (strpos($controllerContent, 'dashboard') !== false) {
            echo "✅ Méthode dashboard : PRÉSENTE" . PHP_EOL;
        }
    } else {
        echo "❌ TenantAdminController : MANQUANT" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "❌ TenantAdminController : ERREUR - " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL;

// 9. Résumé
echo "9. 📋 RÉSUMÉ" . PHP_EOL;
echo str_repeat("=", 50) . PHP_EOL;

echo "🔍 Analyse complète terminée !" . PHP_EOL;
echo "📊 Vérifiez les ✅ et ❌ ci-dessus" . PHP_EOL;
echo "🏨 Le multitenant est implémenté si la majorité est ✅" . PHP_EOL;
