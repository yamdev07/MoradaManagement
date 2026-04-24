<?php

// Script pour vérifier et gérer les contraintes de clé étrangère

echo "🔍 Vérification des contraintes de clé étrangère\n\n";

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 Recherche des transactions utilisant le customer...\n";
    
    // Chercher les transactions qui utilisent des customers
    $stmt = $pdo->query("
        SELECT 
            t.id as transaction_id,
            t.customer_id,
            t.status,
            t.check_in,
            t.check_out,
            c.name as customer_name,
            c.email as customer_email,
            c.tenant_id as customer_tenant_id
        FROM transactions t
        LEFT JOIN customers c ON t.customer_id = c.id
        WHERE t.customer_id IS NOT NULL
        ORDER BY t.id DESC
        LIMIT 20
    ");
    
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($transactions) > 0) {
        echo "📊 Transactions trouvées :\n\n";
        foreach ($transactions as $t) {
            echo "🔸 Transaction ID: " . $t['transaction_id'] . "\n";
            echo "   Customer ID: " . $t['customer_id'] . "\n";
            echo "   Customer: " . ($t['customer_name'] ?? 'NON TROUVÉ') . "\n";
            echo "   Email: " . ($t['customer_email'] ?? 'NON TROUVÉ') . "\n";
            echo "   Status: " . $t['status'] . "\n";
            echo "   Dates: " . $t['check_in'] . " → " . $t['check_out'] . "\n";
            echo "   Tenant ID: " . $t['customer_tenant_id'] . "\n";
            echo "   ⚠️  " . ($t['customer_name'] ? 'Customer trouvé' : 'CUSTOMER MANQUANT - PROBLÈME !') . "\n";
            echo "\n";
        }
    } else {
        echo "✅ Aucune transaction avec customer_id trouvé\n";
    }
    
    echo "\n🔍 Vérification des customers orphelins...\n";
    
    // Chercher les customers qui n'existent plus mais sont utilisés dans des transactions
    $stmt = $pdo->query("
        SELECT DISTINCT t.customer_id
        FROM transactions t
        WHERE t.customer_id IS NOT NULL
        AND t.customer_id NOT IN (SELECT id FROM customers)
    ");
    
    $orphanCustomers = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (count($orphanCustomers) > 0) {
        echo "⚠️  Customers orphelins trouvés (utilisés dans transactions mais n'existent plus) :\n";
        foreach ($orphanCustomers as $customerId) {
            echo "   - Customer ID: " . $customerId . "\n";
        }
        
        echo "\n🔧 Solutions possibles :\n";
        echo "1. Mettre à NULL les customer_id orphelins dans les transactions\n";
        echo "2. Créer des customers de remplacement pour les IDs manquants\n";
        echo "3. Supprimer les transactions concernées (DANGEREUX)\n";
        
        echo "\n💡 Solution recommandée : Mettre à NULL les customer_id orphelins\n";
        echo "Cela affichera 'Client non spécifié' au lieu de causer des erreurs.\n";
        
        // Appliquer la correction automatiquement
        echo "\n🔧 Application de la correction automatique...\n";
        
        foreach ($orphanCustomers as $customerId) {
            $stmt = $pdo->prepare("UPDATE transactions SET customer_id = NULL WHERE customer_id = ?");
            $result = $stmt->execute([$customerId]);
            
            if ($result) {
                $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM transactions WHERE customer_id = ?");
                $stmt->execute([$customerId]);
                $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
                
                echo "✅ Customer ID " . $customerId . " - " . $count . " transaction(s) mise(s) à NULL\n";
            }
        }
        
        echo "\n🎉 Correction terminée ! Les contraintes de clé étrangère sont maintenant résolues.\n";
        
    } else {
        echo "✅ Aucun customer orphelin trouvé\n";
    }
    
    echo "\n📋 Statistiques finales :\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM transactions WHERE customer_id IS NOT NULL");
    $withCustomer = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM transactions WHERE customer_id IS NULL");
    $withoutCustomer = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    echo "   Transactions avec customer: " . $withCustomer . "\n";
    echo "   Transactions sans customer: " . $withoutCustomer . "\n";
    echo "   Total transactions: " . ($withCustomer + $withoutCustomer) . "\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
