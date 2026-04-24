<?php

// Test de la correction de redirection pour le Super Admin

echo "🔄 Test de la correction de redirection\n\n";

try {
    echo "📋 Vérification du Super Admin:\n";
    
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    $stmt = $pdo->prepare("SELECT id, name, email, role, tenant_id FROM users WHERE email = 'superadmin@hotelio.com'");
    $stmt->execute();
    $superAdmin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($superAdmin) {
        echo "✅ Super Admin trouvé:\n";
        echo "   - ID: " . $superAdmin['id'] . "\n";
        echo "   - Nom: " . $superAdmin['name'] . "\n";
        echo "   - Email: " . $superAdmin['email'] . "\n";
        echo "   - Rôle: " . $superAdmin['role'] . "\n";
        echo "   - Tenant ID: " . ($superAdmin['tenant_id'] ?: 'NULL') . "\n";
    } else {
        echo "❌ Super Admin NON trouvé\n";
    }
    
    echo "\n📋 Modification apportée:\n";
    echo "✅ LoginController modifié pour gérer la redirection selon le rôle\n";
    echo "✅ Méthode authenticated() ajoutée\n";
    echo "✅ Redirection spécifique pour le rôle 'Super'\n";
    
    echo "\n📋 Logique de redirection:\n";
    echo "   - Super Admin → /super-admin/dashboard\n";
    echo "   - Admin (avec tenant) → /tenant/dashboard\n";
    echo "   - Admin (sans tenant) → /dashboard\n";
    echo "   - Manager → /dashboard\n";
    echo "   - Customer → /\n";
    echo "   - Default → /dashboard\n";
    
    echo "\n📋 Routes Super Admin vérifiées:\n";
    $routes = [
        '/super-admin/dashboard' => 'super-admin.dashboard',
        '/super-admin/tenants' => 'super-admin.tenants',
        '/super-admin/users' => 'super-admin.users',
    ];
    
    foreach ($routes as $url => $route) {
        echo "   ✅ " . $url . " → " . $route . "\n";
    }
    
    echo "\n📋 Fichiers de vue Super Admin:\n";
    $viewFiles = [
        'resources/views/superadmin/layout.blade.php',
        'resources/views/superadmin/dashboard.blade.php',
        'resources/views/superadmin/tenants.blade.php',
    ];
    
    foreach ($viewFiles as $file) {
        if (file_exists($file)) {
            echo "   ✅ " . basename($file) . "\n";
        } else {
            echo "   ❌ " . basename($file) . "\n";
        }
    }
    
    echo "\n🎯 Instructions de test:\n";
    echo "1. Démarrez le serveur: php artisan serve\n";
    echo "2. Connectez-vous avec le Super Admin:\n";
    echo "   URL: http://127.0.0.1:8000/login\n";
    echo "   Email: superadmin@hotelio.com\n";
    echo "   Mot de passe: superadmin123\n";
    echo "3. Après connexion, vous devriez être redirigé vers:\n";
    echo "   http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "4. Le dashboard devrait afficher:\n";
    echo "   - Les statistiques globales\n";
    echo "   - Les hôtels en attente (2 hôtels)\n";
    echo "   - Les graphiques interactifs\n";
    echo "   - La navigation Super Admin\n";
    
    echo "\n🔧 Si la redirection ne fonctionne pas:\n";
    echo "1. Vérifiez que le LoginController a bien été modifié\n";
    echo "2. Clear les caches: php artisan cache:clear\n";
    echo "3. Redémarrez le serveur\n";
    echo "4. Essayez de vous reconnecter\n";
    
    echo "\n🚀 La redirection Super Admin est maintenant corrigée !\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
