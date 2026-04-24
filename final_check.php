<?php

// Vérification finale du tenant 64

echo "🔍 Vérification finale du tenant 64\n\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    // Vérifier le tenant 64
    $stmt = $pdo->prepare("SELECT * FROM tenants WHERE id = 64");
    $stmt->execute();
    $tenant = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($tenant) {
        echo "✅ Tenant 64 trouvé:\n";
        echo "   Nom: " . $tenant['name'] . "\n";
        echo "   Theme settings: " . ($tenant['theme_settings'] ? 'Oui' : 'Non') . "\n";
        
        if ($tenant['theme_settings']) {
            echo "   Theme settings (brut): " . $tenant['theme_settings'] . "\n";
            
            // Vérifier si c'est un array ou une string
            $isJson = is_string($tenant['theme_settings']);
            echo "   Theme settings type: " . ($isJson ? 'String JSON' : 'Array PHP') . "\n";
            
            if ($isJson) {
                $settings = json_decode($tenant['theme_settings'], true);
                if ($settings) {
                    echo "   ✅ JSON décodé avec succès:\n";
                    echo "   Primary: " . ($settings['primary_color'] ?? 'N/A') . "\n";
                    echo "   Secondary: " . ($settings['secondary_color'] ?? 'N/A') . "\n";
                    echo "   Accent: " . ($settings['accent_color'] ?? 'N/A') . "\n";
                } else {
                    echo "   ❌ Échec du décodage JSON\n";
                }
            } else {
                echo "   ✅ Déjà un array PHP:\n";
                echo "   Primary: " . ($tenant['theme_settings']['primary_color'] ?? 'N/A') . "\n";
                echo "   Secondary: " . ($tenant['theme_settings']['secondary_color'] ?? 'N/A') . "\n";
                echo "   Accent: " . ($tenant['theme_settings']['accent_color'] ?? 'N/A') . "\n";
            }
        }
        
        // Vérifier l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM users WHERE tenant_id = 64 AND email = ?");
        $stmt->execute(['majorelle.tenant64@morada-management.com']);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            echo "\n✅ Utilisateur trouvé:\n";
            echo "   ID: " . $user['id'] . "\n";
            echo "   Nom: " . $user['name'] . "\n";
            echo "   Email: " . $user['email'] . "\n";
            echo "   Actif: " . ($user['is_active'] ? 'Oui' : 'Non') . "\n";
        } else {
            echo "\n❌ Utilisateur NON trouvé\n";
        }
        
    } else {
        echo "❌ Tenant 64 NON trouvé\n";
    }
    
    echo "\n🎯 Conclusion:\n";
    echo "Si tout est OK ci-dessus, le problème est dans l'application Laravel.\n";
    echo "Essayez de vous connecter manuellement et vérifiez la page.\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
