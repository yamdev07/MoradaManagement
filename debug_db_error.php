<?php

// Diagnostic approfondi de l'erreur de base de données

echo "🔍 Diagnostic approfondi de l'erreur de base de données\n\n";

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    
    echo "📋 Étape 1: Test de connexion à la base de données\n";
    echo "✅ Connexion réussie à la base de données\n";
    
    echo "\n📋 Étape 2: Vérification de la structure des tables critiques\n";
    
    $tables = ['users', 'tenants', 'customers', 'transactions', 'rooms'];
    
    foreach ($tables as $table) {
        try {
            $stmt = $pdo->query("DESCRIBE $table");
            $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "✅ Table $table: " . count($columns) . " colonnes\n";
            
            // Vérifier les colonnes importantes
            if ($table === 'users') {
                $hasTenantId = false;
                $hasEmail = false;
                $hasPassword = false;
                
                foreach ($columns as $col) {
                    if ($col['Field'] === 'tenant_id') $hasTenantId = true;
                    if ($col['Field'] === 'email') $hasEmail = true;
                    if ($col['Field'] === 'password') $hasPassword = true;
                }
                
                echo "   - tenant_id: " . ($hasTenantId ? '✅' : '❌') . "\n";
                echo "   - email: " . ($hasEmail ? '✅' : '❌') . "\n";
                echo "   - password: " . ($hasPassword ? '✅' : '❌') . "\n";
            }
            
            if ($table === 'tenants') {
                $hasId = false;
                $hasName = false;
                $hasThemeSettings = false;
                
                foreach ($columns as $col) {
                    if ($col['Field'] === 'id') $hasId = true;
                    if ($col['Field'] === 'name') $hasName = true;
                    if ($col['Field'] === 'theme_settings') $hasThemeSettings = true;
                }
                
                echo "   - id: " . ($hasId ? '✅' : '❌') . "\n";
                echo "   - name: " . ($hasName ? '✅' : '❌') . "\n";
                echo "   - theme_settings: " . ($hasThemeSettings ? '✅' : '❌') . "\n";
            }
            
        } catch (Exception $e) {
            echo "❌ Erreur table $table: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n📋 Étape 3: Test des opérations CRUD\n";
    
    // Test de lecture
    try {
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM tenants WHERE is_active = 1");
        $count = $stmt->fetch()['count'];
        echo "✅ Lecture tenants: " . $count . " tenants actifs\n";
    } catch (Exception $e) {
        echo "❌ Erreur lecture tenants: " . $e->getMessage() . "\n";
    }
    
    // Test d'écriture
    try {
        $stmt = $pdo->prepare("INSERT INTO activity_log (message, created_at) VALUES (?, NOW())");
        $stmt->execute(['Test de diagnostic ' . date('Y-m-d H:i:s')]);
        echo "✅ Écriture activity_log: OK\n";
        
        // Nettoyer le test
        $stmt = $pdo->prepare("DELETE FROM activity_log WHERE message LIKE ?");
        $stmt->execute(['Test de diagnostic%']);
        echo "✅ Nettoyage test: OK\n";
    } catch (Exception $e) {
        echo "❌ Erreur écriture: " . $e->getMessage() . "\n";
    }
    
    echo "\n📋 Étape 4: Vérification des contraintes de clé étrangère\n";
    
    try {
        // Vérifier les contraintes sur la table users
        $stmt = $pdo->query("
            SELECT CONSTRAINT_NAME, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = 'hotelio' AND TABLE_NAME = 'users'
        ");
        $constraints = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "✅ Contraintes table users: " . count($constraints) . " trouvées\n";
        foreach ($constraints as $constraint) {
            echo "   - " . $constraint['CONSTRAINT_NAME'] . ": " . $constraint['TABLE_NAME'] . "." . $constraint['COLUMN_NAME'] . " -> " . $constraint['REFERENCED_TABLE_NAME'] . "." . $constraint['REFERENCED_COLUMN_NAME'] . "\n";
        }
        
    } catch (Exception $e) {
        echo "❌ Erreur vérification contraintes: " . $e->getMessage() . "\n";
    }
    
    echo "\n📋 Étape 5: Simulation de l'opération qui échoue\n";
    
    // Simuler la création d'un utilisateur (comme le fait Laravel)
    try {
        $testData = [
            'name' => 'Test User ' . time(),
            'email' => 'test' . time() . '@test.com',
            'password' => password_hash('test123', PASSWORD_DEFAULT),
            'tenant_id' => 64,
            'is_active' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'random_key' => bin2hex(random_bytes(16)),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        $columns = implode(', ', array_keys($testData));
        $placeholders = implode(', ', array_fill(0, count($testData), '?'));
        
        $stmt = $pdo->prepare("INSERT INTO users ($columns) VALUES ($placeholders)");
        $stmt->execute(array_values($testData));
        
        $userId = $pdo->lastInsertId();
        echo "✅ Création utilisateur test: ID " . $userId . "\n";
        
        // Supprimer le test
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        echo "✅ Suppression utilisateur test: OK\n";
        
    } catch (Exception $e) {
        echo "❌ Erreur création utilisateur: " . $e->getMessage() . "\n";
        echo "   Code: " . $e->getCode() . "\n";
        echo "   File: " . $e->getFile() . "\n";
        echo "   Line: " . $e->getLine() . "\n";
    }
    
    echo "\n📋 Étape 6: Vérification de l'espace disque et permissions\n";
    
    $dbFile = 'C:\Users\Majorelle V\Documents\MoradaManagement\storage\app\database.sqlite';
    if (file_exists($dbFile)) {
        $size = filesize($dbFile);
        $writable = is_writable(dirname($dbFile));
        echo "📁 Fichier SQLite: " . $size . " bytes, writable: " . ($writable ? 'Oui' : 'Non') . "\n";
    }
    
    // Vérifier l'espace disque
    $freeSpace = disk_free_space('C:');
    echo "💾 Espace libre sur C: : " . round($freeSpace / 1024 / 1024 / 1024, 2) . " GB\n";
    
    echo "\n🎯 Diagnostic terminé\n";
    echo "Si tout est OK ci-dessus, le problème vient probablement de:\n";
    echo "1. L'application Laravel elle-même\n";
    echo "2. Une configuration spécifique\n";
    echo "3. Un middleware qui intercepte la requête\n";
    echo "4. Une erreur dans le contrôleur ou la vue\n";
    
} catch (Exception $e) {
    echo "❌ Erreur critique: " . $e->getMessage() . "\n";
    echo "   Code: " . $e->getCode() . "\n";
    echo "   File: " . $e->getFile() . "\n";
    echo "   Line: " . $e->getLine() . "\n";
}

?>
