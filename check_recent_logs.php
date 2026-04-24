<?php

// Vérifier les logs récents pour l'erreur exacte

echo "🔍 Vérification des logs récents\n\n";

try {
    $logFile = 'storage/logs/laravel.log';
    
    if (file_exists($logFile)) {
        // Lire les 50 dernières lignes
        $lines = file($logFile);
        $totalLines = count($lines);
        
        echo "📋 Dernières lignes du log (recherche d'erreurs):\n";
        
        // Parcourir les lignes en partant de la fin
        for ($i = $totalLines - 1; $i >= max(0, $totalLines - 50); $i--) {
            $line = trim($lines[$i]);
            
            // Chercher les erreurs
            if (strpos($line, 'ERROR') !== false || 
                strpos($line, 'Exception') !== false || 
                strpos($line, 'Fatal') !== false ||
                strpos($line, 'Erreur') !== false) {
                
                echo "🔴 " . $line . "\n";
            }
            // Chercher les avertissements importants
            elseif (strpos($line, 'WARNING') !== false || 
                     strpos($line, 'sql') !== false ||
                     strpos($line, 'duplicate') !== false) {
                
                echo "🟡 " . $line . "\n";
            }
        }
        
        echo "\n🎯 Analyse:\n";
        echo "Si vous voyez une erreur 'duplicate entry' ou 'constraint violation',\n";
        echo "c'est le problème de contrainte d'unicité.\n";
        echo "Si vous voyez une erreur 'base de données',\n";
        echo "c'est probablement un problème de connexion ou de requête.\n";
        
    } else {
        echo "❌ Fichier de log NON trouvé\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
