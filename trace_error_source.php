<?php

// Tracer la source exacte de l'erreur

echo "🔍 Tracer la source exacte de l'erreur\n\n";

try {
    $logFile = 'storage/logs/laravel.log';
    
    if (file_exists($logFile)) {
        // Lire les 30 dernières lignes pour plus de contexte
        $lines = file($logFile);
        $totalLines = count($lines);
        
        echo "📋 Analyse détaillée des logs récents:\n";
        
        // Chercher la séquence exacte qui mène à l'erreur
        $errorSequence = [];
        $foundError = false;
        
        for ($i = $totalLines - 1; $i >= max(0, $totalLines - 50); $i--) {
            $line = trim($lines[$i]);
            
            if (strpos($line, 'ERREUR SQL') !== false) {
                $foundError = true;
                $errorSequence[] = "🔴 ERREUR: " . $line;
            } elseif ($foundError && (strpos($line, 'INFO') !== false || strpos($line, 'ERROR') !== false)) {
                $errorSequence[] = "📝 " . $line;
            }
            
            // Arrêter si on a trouvé assez de contexte
            if (count($errorSequence) > 10) break;
        }
        
        // Afficher la séquence dans l'ordre chronologique
        if (!empty($errorSequence)) {
            echo "Séquence qui mène à l'erreur:\n";
            foreach (array_reverse($errorSequence) as $logLine) {
                echo $logLine . "\n";
            }
        }
        
        echo "\n🎯 Analyse de l'erreur SQL:\n";
        
        // Extraire les détails de l'erreur SQL
        $recentLines = array_slice($lines, -30);
        $logContent = implode(' ', $recentLines);
        
        if (preg_match('/insert into `users` \([^)]+\) values \(([^)]+)\)/i', $logContent, $matches)) {
            echo "❌ Le système essaie d'insérer dans la table USERS:\n";
            echo "   Valeurs: " . $matches[1] . "\n";
            
            // Analyser les valeurs
            $values = explode(',', $matches[1]);
            echo "   Nombre de champs: " . count($values) . "\n";
            
            // Chercher l'email dans les valeurs
            foreach ($values as $value) {
                if (strpos($value, '@') !== false) {
                    echo "   Email détecté: " . trim($value, " '") . "\n";
                }
            }
        }
        
        // Vérifier si c'est bien un appel à User::create
        if (strpos($logContent, 'Customer') !== false) {
            echo "✅ Référence à Customer trouvée dans les logs\n";
        }
        
        if (strpos($logContent, 'User') !== false) {
            echo "❌ Référence à User trouvée dans les logs\n";
        }
        
        echo "\n🔧 Hypothèse finale:\n";
        echo "Le problème n'est PAS dans le code visible.\n";
        echo "Possibilités:\n";
        echo "1. Un middleware ou un observer crée un User\n";
        echo "2. Une relation ou un événement de modèle déclenche la création\n";
        echo "3. Un service ou un helper externe crée le User\n";
        echo "4. Une configuration ou un trigger de base de données\n";
        
        echo "\n🎯 Solution immédiate:\n";
        echo "1. Utilisez un email qui n'existe PAS du tout dans la base\n";
        echo "2. Testez avec: test.reservation." . time() . "@example.com\n";
        echo "3. Si ça fonctionne, le problème est bien l'email dupliqué\n";
        echo "4. Si ça ne fonctionne pas, le bug est plus profond\n";
        
    } else {
        echo "❌ Fichier de log NON trouvé\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
