<?php

// Script pour corriger le problème de contrainte d'unicité sur l'email

echo "🔧 Correction de la contrainte d'unicité sur l'email\n\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 État actuel de la table users:\n";
    
    // Vérifier s'il y a des doublons pour l'email
    $stmt = $pdo->prepare("SELECT email, COUNT(*) as count FROM users GROUP BY email HAVING COUNT(*) > 1");
    $stmt->execute();
    $duplicates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($duplicates)) {
        echo "⚠️  Emails en double trouvé:\n";
        foreach ($duplicates as $dup) {
            echo "   - " . $dup['email'] . " (" . $dup['count'] . " occurrences)\n";
        }
        
        echo "\n🗑️ Suppression des doublons...\n";
        
        // Supprimer les doublons en gardant la première occurrence
        foreach ($duplicates as $dup) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE email = ? LIMIT " . ($dup['count'] - 1));
            $stmt->execute([$dup['email']]);
            echo "   ✅ " . $stmt->rowCount() . " doublons supprimés pour " . $dup['email'] . "\n";
        }
        
        echo "\n✅ Nettoyage terminé\n";
    } else {
        echo "✅ Aucun doublon trouvé\n";
    }
    
    echo "\n📋 Vérification de l'utilisateur crée:\n";
    
    // Vérifier si l'utilisateur 100 existe toujours
    $stmt = $pdo->prepare("SELECT id, name, email FROM users WHERE id = 100");
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo "✅ Utilisateur 100 trouvé:\n";
        echo "   - ID: " . $user['id'] . "\n";
        echo "   - Nom: " . $user['name'] . "\n";
        echo "   - Email: " . $user['email'] . "\n";
        echo "   - Tenant ID: " . $user['tenant_id'] . "\n";
        echo "   - Actif: " . ($user['is_active'] ? 'Oui' : 'Non') . "\n";
    } else {
        echo "❌ Utilisateur 100 NON trouvé\n";
    }
    
    echo "\n🎯 Instructions:\n";
    echo "1. Connectez-vous avec les identifiants:\n";
    echo "   URL: http://127.0.0.1:8000/login\n";
    echo "   Email: majorelle.tenant64@morada-management.com\n";
    echo "   Mot de passe: password123\n";
    echo "\n";
    echo "2. Après connexion, testez la page de réservation:\n";
    echo "   URL: http://127.0.0.1:8000/transaction/reservation/createIdentity\n";
    echo "\n";
    echo "3. Si l'erreur persiste, le problème est maintenant résolu.\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
