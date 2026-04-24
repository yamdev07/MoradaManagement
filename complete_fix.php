<?php

// Solution complète pour résoudre tous les conflits

echo "🔧 Solution complète des conflits de réservation\n\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 Étape 1: Désactiver les contraintes temporairement\n";
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    echo "✅ Contraintes désactivées\n";
    
    $problemEmail = 'majorelle@gmail.com';
    
    echo "\n📋 Étape 2: Mettre à NULL les transactions liées à l'ancien customer\n";
    
    // Récupérer l'ID du customer avec l'email problématique
    $stmt = $pdo->prepare("SELECT id FROM customers WHERE email = ?");
    $stmt->execute([$problemEmail]);
    $oldCustomerId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    
    if ($oldCustomerId) {
        echo "   Ancien customer ID: " . $oldCustomerId . "\n";
        
        // Mettre à NULL les transactions
        $stmt = $pdo->prepare("UPDATE transactions SET customer_id = NULL WHERE customer_id = ?");
        $stmt->execute([$oldCustomerId]);
        $updatedCount = $stmt->rowCount();
        echo "   ✅ " . $updatedCount . " transaction(s) mise(s) à NULL\n";
        
        // Supprimer l'ancien customer
        $stmt = $pdo->prepare("DELETE FROM customers WHERE id = ?");
        $stmt->execute([$oldCustomerId]);
        echo "   ✅ Ancien customer supprimé\n";
    }
    
    echo "\n📋 Étape 3: Réactiver les contraintes\n";
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    echo "✅ Contraintes réactivées\n";
    
    echo "\n📋 Étape 4: Vérification finale\n";
    
    // Vérifier l'état final
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM users WHERE email = ?");
    $stmt->execute([$problemEmail]);
    $userCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM customers WHERE email = ?");
    $stmt->execute([$problemEmail]);
    $customerCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "   Users avec cet email: " . $userCount . "\n";
    echo "   Customers avec cet email: " . $customerCount . "\n";
    
    // Vérifier s'il y a des transactions avec customer_id = NULL
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM transactions WHERE customer_id IS NULL");
    $nullCustomerCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "   Transactions avec customer_id = NULL: " . $nullCustomerCount . "\n";
    
    if ($userCount > 0 && $customerCount == 0) {
        echo "✅ Conflit résolu avec succès !\n";
        echo "   L'email n'existe que dans la table users\n";
        echo "   Plus de risque de contrainte d'unicité\n";
        echo "   Les transactions problématiques ont été nettoyées\n";
    }
    
    echo "\n🎉 SOLUTION TERMINÉE !\n";
    echo "📝 Le problème de réservation devrait maintenant être résolu\n";
    echo "\n🎯 Instructions finales:\n";
    echo "1. Connectez-vous avec: majorelle.tenant64@morada-management.com / password123\n";
    echo "2. Allez à: http://127.0.0.1:8000/transaction/reservation/createIdentity\n";
    echo "3. Créez un nouveau customer (avec n'importe quel email)\n";
    echo "4. La page devrait fonctionner sans erreur\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    
    // Essayer de réactiver les contraintes en cas d'erreur
    try {
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
        echo "🔧 Contraintes réactivées (tentative de récupération)\n";
    } catch (Exception $e2) {
        echo "⚠️  Impossible de réactiver les contraintes: " . $e2->getMessage() . "\n";
    }
}

?>
