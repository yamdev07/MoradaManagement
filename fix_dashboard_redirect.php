<?php

// Correction du problème de redirection du dashboard

echo "🔧 Correction du problème de dashboard\n\n";

try {
    echo "📋 Problème identifié:\n";
    echo "❌ Vous accédez à /dashboard/stats qui renvoie du JSON\n";
    echo "✅ Vous devriez accéder à /super-admin/dashboard pour le dashboard HTML\n\n";

    echo "📋 Routes en conflit:\n";
    echo "   /dashboard/stats → DashboardController@updateStats (JSON)\n";
    echo "   /super-admin/dashboard → SuperAdminController@dashboard (HTML)\n\n";

    echo "🔧 Solution:\n";
    echo "1. Assurez-vous d'accéder à la bonne URL: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "2. Vérifiez que la redirection après login fonctionne correctement\n";
    echo "3. Le dashboard Super Admin utilise la vue superadmin.dashboard\n\n";

    echo "📋 Vérification des fichiers:\n";
    
    $files = [
        'resources/views/superadmin/layout.blade.php',
        'resources/views/superadmin/dashboard.blade.php',
        'resources/views/superadmin/tenants.blade.php'
    ];
    
    foreach ($files as $file) {
        if (file_exists($file)) {
            echo "   ✅ " . basename($file) . " - Existe\n";
        } else {
            echo "   ❌ " . basename($file) . " - Manquant\n";
        }
    }

    echo "\n📋 Vérification du Super Admin:\n";
    
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    $stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE email = 'superadmin@hotelio.com'");
    $stmt->execute();
    $superAdmin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($superAdmin) {
        echo "   ✅ Super Admin: " . $superAdmin['name'] . " (" . $superAdmin['role'] . ")\n";
    } else {
        echo "   ❌ Super Admin NON trouvé\n";
    }

    echo "\n🎯 Instructions correctes:\n";
    echo "1. Connectez-vous avec: superadmin@hotelio.com / superadmin123\n";
    echo "2. Après connexion, vous DEVEZ être redirigé vers: /super-admin/dashboard\n";
    echo "3. Si vous êtes redirigé vers /dashboard, c'est un problème\n";
    echo "4. L'URL correcte est: http://127.0.0.1:8000/super-admin/dashboard\n\n";

    echo "🔧 Si la redirection ne fonctionne pas:\n";
    echo "1. Accédez manuellement à: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "2. Vérifiez que le LoginController a bien été modifié\n";
    echo "3. Clear les caches: php artisan config:clear\n";
    echo "4. Redémarrez le serveur\n\n";

    echo "📋 Ce que vous devriez voir sur le dashboard:\n";
    echo "   - Layout avec sidebar Super Admin\n";
    echo "   - Cartes de statistiques (Hôtels, En attente, Revenus, Utilisateurs)\n";
    echo "   - Section 'Hôtels en attente de validation'\n";
    echo "   - Graphiques interactifs\n";
    echo "   - Navigation complète\n\n";

    echo "🚀 Test immédiat:\n";
    echo "Accédez directement à: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "Vous devriez voir le dashboard HTML complet !\n";

} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
