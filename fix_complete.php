<?php

// Script complet pour corriger le problème de customer

echo "🔧 Solution complète pour le problème de customer de la transaction ID 13\n\n";

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 État actuel de la transaction ID 13 :\n";
    
    // Vérifier l'état actuel
    $stmt = $pdo->prepare("SELECT id, customer_id, user_id, tenant_id FROM transactions WHERE id = ?");
    $stmt->execute([13]);
    $transaction = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$transaction) {
        echo "❌ Transaction ID 13 non trouvée\n";
        exit;
    }
    
    echo "   Customer ID: " . ($transaction['customer_id'] ?? 'NULL') . "\n";
    echo "   User ID: " . $transaction['user_id'] . "\n";
    echo "   Tenant ID: " . $transaction['tenant_id'] . "\n";
    
    // Vérifier le user associé
    $stmt = $pdo->prepare("SELECT name, email, tenant_id FROM users WHERE id = ?");
    $stmt->execute([$transaction['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo "   User associé: " . $user['name'] . " (Tenant ID: " . $user['tenant_id'] . ")\n";
    }
    
    echo "\n🔧 Solution : Créer un customer et user pour le tenant 63\n";
    
    // Étape 1: Créer un user pour le tenant 63 s'il n'existe pas
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND tenant_id = ?");
    $stmt->execute(['majorelle@gmail.com', 63]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $userIdForTenant63;
    
    if ($existingUser) {
        echo "✅ User trouvé pour le tenant 63 (ID: " . $existingUser['id'] . ")\n";
        $userIdForTenant63 = $existingUser['id'];
    } else {
        echo "📝 Création d'un user pour le tenant 63\n";
        
        // Créer le user pour le tenant 63
        $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, role, tenant_id, is_active, email_verified_at, created_at, updated_at) VALUES (?, ?, ?, 'Admin', ?, 1, NOW(), NOW(), NOW())");
        $result = $stmt->execute(['milca VODUNON', 'majorelle@gmail.com', '+22945665432', 63]);
        
        if ($result) {
            $userIdForTenant63 = $pdo->lastInsertId();
            echo "✅ Nouveau user créé (ID: " . $userIdForTenant63 . ")\n";
        } else {
            echo "❌ Erreur lors de la création du user\n";
            exit(1);
        }
    }
    
    // Étape 2: Créer un customer pour le tenant 63
    $stmt = $pdo->prepare("SELECT id FROM customers WHERE email = ? AND tenant_id = ?");
    $stmt->execute(['majorelle@gmail.com', 63]);
    $existingCustomer = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existingCustomer) {
        echo "✅ Customer trouvé pour le tenant 63 (ID: " . $existingCustomer['id'] . ")\n";
        $customerIdForTenant63 = $existingCustomer['id'];
    } else {
        echo "📝 Création d'un customer pour le tenant 63\n";
        
        // Créer le customer pour le tenant 63
        $stmt = $pdo->prepare("INSERT INTO customers (name, email, phone, user_id, tenant_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
        $result = $stmt->execute(['milca VODUNON', 'majorelle@gmail.com', '+22945665432', $userIdForTenant63, 63]);
        
        if ($result) {
            $customerIdForTenant63 = $pdo->lastInsertId();
            echo "✅ Nouveau customer créé (ID: " . $customerIdForTenant63 . ")\n";
        } else {
            echo "❌ Erreur lors de la création du customer\n";
            exit(1);
        }
    }
    
    // Étape 3: Mettre à jour la transaction
    echo "🔧 Mise à jour de la transaction...\n";
    $stmt = $pdo->prepare("UPDATE transactions SET customer_id = ?, user_id = ? WHERE id = ?");
    $result = $stmt->execute([$customerIdForTenant63, $userIdForTenant63, 13]);
    
    if ($result) {
        echo "✅ Transaction mise à jour avec succès\n";
    } else {
        echo "❌ Erreur lors de la mise à jour de la transaction\n";
        exit(1);
    }
    
    // Vérification finale
    echo "\n📋 Vérification finale :\n";
    $stmt = $pdo->prepare("SELECT t.customer_id, t.user_id, c.name as customer_name, c.email as customer_email, u.name as user_name, u.email as user_email, t.tenant_id FROM transactions t LEFT JOIN customers c ON t.customer_id = c.id LEFT JOIN users u ON t.user_id = u.id WHERE t.id = ?");
    $stmt->execute([13]);
    $final = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($final) {
        echo "   Customer ID: " . $final['customer_id'] . "\n";
        echo "   Customer Name: " . ($final['customer_name'] ?? 'Non spécifié') . "\n";
        echo "   Customer Email: " . ($final['customer_email'] ?? 'Non spécifié') . "\n";
        echo "   User ID: " . $final['user_id'] . "\n";
        echo "   User Name: " . ($final['user_name'] ?? 'Non spécifié') . "\n";
        echo "   User Email: " . ($final['user_email'] ?? 'Non spécifié') . "\n";
        echo "   Tenant ID: " . $final['tenant_id'] . "\n";
        
        if ($final['customer_name']) {
            echo "\n🎉 SUCCÈS COMPLET !\n";
            echo "✅ Le customer 'milca VODUNON' est maintenant correctement associé au tenant 63\n";
            echo "✅ Le user 'milca VODUNON' est maintenant correctement associé au tenant 63\n";
            echo "✅ La transaction est maintenant cohérente avec le bon tenant\n";
            echo "✅ La page affichera correctement les informations du client\n";
            echo "🌐 Accédez à : http://127.0.0.1:8001/transaction/13\n";
            echo "\n🎯 Le problème 'Client non spécifié' est définitivement résolu !\n";
        } else {
            echo "\n❌ Le problème persiste\n";
        }
    } else {
        echo "❌ Impossible de vérifier le résultat final\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
