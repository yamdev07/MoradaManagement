<?php

// Script pour supprimer complètement l'HOTEL-T (Tenant ID 63)

echo "🗑️  Suppression de l'HOTEL-T (Tenant ID 63)\n\n";

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    $tenantId = 63;
    
    echo "📋 Analyse des données associées au Tenant ID 63...\n";
    
    // 1. Vérifier le tenant
    $stmt = $pdo->prepare("SELECT * FROM tenants WHERE id = ?");
    $stmt->execute([$tenantId]);
    $tenant = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$tenant) {
        echo "❌ Tenant ID 63 non trouvé\n";
        exit;
    }
    
    echo "✅ Tenant trouvé: " . $tenant['name'] . " (Domain: " . $tenant['domain'] . ")\n\n";
    
    // 2. Lister toutes les données associées
    $tables = [
        'users' => 'Utilisateurs',
        'customers' => 'Customers', 
        'rooms' => 'Chambres',
        'transactions' => 'Transactions',
        'payments' => 'Paiements'
    ];
    
    $dataCounts = [];
    
    foreach ($tables as $table => $label) {
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM $table WHERE tenant_id = ?");
        $stmt->execute([$tenantId]);
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        $dataCounts[$table] = $count;
        
        if ($count > 0) {
            echo "📊 $label: $count enregistrement(s)\n";
        }
    }
    
    echo "\n⚠️  ATTENTION: Cette supression va effacer TOUTES ces données !\n";
    
    // 3. Confirmation
    echo "\n🔍 Détail des transactions à supprimer:\n";
    $stmt = $pdo->prepare("SELECT id, status, total_price FROM transactions WHERE tenant_id = ?");
    $stmt->execute([$tenantId]);
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($transactions as $t) {
        echo "   - Transaction ID " . $t['id'] . " (" . $t['status'] . ") - " . $t['total_price'] . "\n";
    }
    
    echo "\n🔍 Détail des chambres à supprimer:\n";
    $stmt = $pdo->prepare("SELECT id, name, room_number FROM rooms WHERE tenant_id = ?");
    $stmt->execute([$tenantId]);
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($rooms as $r) {
        echo "   - Chambre ID " . $r['id'] . " (" . $r['room_number'] . ") - " . $r['name'] . "\n";
    }
    
    echo "\n🔍 Détail des utilisateurs à supprimer:\n";
    $stmt = $pdo->prepare("SELECT id, name, email FROM users WHERE tenant_id = ?");
    $stmt->execute([$tenantId]);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $u) {
        echo "   - User ID " . $u['id'] . " - " . $u['name'] . " (" . $u['email'] . ")\n";
    }
    
    echo "\n🔍 Détail des customers à supprimer:\n";
    $stmt = $pdo->prepare("SELECT id, name, email FROM customers WHERE tenant_id = ?");
    $stmt->execute([$tenantId]);
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($customers as $c) {
        echo "   - Customer ID " . $c['id'] . " - " . $c['name'] . " (" . $c['email'] . ")\n";
    }
    
    echo "\n🔧 DÉBUT DE LA SUPPRESSION...\n";
    
    // 4. Désactiver les contraintes de clé étrangère
    echo "📝 Désactivation des contraintes de clé étrangère...\n";
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    
    // 5. Supprimer dans l'ordre inverse des dépendances
    $deleteOrder = [
        'payments' => 'Paiements',
        'transactions' => 'Transactions', 
        'rooms' => 'Chambres',
        'customers' => 'Customers',
        'users' => 'Utilisateurs',
        'tenants' => 'Tenant'
    ];
    
    foreach ($deleteOrder as $table => $label) {
        if ($table === 'tenants') {
            $stmt = $pdo->prepare("DELETE FROM $table WHERE id = ?");
            $stmt->execute([$tenantId]);
        } else {
            $stmt = $pdo->prepare("DELETE FROM $table WHERE tenant_id = ?");
            $stmt->execute([$tenantId]);
        }
        
        $deleted = $stmt->rowCount();
        echo "✅ $label: $deleted enregistrement(s) supprimé(s)\n";
    }
    
    // 6. Réactiver les contraintes
    echo "\n📝 Réactivation des contraintes de clé étrangère...\n";
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    
    // 7. Vérification finale
    echo "\n🔍 Vérification finale...\n";
    
    $stmt = $pdo->prepare("SELECT * FROM tenants WHERE id = ?");
    $stmt->execute([$tenantId]);
    $tenantCheck = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$tenantCheck) {
        echo "✅ Tenant ID 63 supprimé avec succès\n";
    } else {
        echo "❌ Erreur: Tenant ID 63 existe toujours\n";
    }
    
    foreach ($tables as $table => $label) {
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM $table WHERE tenant_id = ?");
        $stmt->execute([$tenantId]);
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        if ($count === 0) {
            echo "✅ $label: 0 enregistrement restant\n";
        } else {
            echo "❌ $label: $count enregistrement(s) restant(s)\n";
        }
    }
    
    echo "\n🎉 SUPPRESSION TERMINÉE !\n";
    echo "📝 L'HOTEL-T a été complètement supprimé du système\n";
    echo "🔐 Toutes les données associées ont été effacées\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    
    // Essayer de réactiver les contraintes en cas d'erreur
    try {
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
        echo "🔧 Contraintes de clé étrangère réactivées\n";
    } catch (Exception $e2) {
        echo "⚠️  Impossible de réactiver les contraintes: " . $e2->getMessage() . "\n";
    }
}

?>
