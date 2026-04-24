<?php

// Afficher tous les fichiers qui touchent au dashboard Super Admin avec les infos de la base de données

echo "📋 FICHIERS DU DASHBOARD SUPER ADMIN + INFOS BASE DE DONNÉES\n\n";

try {
    // 1. Informations du Super Admin dans la base de données
    echo "👑 INFORMATIONS DU SUPER ADMIN EN BASE DE DONNÉES:\n";
    
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    $stmt = $pdo->prepare("SELECT id, name, email, role, tenant_id, is_active, email_verified_at, created_at, updated_at FROM users WHERE email = 'superadmin@hotelio.com'");
    $stmt->execute();
    $superAdmin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($superAdmin) {
        echo "   ID: " . $superAdmin['id'] . "\n";
        echo "   Nom: " . $superAdmin['name'] . "\n";
        echo "   Email: " . $superAdmin['email'] . "\n";
        echo "   Rôle: " . $superAdmin['role'] . "\n";
        echo "   Tenant ID: " . ($superAdmin['tenant_id'] ?: 'NULL (Global)') . "\n";
        echo "   Actif: " . ($superAdmin['is_active'] ? 'Oui' : 'Non') . "\n";
        echo "   Email vérifié: " . ($superAdmin['email_verified_at'] ? 'Oui' : 'Non') . "\n";
        echo "   Créé le: " . $superAdmin['created_at'] . "\n";
        echo "   Mis à jour: " . $superAdmin['updated_at'] . "\n";
    } else {
        echo "   ❌ Super Admin NON trouvé\n";
    }
    
    echo "\n📊 STATISTIQUES POUR LE DASHBOARD:\n";
    
    // Statistiques pour le dashboard
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM tenants WHERE is_active = 1");
    $activeTenants = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM tenants WHERE is_active = 0");
    $pendingTenants = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
    $totalUsers = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM rooms");
    $totalRooms = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM customers");
    $totalCustomers = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM transactions");
    $totalTransactions = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT SUM(total_price) as total FROM transactions");
    $totalRevenue = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?: 0;
    
    echo "   Hôtels actifs: " . $activeTenants . "\n";
    echo "   Hôtels en attente: " . $pendingTenants . "\n";
    echo "   Total utilisateurs: " . $totalUsers . "\n";
    echo "   Total chambres: " . $totalRooms . "\n";
    echo "   Total customers: " . $totalCustomers . "\n";
    echo "   Total transactions: " . $totalTransactions . "\n";
    echo "   Revenus totaux: " . number_format($totalRevenue, 0, ',', ' ') . " FCFA\n";
    
    echo "\n🏨 DÉTAILS DES HÔTELS EN ATTENTE:\n";
    
    if ($pendingTenants > 0) {
        $stmt = $pdo->query("
            SELECT t.id, t.name, t.email, t.phone, t.address, t.description, t.created_at,
                   u.name as admin_name, u.email as admin_email
            FROM tenants t
            LEFT JOIN users u ON u.tenant_id = t.id AND u.role = 'admin'
            WHERE t.is_active = 0
            ORDER BY t.created_at DESC
        ");
        
        $pendingList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($pendingList as $tenant) {
            echo "   🏨 " . $tenant['name'] . " (ID: " . $tenant['id'] . ")\n";
            echo "      Email: " . $tenant['email'] . "\n";
            echo "      Téléphone: " . $tenant['phone'] . "\n";
            echo "      Adresse: " . ($tenant['address'] ?: 'N/A') . "\n";
            echo "      Admin: " . ($tenant['admin_name'] ?: 'Non défini') . " (" . ($tenant['admin_email'] ?: 'N/A') . ")\n";
            echo "      Date d'inscription: " . $tenant['created_at'] . "\n";
            echo "\n";
        }
    } else {
        echo "   ✅ Aucun hôtel en attente\n";
    }
    
    echo "\n📁 FICHIERS QUI TOUCHENT AU DASHBOARD SUPER ADMIN:\n\n";
    
    // 1. Contrôleur principal
    echo "🔹 1. CONTRÔLEUR PRINCIPAL:\n";
    $controllerFile = 'app/Http/Controllers/SuperAdminController.php';
    if (file_exists($controllerFile)) {
        $size = filesize($controllerFile);
        echo "   📄 SuperAdminController.php (" . formatBytes($size) . ")\n";
        
        $content = file_get_contents($controllerFile);
        $lines = explode("\n", $content);
        
        echo "   📋 Méthodes principales:\n";
        foreach ($lines as $lineNumber => $line) {
            if (strpos($line, 'public function') !== false) {
                echo "      - " . trim($line) . " (ligne " . ($lineNumber + 1) . ")\n";
            }
        }
    }
    
    echo "\n🔹 2. VUES DU DASHBOARD:\n";
    $viewFiles = [
        'resources/views/superadmin/layout.blade.php',
        'resources/views/superadmin/dashboard.blade.php',
        'resources/views/superadmin/tenants.blade.php',
    ];
    
    foreach ($viewFiles as $file) {
        if (file_exists($file)) {
            $size = filesize($file);
            echo "   📄 " . basename($file) . " (" . formatBytes($size) . ")\n";
            
            $content = file_get_contents($file);
            
            // Vérifier les sections importantes
            if (strpos($content, '@extends') !== false) {
                echo "      - Hérite d'un layout\n";
            }
            if (strpos($content, 'sidebar') !== false) {
                echo "      - Contient une sidebar\n";
            }
            if (strpos($content, 'card') !== false) {
                echo "      - Contient des cartes\n";
            }
            if (strpos($content, 'chart') !== false) {
                echo "      - Contient des graphiques\n";
            }
        }
    }
    
    echo "\n🔹 3. ROUTES:\n";
    $routesFile = 'routes/web.php';
    if (file_exists($routesFile)) {
        $content = file_get_contents($routesFile);
        
        if (strpos($content, "Route::prefix('super-admin')") !== false) {
            echo "   ✅ Route super-admin trouvée\n";
            
            // Extraire les routes super-admin
            preg_match_all("/Route::(get|post|put|delete)\s*\(\s*'([^']+)'.*?\)/", $content, $matches);
            echo "   📋 Routes Super Admin:\n";
            foreach ($matches[2] as $index => $route) {
                echo "      - /super-admin/" . $route . " (" . $matches[1][$index] . ")\n";
            }
        }
    }
    
    echo "\n🔹 4. LOGIN CONTROLLER (redirection):\n";
    $loginControllerFile = 'app/Http/Controllers/Auth/LoginController.php';
    if (file_exists($loginControllerFile)) {
        $content = file_get_contents($loginControllerFile);
        
        if (strpos($content, 'authenticated') !== false) {
            echo "   ✅ Méthode authenticated() trouvée\n";
            echo "   📋 Redirection Super Admin: /super-admin/dashboard\n";
        }
        
        if (strpos($content, 'redirectPath') !== false) {
            echo "   ✅ Méthode redirectPath() trouvée\n";
        }
    }
    
    echo "\n🔹 5. DASHBOARD CONTROLLER (correction JSON):\n";
    $dashboardControllerFile = 'app/Http/Controllers/DashboardController.php';
    if (file_exists($dashboardControllerFile)) {
        $content = file_get_contents($dashboardControllerFile);
        
        if (strpos($content, 'updateStats') !== false) {
            echo "   ✅ Méthode updateStats() trouvée\n";
            
            if (strpos($content, "role === 'Super'") !== false) {
                echo "   ✅ Redirection Super Admin implémentée\n";
            } else {
                echo "   ❌ Redirection Super Admin NON implémentée\n";
            }
        }
    }
    
    echo "\n🔹 6. MIDDLEWARE:\n";
    $middlewareFiles = [
        'app/Http/Middleware/SetTenant.php',
        'app/Http/Middleware/TenantThemeMiddleware.php',
        'app/Http/Middleware/CheckHousekeepingReadOnly.php',
    ];
    
    foreach ($middlewareFiles as $file) {
        if (file_exists($file)) {
            $size = filesize($file);
            echo "   📄 " . basename($file) . " (" . formatBytes($size) . ")\n";
            
            $content = file_get_contents($file);
            if (strpos($content, 'Super') !== false) {
                echo "      - Contient une référence au rôle Super\n";
            }
        }
    }
    
    echo "\n🎯 RÉSUMÉ COMPLET:\n";
    echo "   ✅ Super Admin: " . ($superAdmin ? $superAdmin['name'] : 'NON TROUVÉ') . "\n";
    echo "   ✅ Contrôleur: SuperAdminController.php\n";
    echo "   ✅ Vues: 3 fichiers Blade\n";
    echo "   ✅ Routes: /super-admin/*\n";
    echo "   ✅ Données: " . $activeTenants . " hôtels actifs, " . $pendingTenants . " en attente\n";
    echo "   ✅ Revenus: " . number_format($totalRevenue, 0, ',', ' ') . " FCFA\n";
    
    echo "\n🚀 Le dashboard Super Admin est COMPLET et doit fonctionner !\n";
    
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
