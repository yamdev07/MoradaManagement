<?php

// Vérification de l'erreur actuelle en temps réel

echo "🔍 Vérification de l'erreur actuelle\n\n";

try {
    $logFile = 'storage/logs/laravel.log';
    
    if (file_exists($logFile)) {
        // Lire les 10 dernières lignes du log
        $lines = file($logFile);
        $totalLines = count($lines);
        
        echo "📋 Dernières lignes du log:\n";
        
        // Afficher les 10 dernières lignes
        for ($i = $totalLines - 1; $i >= max(0, $totalLines - 10); $i--) {
            $line = trim($lines[$i]);
            
            // Surligner les erreurs
            if (strpos($line, 'ERROR') !== false || 
                strpos($line, 'Exception') !== false || 
                strpos($line, 'Fatal') !== false) {
                
                echo "🔴 " . $line . "\n";
            } elseif (strpos($line, 'WARNING') !== false) {
                echo "🟡 " . $line . "\n";
            } else {
                echo "📝 " . $line . "\n";
            }
        }
        
        echo "\n🎯 Analyse rapide:\n";
        
        // Chercher les erreurs spécifiques
        $recentLines = array_slice($lines, -10);
        $logContent = implode(' ', $recentLines);
        
        if (strpos($logContent, 'duplicate entry') !== false) {
            echo "❌ Problème de contrainte d'unicité détecté\n";
        }
        
        if (strpos($logContent, 'base de données') !== false) {
            echo "❌ Erreur de base de données détectée\n";
        }
        
        if (strpos($logContent, 'createIdentity') !== false) {
            echo "✅ Appel à createIdentity détecté\n";
        }
        
        if (strpos($logContent, 'storeCustomer') !== false) {
            echo "✅ Appel à storeCustomer détecté\n";
        }
        
    } else {
        echo "❌ Fichier de log NON trouvé\n";
    }
    
    echo "\n🔧 Actions recommandées:\n";
    echo "1. Connectez-vous avec: majorelle.tenant64@morada-management.com / password123\n";
    echo "2. Allez à: http://127.0.0.1:8000/transaction/reservation/createIdentity\n";
    echo "3. Regardez la console du navigateur (F12) pour les erreurs JavaScript\n";
    echo "4. Regardez l'onglet Network pour les erreurs HTTP\n";
    echo "5. Si l'erreur persiste, essayez de créer un customer avec un email différent\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
