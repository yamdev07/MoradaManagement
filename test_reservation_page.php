<?php

// Test simple de la page de réservation via cURL

echo "🌐 Test de la page de réservation via HTTP\n\n";

try {
    // URL de test
    $url = 'http://127.0.0.1:8001/transaction/reservation/createIdentity';
    
    echo "📋 Test de l'URL: $url\n";
    
    // Initialiser cURL
    $ch = curl_init();
    
    // Configuration cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HEADER, true);
    
    // Exécuter la requête
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    // Analyser la réponse
    if ($error) {
        echo "❌ Erreur cURL: $error\n";
    } else {
        echo "✅ Requête HTTP envoyée\n";
        echo "   Code HTTP: $httpCode\n";
        
        // Séparer les headers et le body
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);
        
        echo "   Taille headers: " . strlen($headers) . " bytes\n";
        echo "   Taille body: " . strlen($body) . " bytes\n";
        
        // Analyser le code HTTP
        if ($httpCode == 200) {
            echo "✅ Page accessible (HTTP 200)\n";
            
            // Vérifier si la page contient du contenu attendu
            if (strpos($body, 'createIdentity') !== false) {
                echo "✅ Contenu de la page trouvé\n";
            } else {
                echo "⚠️  Contenu de la page non trouvé\n";
            }
            
            // Vérifier s'il y a des erreurs dans le contenu
            if (strpos($body, 'Error') !== false || strpos($body, 'Exception') !== false) {
                echo "⚠️  Erreurs trouvées dans le contenu\n";
                
                // Extraire les erreurs
                preg_match('/<title>([^<]+)<\/title>/', $body, $matches);
                if (isset($matches[1])) {
                    echo "   Titre: " . trim($matches[1]) . "\n";
                }
            }
            
            // Vérifier les variables CSS
            if (strpos($body, 'tenantColors') !== false) {
                echo "✅ Variables tenantColors trouvées\n";
            } else {
                echo "⚠️  Variables tenantColors NON trouvées\n";
            }
            
        } elseif ($httpCode == 404) {
            echo "❌ Page non trouvée (HTTP 404)\n";
        } elseif ($httpCode == 500) {
            echo "❌ Erreur serveur (HTTP 500)\n";
            
            // Essayer d'extraire le message d'erreur
            preg_match('/<title>([^<]+)<\/title>/', $body, $matches);
            if (isset($matches[1])) {
                echo "   Titre d'erreur: " . trim($matches[1]) . "\n";
            }
        } elseif ($httpCode == 302 || $httpCode == 301) {
            echo "🔄 Redirection (HTTP $httpCode)\n";
            
            // Extraire la location de redirection
            if (preg_match('/Location: ([^\r\n]+)/', $headers, $matches)) {
                echo "   Redirection vers: " . trim($matches[1]) . "\n";
            }
        } else {
            echo "⚠️  Code HTTP inattendu: $httpCode\n";
        }
        
        // Afficher un extrait du contenu pour débogage
        echo "\n📋 Extrait du contenu (premiers 1000 caractères):\n";
        echo substr($body, 0, 1000) . "...\n";
    }
    
    echo "\n🎯 Instructions:\n";
    echo "1. Ouvrez votre navigateur\n";
    echo "2. Allez à: http://127.0.0.1:8001/login\n";
    echo "3. Connectez-vous avec: majorelle.tenant64@morada-management.com / password123\n";
    echo "4. Après connexion, allez à: http://127.0.0.1:8001/transaction/reservation/createIdentity\n";
    echo "5. Si vous voyez encore une erreur, regardez la console du navigateur (F12)\n";
    
} catch (Exception $e) {
    echo "❌ Erreur critique: " . $e->getMessage() . "\n";
}

?>
