<?php

// Test pour vérifier si la page fonctionne après connexion simulée

echo "🔐 Test de la page de réservation après connexion simulée\n\n";

try {
    // Simuler une session utilisateur avec le tenant 64
    session_start();
    
    // Simuler les données de session Laravel
    $_SESSION['hotel_id'] = 64;
    $_SESSION['user_id'] = 100; // L'ID de l'utilisateur que nous avons créé
    $_SESSION['user_email'] = 'majorelle.tenant64@morada-management.com';
    $_SESSION['user_name'] = 'milca VODUNON';
    $_SESSION['user_role'] = 'Admin';
    
    echo "✅ Session simulée:\n";
    echo "   Hotel ID: " . $_SESSION['hotel_id'] . "\n";
    echo "   User ID: " . $_SESSION['user_id'] . "\n";
    echo "   User Email: " . $_SESSION['user_email'] . "\n";
    echo "   User Role: " . $_SESSION['user_role'] . "\n";
    
    // Test de la page de réservation avec la session
    $url = 'http://127.0.0.1:8000/transaction/reservation/createIdentity';
    
    echo "\n🌐 Test de la page avec session: $url\n";
    
    // Initialiser cURL avec cookies de session
    $ch = curl_init();
    
    // Configuration cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_COOKIE, session_name() . '=' . session_id());
    
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
        
        echo "   Taille body: " . strlen($body) . " bytes\n";
        
        // Analyser le code HTTP
        if ($httpCode == 200) {
            echo "✅ Page accessible (HTTP 200)\n";
            
            // Vérifier si la page contient le contenu attendu
            if (strpos($body, 'Création Client') !== false) {
                echo "✅ Page de réservation trouvée\n";
            } else {
                echo "⚠️  Page de réservation NON trouvée\n";
            }
            
            // Vérifier les variables CSS
            if (strpos($body, 'tenantColors') !== false) {
                echo "✅ Variables tenantColors trouvées\n";
            } else {
                echo "⚠️  Variables tenantColors NON trouvées\n";
            }
            
            // Vérifier les couleurs du thème
            if (strpos($body, '#4f492b') !== false) {
                echo "✅ Couleurs du thème trouvées\n";
            } else {
                echo "⚠️  Couleurs du thème NON trouvées\n";
            }
            
            // Vérifier s'il y a des erreurs
            if (strpos($body, 'Erreur de base de données') !== false) {
                echo "❌ Erreur de base de données trouvée dans la page\n";
                
                // Essayer d'extraire plus de détails
                if (preg_match('/<title>([^<]+)<\/title>/', $body, $matches)) {
                    echo "   Titre: " . trim($matches[1]) . "\n";
                }
            } else {
                echo "✅ Aucune erreur de base de données trouvée\n";
            }
            
        } elseif ($httpCode == 404) {
            echo "❌ Page non trouvée (HTTP 404)\n";
        } elseif ($httpCode == 500) {
            echo "❌ Erreur serveur (HTTP 500)\n";
        } elseif ($httpCode == 302 || $httpCode == 301) {
            echo "🔄 Redirection (HTTP $httpCode)\n";
        } else {
            echo "⚠️  Code HTTP inattendu: $httpCode\n";
        }
    }
    
    echo "\n🎯 Solution recommandée:\n";
    echo "1. Ouvrez votre navigateur\n";
    echo "2. Allez à: http://127.0.0.1:8000/login\n";
    echo "3. Connectez-vous avec:\n";
    echo "   Email: majorelle.tenant64@morada-management.com\n";
    echo "   Mot de passe: password123\n";
    echo "4. Après connexion, allez à: http://127.0.0.1:8000/transaction/reservation/createIdentity\n";
    echo "5. Si l'erreur persiste, le problème est dans le contrôleur ou la vue\n";
    
} catch (Exception $e) {
    echo "❌ Erreur critique: " . $e->getMessage() . "\n";
}

?>
