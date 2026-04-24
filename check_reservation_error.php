<?php

// Script pour diagnostiquer en détail le problème de réservation

echo "🔍 Diagnostic détaillé du problème de réservation\n\n";

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 Étape 1: Vérification des tenants et utilisateurs\n";
    
    // Vérifier tous les tenants
    $stmt = $pdo->query("SELECT id, name, subdomain, is_active FROM tenants ORDER BY id");
    $tenants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "   Tenants disponibles:\n";
    foreach ($tenants as $t) {
        $status = $t['is_active'] ? 'ACTIF' : 'INACTIF';
        echo "   - ID: " . $t['id'] . " | " . $t['name'] . " (" . $t['subdomain'] . ") - " . $status . "\n";
    }
    
    // Vérifier les utilisateurs
    $stmt = $pdo->query("SELECT id, name, email, tenant_id, role FROM users ORDER BY id DESC LIMIT 10");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\n   Utilisateurs récents:\n";
    foreach ($users as $u) {
        $tenantName = 'N/A';
        foreach ($tenants as $t) {
            if ($t['id'] == $u['tenant_id']) {
                $tenantName = $t['name'];
                break;
            }
        }
        echo "   - ID: " . $u['id'] . " | " . $u['name'] . " (" . $u['email'] . ") - Tenant: " . $tenantName . " (ID: " . $u['tenant_id'] . ")\n";
    }
    
    echo "\n📋 Étape 2: Simulation de l'accès à la page de réservation\n";
    
    // Simuler l'accès avec différents scénarios
    $scenarios = [
        ['user_id' => null, 'tenant_id' => null, 'description' => 'Non connecté'],
        ['user_id' => 88, 'tenant_id' => 63, 'description' => 'User 88 (ancien tenant 63 supprimé)'],
        ['user_id' => 90, 'tenant_id' => 63, 'description' => 'User 90 (ancien tenant 63 supprimé)'],
        ['user_id' => 1, 'tenant_id' => 55, 'description' => 'User 1 (tenant 55)'],
        ['user_id' => null, 'tenant_id' => 64, 'description' => 'Session tenant 64 sans user'],
    ];
    
    foreach ($scenarios as $scenario) {
        echo "\n   🔸 Scénario: " . $scenario['description'] . "\n";
        
        if ($scenario['tenant_id']) {
            $stmt = $pdo->prepare("SELECT * FROM tenants WHERE id = ? AND is_active = 1");
            $stmt->execute([$scenario['tenant_id']]);
            $tenant = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($tenant) {
                echo "     ✅ Tenant trouvé: " . $tenant['name'] . "\n";
                
                // Vérifier les theme_settings
                if ($tenant['theme_settings']) {
                    $settings = json_decode($tenant['theme_settings'], true);
                    if ($settings) {
                        echo "     ✅ Theme settings valides\n";
                        echo "       Primary: " . ($settings['primary_color'] ?? 'Non défini') . "\n";
                        echo "       Secondary: " . ($settings['secondary_color'] ?? 'Non défini') . "\n";
                        echo "       Accent: " . ($settings['accent_color'] ?? 'Non défini') . "\n";
                    } else {
                        echo "     ❌ Theme settings JSON invalide\n";
                    }
                } else {
                    echo "     ⚠️  Aucun theme_settings (utilisera les valeurs par défaut)\n";
                }
                
                // Simuler le code du contrôleur
                $tenantColors = [
                    'primary_color' => '#8b4513',
                    'secondary_color' => '#d2b48c', 
                    'accent_color' => '#f59e0b'
                ];
                
                if ($tenant['theme_settings']) {
                    $settings = json_decode($tenant['theme_settings'], true);
                    if ($settings) {
                        $tenantColors = array_merge($tenantColors, $settings);
                    }
                }
                
                echo "     ✅ Variables tenantColors générées:\n";
                foreach ($tenantColors as $key => $value) {
                    echo "       " . $key . ": " . $value . "\n";
                }
                
            } else {
                echo "     ❌ Tenant ID " . $scenario['tenant_id'] . " non trouvé ou inactif\n";
                echo "     💡 C'est probablement la cause du problème !\n";
            }
        } else {
            echo "     ❌ Aucun tenant_id spécifié\n";
        }
        
        if ($scenario['user_id']) {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$scenario['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                echo "     ✅ Utilisateur trouvé: " . $user['name'] . "\n";
                echo "       Tenant ID: " . $user['tenant_id'] . "\n";
                echo "       Role: " . $user['role'] . "\n";
                
                if ($user['tenant_id'] != $scenario['tenant_id']) {
                    echo "     ⚠️  Incohérence: user->tenant_id (" . $user['tenant_id'] . ") ≠ scenario tenant_id (" . $scenario['tenant_id'] . ")\n";
                }
            } else {
                echo "     ❌ Utilisateur ID " . $scenario['user_id'] . " non trouvé\n";
            }
        }
    }
    
    echo "\n📋 Étape 3: Vérification des routes et permissions\n";
    
    // Vérifier les routes importantes
    $routes = [
        'transaction.reservation.createIdentity' => '/transaction/reservation/createIdentity',
        'transaction.reservation.pickFromCustomer' => '/transaction/reservation/pickFromCustomer',
    ];
    
    echo "   Routes de réservation:\n";
    foreach ($routes as $name => $path) {
        echo "   - " . $name . ": " . $path . "\n";
    }
    
    echo "\n🎯 Diagnostic final:\n";
    echo "1. Si vous êtes connecté avec un utilisateur du tenant 63 (supprimé), ça causera une erreur\n";
    echo "2. Si vous n'êtes pas connecté, le middleware ne pourra pas trouver le tenant\n";
    echo "3. Si la session est corrompue, les variables ne seront pas disponibles\n";
    
    echo "\n🔧 Solutions immédiates:\n";
    echo "1. Déconnectez-vous complètement: php artisan auth:clear\n";
    echo "2. Reconnectez-vous avec un utilisateur d'un tenant actif (ID 3, 4, 56, ou 64)\n";
    echo "3. Videz le cache du navigateur (Ctrl+Shift+Del)\n";
    echo "4. Accédez à: http://127.0.0.1:8000/login\n";
    echo "5. Après connexion, allez à: http://127.0.0.1:8000/transaction/reservation/createIdentity\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
