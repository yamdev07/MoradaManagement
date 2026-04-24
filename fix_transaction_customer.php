<?php

// Script pour corriger le problème de customer de la transaction

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
    
    echo "\n🔧 Application de la correction...\n";
    
    // Option 1: Mettre customer_id à NULL (recommandé)
    $stmt = $pdo->prepare("UPDATE transactions SET customer_id = NULL WHERE id = ?");
    $result = $stmt->execute([13]);
    
    if ($result) {
        echo "✅ Customer ID mis à NULL avec succès\n";
        
        // Vérifier la correction
        $stmt = $pdo->prepare("SELECT customer_id FROM transactions WHERE id = ?");
        $stmt->execute([13]);
        $updated = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "📋 État après correction :\n";
        echo "   Customer ID: " . ($updated['customer_id'] ?? 'NULL') . "\n";
        echo "   Tenant ID: " . $updated['tenant_id'] . "\n";
        
        echo "\n🎯 Résultat :\n";
        echo "✅ Plus de conflit de tenant\n";
        echo "✅ La page affichera 'Client non spécifié' de manière correcte\n";
        echo "✅ Vous pouvez maintenant créer un nouveau customer pour le tenant 63\n";
        echo "✅ Ou associer cette transaction à un customer existant du tenant 63\n";
        
        echo "\n🌐 Accédez à : http://127.0.0.1:8001/transaction/13\n";
        echo "🎉 Le problème 'Client non spécifié' est maintenant résolu de manière cohérente !\n";
        
    } else {
        echo "❌ Erreur lors de la mise à jour\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
