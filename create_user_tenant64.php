<?php

// Script pour créer un utilisateur pour le nouveau tenant HOTEL-T (ID 64)

echo "👤 Création d'un utilisateur pour le tenant HOTEL-T (ID 64)\n\n";

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    // Vérifier le tenant 64
    $stmt = $pdo->prepare("SELECT * FROM tenants WHERE id = 64");
    $stmt->execute();
    $tenant = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$tenant) {
        echo "❌ Tenant ID 64 non trouvé\n";
        exit;
    }
    
    echo "✅ Tenant trouvé: " . $tenant['name'] . " (" . $tenant['subdomain'] . ")\n";
    
    // Créer un utilisateur pour ce tenant
    require_once 'vendor/autoload.php';
    $userData = [
        'name' => 'milca VODUNON',
        'email' => 'majorelle.tenant64@morada-management.com',
        'password' => password_hash('password123', PASSWORD_DEFAULT),
        'phone' => '+22945665432',
        'role' => 'Admin',
        'tenant_id' => 64,
        'is_active' => 1,
        'email_verified_at' => date('Y-m-d H:i:s'),
        'random_key' => bin2hex(random_bytes(16)),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
    
    // Vérifier si l'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND tenant_id = ?");
    $stmt->execute([$userData['email'], $userData['tenant_id']]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existingUser) {
        echo "⚠️  Utilisateur existe déjà pour ce tenant\n";
        
        // Mettre à jour le mot de passe
        $stmt = $pdo->prepare("UPDATE users SET password = ?, is_active = 1 WHERE id = ?");
        $stmt->execute([password_hash('password123', PASSWORD_DEFAULT), $existingUser['id']]);
        echo "✅ Mot de passe mis à jour\n";
        $userId = $existingUser['id'];
    } else {
        // Insérer le nouvel utilisateur
        $columns = implode(', ', array_keys($userData));
        $placeholders = implode(', ', array_fill(0, count($userData), '?'));
        
        $stmt = $pdo->prepare("INSERT INTO users ($columns) VALUES ($placeholders)");
        $stmt->execute(array_values($userData));
        
        $userId = $pdo->lastInsertId();
        echo "✅ Nouvel utilisateur créé (ID: " . $userId . ")\n";
    }
    
    echo "\n📋 Identifiants de connexion:\n";
    echo "   Email: " . $userData['email'] . "\n";
    echo "   Mot de passe: password123\n";
    echo "   Tenant: " . $tenant['name'] . " (ID: " . $tenant['id'] . ")\n";
    
    echo "\n🌐 URL de connexion:\n";
    echo "   http://127.0.0.1:8000/login\n";
    
    echo "\n🔧 Après connexion:\n";
    echo "   1. Allez à: http://127.0.0.1:8000/transaction/reservation/createIdentity\n";
    echo "   2. La page de réservation devrait maintenant fonctionner\n";
    
    echo "\n🎯 Si le problème persiste après connexion:\n";
    echo "   - Videz le cache du navigateur\n";
    echo "   - Essayez en navigation privée\n";
    echo "   - Vérifiez que vous êtes bien sur le tenant 64\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
