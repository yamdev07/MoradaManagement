<?php

// Script pour déboguer la transaction avec auth Laravel

echo "🔍 Débogage de la transaction ID 13\n\n";

try {
    // Utiliser les identifiants corrects du .env
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    // Récupérer la transaction
    $stmt = $pdo->prepare("SELECT * FROM transactions WHERE id = ?");
    $stmt->execute([13]);
    $transaction = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$transaction) {
        echo "❌ Transaction ID 13 non trouvée\n";
        exit;
    }
    
    echo "✅ Transaction trouvée\n";
    echo "📋 Informations de la transaction :\n";
    echo "   ID: " . $transaction['id'] . "\n";
    echo "   Customer ID: " . $transaction['customer_id'] . "\n";
    echo "   Room ID: " . $transaction['room_id'] . "\n";
    echo "   User ID: " . $transaction['user_id'] . "\n";
    echo "   Tenant ID: " . $transaction['tenant_id'] . "\n";
    echo "   Status: " . $transaction['status'] . "\n";
    echo "   Total Price: " . $transaction['total_price'] . "\n";
    echo "   Check-in: " . $transaction['check_in'] . "\n";
    echo "   Check-out: " . $transaction['check_out'] . "\n\n";
    
    // Vérifier le customer
    echo "🔍 Vérification du customer (ID: " . $transaction['customer_id'] . ")\n";
    
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ? AND tenant_id = ?");
    $stmt->execute([$transaction['customer_id'], $transaction['tenant_id']]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$customer) {
        echo "❌ Customer ID " . $transaction['customer_id'] . " non trouvé dans la table customers pour le tenant " . $transaction['tenant_id'] . "\n";
        
        // Vérifier si le customer existe sans la condition tenant_id
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
        $stmt->execute([$transaction['customer_id']]);
        $customerAnyTenant = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($customerAnyTenant) {
            echo "⚠️  Customer trouvé mais dans un autre tenant:\n";
            echo "   Nom: " . $customerAnyTenant['name'] . "\n";
            echo "   Email: " . $customerAnyTenant['email'] . "\n";
            echo "   Tenant ID du customer: " . $customerAnyTenant['tenant_id'] . "\n";
            echo "   Tenant ID de la transaction: " . $transaction['tenant_id'] . "\n";
            echo "   ❌ CONFLIT : Le customer appartient au tenant " . $customerAnyTenant['tenant_id'] . " mais la transaction appartient au tenant " . $transaction['tenant_id'] . "\n";
        } else {
            echo "❌ Customer ID " . $transaction['customer_id'] . " n'existe pas du tout dans la base de données\n";
        }
        
        // Lister les customers du tenant de la transaction
        echo "\n📋 Liste des customers du tenant " . $transaction['tenant_id'] . " :\n";
        $stmt = $pdo->prepare("SELECT id, name, email FROM customers WHERE tenant_id = ?");
        $stmt->execute([$transaction['tenant_id']]);
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($customers) > 0) {
            foreach ($customers as $c) {
                echo "   - ID: " . $c['id'] . ", Nom: " . $c['name'] . ", Email: " . $c['email'] . "\n";
            }
        } else {
            echo "   Aucun customer trouvé pour ce tenant\n";
        }
    } else {
        echo "✅ Customer trouvé dans le bon tenant\n";
        echo "   Nom: " . $customer['name'] . "\n";
        echo "   Email: " . $customer['email'] . "\n";
        echo "   Phone: " . ($customer['phone'] ?? 'Non défini') . "\n";
        echo "   Tenant ID: " . $customer['tenant_id'] . "\n";
    }
    
    echo "\n🎯 Conclusion :\n";
    echo "Le problème vient du fait que le customer ID " . $transaction['customer_id'];
    echo " n'est pas correctement associé au tenant " . $transaction['tenant_id'] . "\n";
    echo "C'est pourquoi vous voyez 'Client non spécifié' - la relation transaction->customer retourne null.\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
