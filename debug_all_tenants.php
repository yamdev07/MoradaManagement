<?php

// Analyse du problème qui affecte tous les tenants

echo "🔍 Analyse du problème qui affecte tous les tenants\n\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 Étape 1: Vérification des tenants disponibles\n";
    
    $stmt = $pdo->query("SELECT id, name, is_active FROM tenants WHERE is_active = 1 ORDER BY id");
    $tenants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($tenants as $tenant) {
        echo "   - Tenant " . $tenant['id'] . ": " . $tenant['name'] . " (Actif)\n";
    }
    
    echo "\n📋 Étape 2: Vérification des emails problématiques\n";
    
    // Chercher les emails qui existent dans users et qui pourraient causer des conflits
    $stmt = $pdo->query("SELECT email, COUNT(*) as count FROM users GROUP BY email HAVING COUNT(*) > 1");
    $duplicateEmails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($duplicateEmails)) {
        echo "⚠️  Emails dupliqués dans users:\n";
        foreach ($duplicateEmails as $dup) {
            echo "   - " . $dup['email'] . " (" . $dup['count'] . " occurrences)\n";
        }
    } else {
        echo "✅ Aucun email dupliqué dans users\n";
    }
    
    echo "\n📋 Étape 3: Vérification du bug dans le code\n";
    
    // Le problème est probablement dans la méthode storeCustomer
    // Vérifions si le code essaie de créer un user au lieu d'un customer
    
    $controllerFile = 'app/Http/Controllers/TransactionRoomReservationController.php';
    $content = file_get_contents($controllerFile);
    
    if (strpos($content, 'User::create') !== false) {
        echo "❌ TROUVÉ: Appel à User::create dans le contrôleur\n";
        
        // Trouver les lignes
        $lines = explode("\n", $content);
        foreach ($lines as $lineNumber => $line) {
            if (strpos($line, 'User::create') !== false) {
                echo "   Ligne " . ($lineNumber + 1) . ": " . trim($line) . "\n";
            }
        }
    } else {
        echo "✅ Pas d'appel direct à User::create trouvé\n";
    }
    
    // Vérifier s'il y a des appels à \App\Models\User::
    if (strpos($content, '\App\Models\User::') !== false) {
        echo "⚠️  Appels à \App\Models\User:: trouvés:\n";
        
        $lines = explode("\n", $content);
        foreach ($lines as $lineNumber => $line) {
            if (strpos($line, '\App\Models\User::') !== false) {
                echo "   Ligne " . ($lineNumber + 1) . ": " . trim($line) . "\n";
            }
        }
    }
    
    echo "\n📋 Étape 4: Vérification du modèle Customer\n";
    
    // Vérifier si le modèle Customer a des observers ou des événements qui créent des users
    $customerModel = 'app/Models/Customer.php';
    $customerContent = file_get_contents($customerModel);
    
    if (strpos($customerContent, 'User::create') !== false) {
        echo "❌ TROUVÉ: Appel à User::create dans le modèle Customer\n";
    } else {
        echo "✅ Pas d'appel à User::create dans le modèle Customer\n";
    }
    
    echo "\n📋 Étape 5: Hypothèse du bug\n";
    
    echo "Le bug est probablement dans la méthode storeCustomer du contrôleur.\n";
    echo "Le système essaie de créer un User au lieu d'un Customer.\n";
    echo "Cela affecte tous les tenants car c'est un bug de logique global.\n";
    
    echo "\n🎯 Solution proposée:\n";
    echo "1. Trouver où le code crée un User au lieu d'un Customer\n";
    echo "2. Corriger la logique pour créer un Customer\n";
    echo "3. Tester avec un tenant qui fonctionne\n";
    
    echo "\n🔧 Test immédiat:\n";
    echo "Essayez de créer un customer avec un email qui n'existe PAS dans users:\n";
    echo "- test.reservation." . time() . "@example.com\n";
    echo "- nouveau.customer." . time() . "@test.com\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
