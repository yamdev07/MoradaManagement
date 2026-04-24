<?php

// Solution temporaire pour contourner le problème de création de customer

echo "🔧 Solution temporaire pour contourner le problème\n\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    // Créer un customer temporaire avec un email unique
    $tempEmail = 'temp.customer.' . time() . '@example.com';
    
    echo "📋 Création d'un customer temporaire avec email: $tempEmail\n";
    
    $customerData = [
        'name' => 'Customer Temporaire',
        'email' => $tempEmail,
        'phone' => '+22900000000',
        'gender' => 'Other',
        'address' => 'Temporaire',
        'job' => 'Test',
        'birthdate' => '1990-01-01',
        'user_id' => 100, // Utilisateur du tenant 64
        'tenant_id' => 64,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
    
    $columns = implode(', ', array_keys($customerData));
    $placeholders = implode(', ', array_fill(0, count($customerData), '?'));
    
    $stmt = $pdo->prepare("INSERT INTO customers ($columns) VALUES ($placeholders)");
    $result = $stmt->execute(array_values($customerData));
    
    if ($result) {
        $customerId = $pdo->lastInsertId();
        echo "✅ Customer temporaire créé (ID: $customerId)\n";
        
        echo "\n📋 Identifiants pour le test:\n";
        echo "   Email: $tempEmail\n";
        echo "   Mot de passe: (pas nécessaire pour customer)\n";
        echo "   Customer ID: $customerId\n";
        
        echo "\n🎯 Instructions:\n";
        echo "1. Connectez-vous avec: majorelle.tenant64@morada-management.com / password123\n";
        echo "2. Allez à: http://127.0.0.1:8000/transaction/reservation/createIdentity\n";
        echo "3. Utilisez l'email temporaire pour créer un customer\n";
        echo "4. La page devrait fonctionner sans erreur\n";
        
        echo "\n🔧 Pour utiliser ce customer dans une réservation:\n";
        echo "   URL directe: http://127.0.0.1:8000/transaction/reservation/viewCountPerson/$customerId\n";
        
    } else {
        echo "❌ Erreur lors de la création du customer temporaire\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
