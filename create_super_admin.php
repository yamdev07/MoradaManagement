<?php

// Création d'un Super Admin pour gérer le dashboard

echo "👑 Création d'un Super Admin\n\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 Étape 1: Vérification des super admins existants\n";
    
    // Vérifier s'il y a déjà des super admins
    $stmt = $pdo->query("SELECT id, name, email, role FROM users WHERE role = 'Super'");
    $superAdmins = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($superAdmins)) {
        echo "✅ Super admins existants:\n";
        foreach ($superAdmins as $admin) {
            echo "   - ID: " . $admin['id'] . " | Nom: " . $admin['name'] . " | Email: " . $admin['email'] . "\n";
        }
        echo "\n";
    } else {
        echo "❌ Aucun super admin trouvé\n\n";
    }
    
    echo "📋 Étape 2: Création du Super Admin principal\n";
    
    $superAdminData = [
        'name' => 'Super Administrateur',
        'email' => 'superadmin@hotelio.com',
        'password' => password_hash('superadmin123', PASSWORD_DEFAULT),
        'role' => 'Super',
        'random_key' => bin2hex(random_bytes(30)),
        'tenant_id' => null, // Super admin n'a pas de tenant
        'is_active' => 1,
        'email_verified_at' => date('Y-m-d H:i:s'),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
    
    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$superAdminData['email']]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existingUser) {
        echo "⚠️  L'email " . $superAdminData['email'] . " existe déjà\n";
        echo "   Mise à jour du rôle vers Super Admin\n";
        
        $stmt = $pdo->prepare("UPDATE users SET role = 'Super', tenant_id = NULL, is_active = 1 WHERE email = ?");
        $stmt->execute([$superAdminData['email']]);
        echo "✅ Utilisateur mis à jour en Super Admin\n";
    } else {
        // Créer le super admin
        $columns = implode(', ', array_keys($superAdminData));
        $placeholders = implode(', ', array_fill(0, count($superAdminData), '?'));
        
        $stmt = $pdo->prepare("INSERT INTO users ($columns) VALUES ($placeholders)");
        $result = $stmt->execute(array_values($superAdminData));
        
        if ($result) {
            $superAdminId = $pdo->lastInsertId();
            echo "✅ Super Admin créé avec succès (ID: $superAdminId)\n";
        } else {
            echo "❌ Erreur lors de la création du Super Admin\n";
        }
    }
    
    echo "\n📋 Étape 3: Vérification finale\n";
    
    $stmt = $pdo->query("SELECT id, name, email, role, tenant_id FROM users WHERE role = 'Super' ORDER BY id");
    $allSuperAdmins = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "👑 Liste des Super Admins:\n";
    foreach ($allSuperAdmins as $admin) {
        echo "   - ID: " . $admin['id'] . "\n";
        echo "     Nom: " . $admin['name'] . "\n";
        echo "     Email: " . $admin['email'] . "\n";
        echo "     Rôle: " . $admin['role'] . "\n";
        echo "     Tenant: " . ($admin['tenant_id'] ? $admin['tenant_id'] : 'Global') . "\n";
        echo "\n";
    }
    
    echo "🎯 Instructions pour accéder au dashboard Super Admin:\n";
    echo "1. URL de connexion: http://127.0.0.1:8000/login\n";
    echo "2. Email: superadmin@hotelio.com\n";
    echo "3. Mot de passe: superadmin123\n";
    echo "4. Dashboard: http://127.0.0.1:8000/super-admin/dashboard\n";
    
    echo "\n🔧 Permissions du Super Admin:\n";
    echo "✅ Gestion de tous les tenants\n";
    echo "✅ Gestion de tous les utilisateurs\n";
    echo "✅ Gestion des réservations globales\n";
    echo "✅ Configuration système\n";
    echo "✅ Rapports et statistiques\n";
    echo "✅ Maintenance et nettoyage\n";
    
    echo "\n🎉 Super Admin prêt à gérer le système !\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
