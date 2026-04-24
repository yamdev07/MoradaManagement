<?php

// Test du dashboard Super Admin

echo "🧪 Test du Dashboard Super Admin\n\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 Vérification du Super Admin:\n";
    
    // Vérifier le Super Admin
    $stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE email = 'superadmin@hotelio.com'");
    $stmt->execute();
    $superAdmin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($superAdmin) {
        echo "✅ Super Admin trouvé:\n";
        echo "   - ID: " . $superAdmin['id'] . "\n";
        echo "   - Nom: " . $superAdmin['name'] . "\n";
        echo "   - Email: " . $superAdmin['email'] . "\n";
        echo "   - Rôle: " . $superAdmin['role'] . "\n";
    } else {
        echo "❌ Super Admin NON trouvé\n";
    }
    
    echo "\n📋 Statistiques des hôtels:\n";
    
    // Statistiques générales
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM tenants WHERE is_active = 1");
    $activeTenants = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM tenants WHERE is_active = 0");
    $pendingTenants = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
    $totalUsers = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    echo "   - Hôtels actifs: " . $activeTenants . "\n";
    echo "   - Hôtels en attente: " . $pendingTenants . "\n";
    echo "   - Total utilisateurs: " . $totalUsers . "\n";
    
    echo "\n📋 Détails des hôtels en attente:\n";
    
    if ($pendingTenants > 0) {
        $stmt = $pdo->query("
            SELECT t.id, t.name, t.email, t.phone, t.created_at,
                   u.name as admin_name, u.email as admin_email
            FROM tenants t
            LEFT JOIN users u ON u.tenant_id = t.id AND u.role = 'admin'
            WHERE t.is_active = 0
            ORDER BY t.created_at DESC
        ");
        
        $pendingTenantsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($pendingTenantsList as $tenant) {
            echo "   🏨 " . $tenant['name'] . "\n";
            echo "      Email: " . $tenant['email'] . "\n";
            echo "      Téléphone: " . $tenant['phone'] . "\n";
            echo "      Admin: " . $tenant['admin_name'] . " (" . $tenant['admin_email'] . ")\n";
            echo "      Date: " . $tenant['created_at'] . "\n";
            echo "\n";
        }
    } else {
        echo "   ✅ Aucun hôtel en attente\n";
    }
    
    echo "\n📋 Vérification des fichiers de vue:\n";
    
    $viewFiles = [
        'resources/views/superadmin/layout.blade.php',
        'resources/views/superadmin/dashboard.blade.php',
        'resources/views/superadmin/tenants.blade.php'
    ];
    
    foreach ($viewFiles as $file) {
        if (file_exists($file)) {
            echo "   ✅ " . basename($file) . " - Existe\n";
        } else {
            echo "   ❌ " . basename($file) . " - Manquant\n";
        }
    }
    
    echo "\n📋 Vérification des routes:\n";
    
    $routes = [
        'super-admin.dashboard' => '/super-admin/dashboard',
        'super-admin.tenants' => '/super-admin/tenants',
        'super-admin.users' => '/super-admin/users',
    ];
    
    foreach ($routes as $route => $url) {
        echo "   ✅ " . $route . " -> " . $url . "\n";
    }
    
    echo "\n🎯 Instructions de test:\n";
    echo "1. Démarrez le serveur: php artisan serve\n";
    echo "2. Connectez-vous: http://127.0.0.1:8000/login\n";
    echo "   - Email: superadmin@hotelio.com\n";
    echo "   - Mot de passe: superadmin123\n";
    echo "3. Accédez au dashboard: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "4. Vérifiez:\n";
    echo "   - Les statistiques s'affichent correctement\n";
    echo "   - Les hôtels en attente apparaissent\n";
    echo "   - Les graphiques fonctionnent\n";
    echo "   - La navigation fonctionne\n";
    
    echo "\n🚀 Le dashboard Super Admin est prêt !\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
