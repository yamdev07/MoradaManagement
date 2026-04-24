<?php

// Analyse du code du contrôleur pour trouver le bug

echo "🔍 Analyse du code du contrôleur TransactionRoomReservationController\n\n";

try {
    $controllerFile = 'app/Http/Controllers/TransactionRoomReservationController.php';
    $content = file_get_contents($controllerFile);
    
    if (!$content) {
        echo "❌ Impossible de lire le fichier du contrôleur\n";
        exit;
    }
    
    echo "📋 Recherche des appels à User::create ou User::insert\n";
    
    // Chercher les lignes problématiques
    $lines = explode("\n", $content);
    $problemLines = [];
    
    foreach ($lines as $lineNumber => $line) {
        // Chercher les appels à User::create
        if (strpos($line, 'User::create') !== false) {
            $problemLines[] = "Ligne " . ($lineNumber + 1) . ": " . trim($line);
        }
        
        // Chercher les appels à User::insert
        if (strpos($line, 'User::insert') !== false) {
            $problemLines[] = "Ligne " . ($lineNumber + 1) . ": " . trim($line);
        }
        
        // Chercher les appels à \App\Models\User::
        if (strpos($line, '\App\Models\User::') !== false) {
            $problemLines[] = "Ligne " . ($lineNumber + 1) . ": " . trim($line);
        }
        
        // Chercher les insertions dans la table users
        if (strpos($line, 'users`') !== false && strpos($line, 'insert into') !== false) {
            $problemLines[] = "Ligne " . ($lineNumber + 1) . ": " . trim($line);
        }
    }
    
    if (!empty($problemLines)) {
        echo "⚠️  Lignes problématiques trouvées:\n";
        foreach ($problemLines as $problemLine) {
            echo "   " . $problemLine . "\n";
        }
    } else {
        echo "✅ Aucune ligne problématique trouvée (pas d'appel direct à User::create)\n";
    }
    
    echo "\n📋 Vérification de la méthode storeCustomer\n";
    
    // Chercher la méthode storeCustomer
    $storeCustomerFound = false;
    $inStoreCustomer = false;
    
    foreach ($lines as $lineNumber => $line) {
        if (strpos($line, 'public function storeCustomer') !== false) {
            $storeCustomerFound = true;
            $inStoreCustomer = true;
        }
        
        if ($inStoreCustomer && strpos($line, '}') !== false && strpos($line, 'function') === false) {
            $inStoreCustomer = false;
        }
        
        if ($inStoreCustomer) {
            // Vérifier si cette ligne contient un appel problématique
            if (strpos($line, 'User::create') !== false || 
                strpos($line, 'User::insert') !== false ||
                strpos($line, '\App\Models\User::') !== false) {
                
                echo "⚠️  Ligne " . ($lineNumber + 1) . " dans storeCustomer: " . trim($line) . "\n";
            }
        }
    }
    
    if (!$storeCustomerFound) {
        echo "❌ Méthode storeCustomer NON trouvée\n";
    }
    
    echo "\n📋 Recherche des erreurs de logique\n";
    
    // Vérifier les variables utilisées dans storeCustomer
    foreach ($lines as $lineNumber => $line) {
        if ($inStoreCustomer && strpos($line, '$customerData') !== false) {
            echo "📝 Ligne " . ($lineNumber + 1) . ": " . trim($line) . "\n";
        }
        
        if ($inStoreCustomer && strpos($line, 'Customer::create') !== false) {
            echo "✅ Ligne " . ($lineNumber + 1) . ": " . trim($line) . "\n";
        }
    }
    
    echo "\n🎯 Conclusion:\n";
    echo "Si des lignes problématiques sont trouvées au-dessus,\n";
    echo "c'est là que se trouve le bug.\n";
    echo "Sinon, le problème pourrait être:\n";
    echo "1. Dans un middleware ou une autre partie du code\n";
    echo "2. Dans une relation ou un événement de modèle\n";
    echo "3. Dans un observer ou un listener\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
