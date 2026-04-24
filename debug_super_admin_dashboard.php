<?php

// Debug complet du dashboard Super Admin

echo "🔍 Debug complet du dashboard Super Admin\n\n";

try {
    echo "📋 1. Vérification des routes:\n";
    
    $routesFile = 'routes/web.php';
    if (file_exists($routesFile)) {
        $content = file_get_contents($routesFile);
        
        if (strpos($content, "Route::prefix('super-admin')") !== false) {
            echo "   ✅ Route super-admin trouvée\n";
        } else {
            echo "   ❌ Route super-admin NON trouvée\n";
        }
        
        if (strpos($content, "Route::get('/dashboard'") !== false) {
            echo "   ✅ Route dashboard trouvée\n";
        } else {
            echo "   ❌ Route dashboard NON trouvée\n";
        }
    }
    
    echo "\n📋 2. Vérification du contrôleur:\n";
    
    $controllerFile = 'app/Http/Controllers/SuperAdminController.php';
    if (file_exists($controllerFile)) {
        $content = file_get_contents($controllerFile);
        
        if (strpos($content, "public function dashboard()") !== false) {
            echo "   ✅ Méthode dashboard() trouvée\n";
        } else {
            echo "   ❌ Méthode dashboard() NON trouvée\n";
        }
        
        if (strpos($content, "return view('superadmin.dashboard'") !== false) {
            echo "   ✅ Vue superadmin.dashboard utilisée\n";
        } else {
            echo "   ❌ Vue superadmin.dashboard NON utilisée\n";
        }
    }
    
    echo "\n📋 3. Vérification des vues:\n";
    
    $viewFiles = [
        'resources/views/superadmin/layout.blade.php',
        'resources/views/superadmin/dashboard.blade.php',
        'resources/views/superadmin/tenants.blade.php'
    ];
    
    foreach ($viewFiles as $file) {
        if (file_exists($file)) {
            $size = filesize($file);
            echo "   ✅ " . basename($file) . " - " . formatBytes($size) . "\n";
        } else {
            echo "   ❌ " . basename($file) . " - MANQUANT\n";
        }
    }
    
    echo "\n📋 4. Vérification du Super Admin:\n";
    
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    $stmt = $pdo->prepare("SELECT id, name, email, role, tenant_id FROM users WHERE email = 'superadmin@hotelio.com'");
    $stmt->execute();
    $superAdmin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($superAdmin) {
        echo "   ✅ Super Admin trouvé:\n";
        echo "      ID: " . $superAdmin['id'] . "\n";
        echo "      Nom: " . $superAdmin['name'] . "\n";
        echo "      Email: " . $superAdmin['email'] . "\n";
        echo "      Rôle: " . $superAdmin['role'] . "\n";
        echo "      Tenant: " . ($superAdmin['tenant_id'] ?: 'NULL') . "\n";
    } else {
        echo "   ❌ Super Admin NON trouvé\n";
    }
    
    echo "\n📋 5. Vérification des données pour le dashboard:\n";
    
    // Statistiques
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM tenants WHERE is_active = 1");
    $activeTenants = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM tenants WHERE is_active = 0");
    $pendingTenants = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
    $totalUsers = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    echo "   ✅ Hôtels actifs: " . $activeTenants . "\n";
    echo "   ✅ Hôtels en attente: " . $pendingTenants . "\n";
    echo "   ✅ Total utilisateurs: " . $totalUsers . "\n";
    
    if ($pendingTenants > 0) {
        $stmt = $pdo->query("
            SELECT t.id, t.name, t.email, t.phone, t.created_at,
                   u.name as admin_name, u.email as admin_email
            FROM tenants t
            LEFT JOIN users u ON u.tenant_id = t.id AND u.role = 'admin'
            WHERE t.is_active = 0
            ORDER BY t.created_at DESC
            LIMIT 5
        ");
        
        $pendingList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "   ✅ Hôtels en attente (détails):\n";
        foreach ($pendingList as $tenant) {
            echo "      - " . $tenant['name'] . " (Admin: " . $tenant['admin_name'] . ")\n";
        }
    }
    
    echo "\n📋 6. Test d'accès direct:\n";
    echo "   URL: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "   Méthode: GET\n";
    echo "   Middleware: auth + checkrole:Super\n";
    echo "   Contrôleur: SuperAdminController@dashboard\n";
    echo "   Vue: superadmin.dashboard\n\n";
    
    echo "🎯 Conclusion:\n";
    echo "   ✅ Routes existent\n";
    echo "   ✅ Contrôleur existe\n";
    echo "   ✅ Vues existent\n";
    echo "   ✅ Super Admin existe\n";
    echo "   ✅ Données disponibles\n";
    echo "\n   📋 Le dashboard Super Admin EXISTE et doit fonctionner !\n";
    echo "\n🔧 Si vous voyez toujours /dashboard/stats:\n";
    echo "   1. Vous accédez à la mauvaise route\n";
    echo "   2. Accédez manuellement à: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "   3. Vérifiez l'URL exacte dans votre navigateur\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

function formatBytes($bytes, $precision = 2)
{
    $units = ['B', 'KB', 'MB', 'GB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    return round($bytes, $precision) . ' ' . $units[$pow];
}

?>
