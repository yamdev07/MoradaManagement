<?php

// Vérification détaillée de l'erreur actuelle

echo "🔍 Vérification détaillée de l'erreur actuelle\n\n";

try {
    $logFile = 'storage/logs/laravel.log';
    
    if (file_exists($logFile)) {
        // Lire les 20 dernières lignes du log
        $lines = file($logFile);
        $totalLines = count($lines);
        
        echo "📋 Dernières lignes du log:\n";
        
        // Afficher les 20 dernières lignes
        for ($i = $totalLines - 1; $i >= max(0, $totalLines - 20); $i--) {
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
        
        echo "\n🎯 Analyse détaillée:\n";
        
        // Chercher les erreurs spécifiques dans les 20 dernières lignes
        $recentLines = array_slice($lines, -20);
        $logContent = implode(' ', $recentLines);
        
        if (strpos($logContent, 'duplicate entry') !== false) {
            echo "❌ Problème de contrainte d'unicité détecté\n";
            
            // Extraire l'email problématique
            if (preg_match('/duplicate entry \'([^\']+)\'/i', $logContent, $matches)) {
                echo "   Email problématique: " . $matches[1] . "\n";
            }
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
        
        // Vérifier quel tenant est utilisé
        if (preg_match('/hotel_id.*?(\d+)/', $logContent, $matches)) {
            echo "🏨 Hotel ID utilisé: " . $matches[1] . "\n";
        }
        
        // Vérifier quel email est utilisé
        if (preg_match('/email.*?([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/', $logContent, $matches)) {
            echo "📧 Email utilisé: " . $matches[1] . "\n";
        }
        
    } else {
        echo "❌ Fichier de log NON trouvé\n";
    }
    
    echo "\n🔧 Actions recommandées:\n";
    echo "1. Vérifiez quel hotel vous utilisez actuellement\n";
    echo "2. Utilisez un email qui n'existe PAS dans la table users\n";
    echo "3. Essayez de créer un customer avec un email complètement nouveau\n";
    echo "4. Si l'erreur persiste, le problème est dans le code lui-même\n";
    
    echo "\n📋 État actuel des tenants disponibles:\n";
    
    // Vérifier les tenants disponibles
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
        $stmt = $pdo->query("SELECT id, name, is_active FROM tenants WHERE is_active = 1 ORDER BY id");
        $tenants = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($tenants as $tenant) {
            echo "   - Tenant " . $tenant['id'] . ": " . $tenant['name'] . " (Actif)\n";
        }
    } catch (Exception $e) {
        echo "   Impossible de vérifier les tenants\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
