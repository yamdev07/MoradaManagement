<?php

// Script pour nettoyer les conflits de base de données après suppression

echo "🧹 Nettoyage complet des conflits de base de données\n\n";

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 Étape 1: Vérification des données résiduelles\n";
    
    // Vérifier s'il reste des données orphelines
    $conflicts = [];
    
    // 1. Vérifier les utilisateurs avec tenant_id qui n'existent plus
    $stmt = $pdo->query("
        SELECT u.id, u.name, u.email, u.tenant_id 
        FROM users u 
        LEFT JOIN tenants t ON u.tenant_id = t.id 
        WHERE u.tenant_id IS NOT NULL AND t.id IS NULL
    ");
    $orphanUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($orphanUsers) > 0) {
        $conflicts['orphan_users'] = $orphanUsers;
        echo "   ⚠️  Utilisateurs orphelins trouvés: " . count($orphanUsers) . "\n";
        foreach ($orphanUsers as $u) {
            echo "     - User ID " . $u['id'] . " (" . $u['name'] . ") - Tenant ID " . $u['tenant_id'] . " (inexistant)\n";
        }
    }
    
    // 2. Vérifier les customers avec tenant_id qui n'existent plus
    $stmt = $pdo->query("
        SELECT c.id, c.name, c.email, c.tenant_id 
        FROM customers c 
        LEFT JOIN tenants t ON c.tenant_id = t.id 
        WHERE c.tenant_id IS NOT NULL AND t.id IS NULL
    ");
    $orphanCustomers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($orphanCustomers) > 0) {
        $conflicts['orphan_customers'] = $orphanCustomers;
        echo "   ⚠️  Customers orphelins trouvés: " . count($orphanCustomers) . "\n";
        foreach ($orphanCustomers as $c) {
            echo "     - Customer ID " . $c['id'] . " (" . $c['name'] . ") - Tenant ID " . $c['tenant_id'] . " (inexistant)\n";
        }
    }
    
    // 3. Vérifier les rooms avec tenant_id qui n'existent plus
    $stmt = $pdo->query("
        SELECT r.id, r.name, r.tenant_id 
        FROM rooms r 
        LEFT JOIN tenants t ON r.tenant_id = t.id 
        WHERE r.tenant_id IS NOT NULL AND t.id IS NULL
    ");
    $orphanRooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($orphanRooms) > 0) {
        $conflicts['orphan_rooms'] = $orphanRooms;
        echo "   ⚠️  Chambres orphelines trouvées: " . count($orphanRooms) . "\n";
        foreach ($orphanRooms as $r) {
            echo "     - Room ID " . $r['id'] . " (" . $r['name'] . ") - Tenant ID " . $r['tenant_id'] . " (inexistant)\n";
        }
    }
    
    // 4. Vérifier les transactions avec tenant_id qui n'existent plus
    $stmt = $pdo->query("
        SELECT tr.id, tr.status, tr.tenant_id 
        FROM transactions tr 
        LEFT JOIN tenants t ON tr.tenant_id = t.id 
        WHERE tr.tenant_id IS NOT NULL AND t.id IS NULL
    ");
    $orphanTransactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($orphanTransactions) > 0) {
        $conflicts['orphan_transactions'] = $orphanTransactions;
        echo "   ⚠️  Transactions orphelines trouvées: " . count($orphanTransactions) . "\n";
        foreach ($orphanTransactions as $t) {
            echo "     - Transaction ID " . $t['id'] . " (" . $t['status'] . ") - Tenant ID " . $t['tenant_id'] . " (inexistant)\n";
        }
    }
    
    if (empty($conflicts)) {
        echo "   ✅ Aucun conflit trouvé\n";
    }
    
    echo "\n📋 Étape 2: Nettoyage des conflits\n";
    
    if (!empty($conflicts)) {
        // Désactiver les contraintes temporairement
        echo "   📝 Désactivation des contraintes de clé étrangère...\n";
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
        
        // Nettoyer chaque type de conflit
        if (isset($conflicts['orphan_users'])) {
            foreach ($conflicts['orphan_users'] as $user) {
                $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                $stmt->execute([$user['id']]);
                echo "   ✅ User ID " . $user['id'] . " supprimé\n";
            }
        }
        
        if (isset($conflicts['orphan_customers'])) {
            foreach ($conflicts['orphan_customers'] as $customer) {
                $stmt = $pdo->prepare("DELETE FROM customers WHERE id = ?");
                $stmt->execute([$customer['id']]);
                echo "   ✅ Customer ID " . $customer['id'] . " supprimé\n";
            }
        }
        
        if (isset($conflicts['orphan_rooms'])) {
            foreach ($conflicts['orphan_rooms'] as $room) {
                $stmt = $pdo->prepare("DELETE FROM rooms WHERE id = ?");
                $stmt->execute([$room['id']]);
                echo "   ✅ Room ID " . $room['id'] . " supprimée\n";
            }
        }
        
        if (isset($conflicts['orphan_transactions'])) {
            foreach ($conflicts['orphan_transactions'] as $transaction) {
                $stmt = $pdo->prepare("DELETE FROM transactions WHERE id = ?");
                $stmt->execute([$transaction['id']]);
                echo "   ✅ Transaction ID " . $transaction['id'] . " supprimée\n";
            }
        }
        
        // Réactiver les contraintes
        echo "   📝 Réactivation des contraintes de clé étrangère...\n";
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
        
        echo "   ✅ Nettoyage des conflits terminé\n";
    }
    
    echo "\n📋 Étape 3: Vérification de l'état actuel\n";
    
    // Vérifier les tenants actifs
    $stmt = $pdo->query("SELECT id, name, subdomain, is_active FROM tenants ORDER BY id");
    $tenants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "   Tenants actifs:\n";
    foreach ($tenants as $t) {
        $status = $t['is_active'] ? 'ACTIF' : 'INACTIF';
        echo "   - ID: " . $t['id'] . " | " . $t['name'] . " (" . $t['subdomain'] . ") - " . $status . "\n";
    }
    
    // Vérifier l'utilisateur que nous avons créé
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND tenant_id = ?");
    $stmt->execute(['majorelle.tenant64@morada-management.com', 64]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo "\n   ✅ Utilisateur pour tenant 64 trouvé:\n";
        echo "     - ID: " . $user['id'] . "\n";
        echo "     - Nom: " . $user['name'] . "\n";
        echo "     - Email: " . $user['email'] . "\n";
        echo "     - Tenant ID: " . $user['tenant_id'] . "\n";
        echo "     - Actif: " . ($user['is_active'] ? 'Oui' : 'Non') . "\n";
    } else {
        echo "\n   ❌ Utilisateur pour tenant 64 non trouvé\n";
    }
    
    echo "\n📋 Étape 4: Test des clés étrangères\n";
    
    // Tester si les contraintes fonctionnent
    try {
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
        echo "   ✅ Contraintes de clé étrangère activées\n";
        
        // Tenter une opération simple
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM users WHERE tenant_id = 64");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "   ✅ Utilisateurs dans tenant 64: " . $count . "\n";
        
    } catch (Exception $e) {
        echo "   ❌ Erreur avec les contraintes: " . $e->getMessage() . "\n";
    }
    
    echo "\n🎯 Actions recommandées:\n";
    echo "1. Videz complètement le cache du navigateur\n";
    echo "2. Fermez et rouvrez le navigateur\n";
    echo "3. Connectez-vous avec: majorelle.tenant64@morada-management.com\n";
    echo "4. Mot de passe: password123\n";
    echo "5. Accédez à: http://127.0.0.1:8000/transaction/reservation/createIdentity\n";
    
    echo "\n🎉 Nettoyage terminé ! La base de données devrait être propre.\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    
    // Essayer de réactiver les contraintes en cas d'erreur
    try {
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
        echo "🔧 Contraintes de clé étrangère réactivées\n";
    } catch (Exception $e2) {
        echo "⚠️  Impossible de réactiver les contraintes: " . $e2->getMessage() . "\n";
    }
}

?>
