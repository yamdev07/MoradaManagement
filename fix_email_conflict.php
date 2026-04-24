<?php

// Script pour résoudre le conflit d'email entre users et customers

echo "🔧 Résolution du conflit d'email entre users et customers\n\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    $problemEmail = 'majorelle@gmail.com';
    
    echo "📋 Recherche du conflit pour l'email: $problemEmail\n";
    
    // Vérifier si l'email existe dans users
    $stmt = $pdo->prepare("SELECT id, name, email FROM users WHERE email = ?");
    $stmt->execute([$problemEmail]);
    $userWithEmail = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($userWithEmail) {
        echo "⚠️  Email trouvé dans la table users:\n";
        echo "   - User ID: " . $userWithEmail['id'] . "\n";
        echo "   - Nom: " . $userWithEmail['name'] . "\n";
        echo "   - Email: " . $userWithEmail['email'] . "\n";
        
        // Vérifier si l'email existe aussi dans customers
        $stmt = $pdo->prepare("SELECT id, name, email FROM customers WHERE email = ?");
        $stmt->execute([$problemEmail]);
        $customerWithEmail = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($customerWithEmail) {
            echo "⚠️  Email trouvé aussi dans la table customers:\n";
            echo "   - Customer ID: " . $customerWithEmail['id'] . "\n";
            echo "   - Nom: " . $customerWithEmail['name'] . "\n";
            echo "   - Email: " . $customerWithEmail['email'] . "\n";
            
            echo "\n🔧 Solution: Supprimer l'ancien customer et conserver l'user\n";
            
            // Supprimer l'ancien customer
            $stmt = $pdo->prepare("DELETE FROM customers WHERE email = ?");
            $stmt->execute([$problemEmail]);
            echo "✅ Ancien customer supprimé\n";
            
        } else {
            echo "✅ Email non trouvé dans customers, pas de conflit\n";
        }
        
        // Vérifier s'il y a des transactions liées à l'ancien customer
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM transactions WHERE customer_id IN (SELECT id FROM customers WHERE email = ?)");
        $stmt->execute([$problemEmail]);
        $transactionCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        if ($transactionCount > 0) {
            echo "⚠️  " . $transactionCount . " transaction(s) liée(s) à l'ancien customer\n";
            echo "   Ces transactions auront customer_id = NULL\n";
            
            // Mettre à NULL les customer_id pour les transactions liées à l'email supprimé
            $stmt = $pdo->prepare("UPDATE transactions SET customer_id = NULL WHERE customer_id IN (SELECT id FROM customers WHERE email = ?)");
            $stmt->execute([$problemEmail]);
            echo "✅ Transactions mises à jour\n";
        }
        
    } else {
        echo "✅ Email non trouvé dans la table users\n";
    }
    
    echo "\n📋 Vérification finale:\n";
    
    // Vérifier l'état actuel
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM users WHERE email = ?");
    $stmt->execute([$problemEmail]);
    $userCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM customers WHERE email = ?");
    $stmt->execute([$problemEmail]);
    $customerCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "   Users avec cet email: " . $userCount . "\n";
    echo "   Customers avec cet email: " . $customerCount . "\n";
    
    if ($userCount > 0 && $customerCount == 0) {
        echo "✅ Conflit résolu !\n";
        echo "   L'email n'existe que dans la table users\n";
        echo "   Plus de risque de contrainte d'unicité\n";
    }
    
    echo "\n🎯 Instructions finales:\n";
    echo "1. Connectez-vous avec: majorelle.tenant64@morada-management.com / password123\n";
    echo "2. Allez à: http://127.0.0.1:8000/transaction/reservation/createIdentity\n";
    echo "3. Essayez de créer un customer avec l'email: majorelle@gmail.com\n";
    echo "4. Ça devrait maintenant fonctionner sans erreur\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
