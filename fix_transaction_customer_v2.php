<?php

// Script pour corriger le problème de customer de la transaction (version 2)

echo "🔧 Correction du problème de customer pour la transaction ID 13\n\n";

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 État actuel de la transaction ID 13 :\n";
    
    // Vérifier l'état actuel
    $stmt = $pdo->prepare("SELECT id, customer_id, tenant_id FROM transactions WHERE id = ?");
    $stmt->execute([13]);
    $transaction = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$transaction) {
        echo "❌ Transaction ID 13 non trouvée\n";
        exit;
    }
    
    echo "   Customer ID actuel: " . ($transaction['customer_id'] ?? 'NULL') . "\n";
    echo "   Tenant ID: " . $transaction['tenant_id'] . "\n";
    
    // Vérifier le customer actuel
    if ($transaction['customer_id']) {
        $stmt = $pdo->prepare("SELECT name, email, tenant_id FROM customers WHERE id = ?");
        $stmt->execute([$transaction['customer_id']]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($customer) {
            echo "   Customer actuel: " . $customer['name'] . " (Tenant ID: " . $customer['tenant_id'] . ")\n";
            echo "   ❌ CONFLIT: Customer ID " . $transaction['customer_id'] . " appartient au tenant " . $customer['tenant_id'] . " mais la transaction appartient au tenant " . $transaction['tenant_id'] . "\n";
        }
    }
    
    echo "\n🔧 Solution : Créer un customer pour le tenant 63\n";
    
    // Vérifier si le customer existe déjà pour le tenant 63
    $stmt = $pdo->prepare("SELECT id FROM customers WHERE email = ? AND tenant_id = ?");
    $stmt->execute(['majorelle@gmail.com', 63]);
    $existingCustomer = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existingCustomer) {
        echo "✅ Customer trouvé pour le tenant 63 (ID: " . $existingCustomer['id'] . ")\n";
        
        // Mettre à jour la transaction avec le bon customer
        $stmt = $pdo->prepare("UPDATE transactions SET customer_id = ? WHERE id = ?");
        $result = $stmt->execute([$existingCustomer['id'], 13]);
        
        if ($result) {
            echo "✅ Transaction mise à jour avec le customer ID " . $existingCustomer['id'] . "\n";
        } else {
            echo "❌ Erreur lors de la mise à jour de la transaction\n";
        }
    } else {
        echo "📝 Création d'un nouveau customer pour le tenant 63\n";
        
        // Créer le customer pour le tenant 63
        $stmt = $pdo->prepare("INSERT INTO customers (name, email, phone, tenant_id, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
        $result = $stmt->execute(['milca VODUNON', 'majorelle@gmail.com', '+22945665432', 63]);
        
        if ($result) {
            $newCustomerId = $pdo->lastInsertId();
            echo "✅ Nouveau customer créé (ID: " . $newCustomerId . ")\n";
            
            // Mettre à jour la transaction
            $stmt = $pdo->prepare("UPDATE transactions SET customer_id = ? WHERE id = ?");
            $result = $stmt->execute([$newCustomerId, 13]);
            
            if ($result) {
                echo "✅ Transaction mise à jour avec le nouveau customer ID " . $newCustomerId . "\n";
            } else {
                echo "❌ Erreur lors de la mise à jour de la transaction\n";
            }
        } else {
            echo "❌ Erreur lors de la création du customer\n";
        }
    }
    
    // Vérifier le résultat final
    echo "\n📋 Vérification finale :\n";
    $stmt = $pdo->prepare("SELECT t.customer_id, c.name, c.email, t.tenant_id FROM transactions t LEFT JOIN customers c ON t.customer_id = c.id WHERE t.id = ?");
    $stmt->execute([13]);
    $final = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($final) {
        echo "   Customer ID: " . $final['customer_id'] . "\n";
        echo "   Customer Name: " . ($final['name'] ?? 'Client non spécifié') . "\n";
        echo "   Customer Email: " . ($final['email'] ?? 'Non spécifié') . "\n";
        echo "   Tenant ID: " . $final['tenant_id'] . "\n";
        
        if ($final['name']) {
            echo "\n🎉 SUCCÈS ! Le problème est résolu !\n";
            echo "✅ Le customer 'milca VODUNON' est maintenant correctement associé au tenant 63\n";
            echo "✅ La page affichera correctement les informations du client\n";
            echo "🌐 Accédez à : http://127.0.0.1:8001/transaction/13\n";
        } else {
            echo "\n❌ Le problème persiste - customer toujours non trouvé\n";
        }
    } else {
        echo "❌ Impossible de vérifier le résultat final\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
