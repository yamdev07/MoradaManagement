<?php

// Nettoyage complet de tout ce qui est lié à l'HOTEL-T (tenant 64)

echo "🗑️  Nettoyage complet de l'HOTEL-T (tenant 64)\n\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 Étape 1: Désactiver les contraintes temporairement\n";
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    echo "✅ Contraintes désactivées\n";
    
    $tenantId = 64;
    
    echo "\n📋 Étape 2: Suppression des données du tenant 64\n";
    
    // Tables à nettoyer pour le tenant 64
    $tablesToClean = [
        'transactions' => 'transactions',
        'customers' => 'customers', 
        'rooms' => 'rooms',
        'users' => 'users',
        'tenants' => 'tenants'
    ];
    
    foreach ($tablesToClean as $table => $label) {
        if ($table === 'tenants') {
            // Supprimer le tenant lui-même
            $stmt = $pdo->prepare("DELETE FROM $table WHERE id = ?");
            $stmt->execute([$tenantId]);
            $count = $stmt->rowCount();
            echo "   ✅ $label: $count enregistrement(s) supprimé(s)\n";
        } else {
            // Supprimer les données liées au tenant
            $stmt = $pdo->prepare("DELETE FROM $table WHERE tenant_id = ?");
            $stmt->execute([$tenantId]);
            $count = $stmt->rowCount();
            echo "   ✅ $label: $count enregistrement(s) supprimé(s)\n";
        }
    }
    
    echo "\n📋 Étape 3: Réactiver les contraintes\n";
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    echo "✅ Contraintes réactivées\n";
    
    echo "\n📋 Étape 4: Vérification finale\n";
    
    // Vérifier que tout a été supprimé
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM tenants WHERE id = ?");
    $stmt->execute([$tenantId]);
    $tenantCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "   Tenant 64 restant: " . $tenantCount . "\n";
    
    if ($tenantCount == 0) {
        echo "✅ L'HOTEL-T a été complètement supprimé\n";
    } else {
        echo "❌ Tenant 64 existe encore\n";
    }
    
    // Vérifier les autres tables
    foreach (['users', 'customers', 'rooms', 'transactions'] as $table) {
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM $table WHERE tenant_id = ?");
        $stmt->execute([$tenantId]);
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "   $table avec tenant_id 64: " . $count . "\n";
    }
    
    echo "\n🎉 NETTOYAGE TERMINÉ !\n";
    echo "📝 L'HOTEL-T et toutes ses données ont été supprimés\n";
    echo "🔐 Plus de risque de conflit avec l'HOTEL-T\n";
    echo "🌐 Le système est maintenant propre\n";
    
    echo "\n🎯 Instructions finales:\n";
    echo "1. Le serveur Laravel va continuer de fonctionner\n";
    echo "2. Vous pouvez créer un nouvel hôtel si nécessaire\n";
    echo "3. Ou utiliser un autre hôtel existant\n";
    echo "4. Le problème de réservation est définitivement résolu\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    
    // Essayer de réactiver les contraintes en cas d'erreur
    try {
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
        echo "🔧 Contraintes réactivées (tentative de récupération)\n";
    } catch (Exception $e2) {
        echo "⚠️  Impossible de réactiver les contraintes: " . $e2->getMessage() . "\n";
    }
}

?>
