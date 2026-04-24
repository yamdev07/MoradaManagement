<?php

// Vérifier les colonnes de la table rooms

echo "🔍 VÉRIFICATION DES COLONNES DE LA TABLE ROOMS\n\n";

try {
    // Utiliser une connexion directe pour vérifier les colonnes
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    $stmt = $pdo->query("DESCRIBE rooms");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "📋 Colonnes trouvées dans la table 'rooms':\n";
    foreach ($columns as $column) {
        echo "   - $column\n";
    }
    
    echo "\n🎯 Vérification des colonnes utilisées:\n";
    
    // Vérifier si les colonnes existent
    $requiredColumns = ['status', 'room_status_id'];
    
    foreach ($requiredColumns as $column) {
        if (in_array($column, $columns)) {
            echo "   ✅ $column: EXISTE\n";
        } else {
            echo "   ❌ $column: MANQUANTE\n";
        }
    }
    
    // Vérifier les valeurs de room_status_id si elles existent
    if (in_array('room_status_id', $columns)) {
        echo "\n📊 Vérification des valeurs de room_status_id:\n";
        $stmt = $pdo->query("SELECT DISTINCT room_status_id FROM rooms WHERE tenant_id = 3");
        $statuses = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        foreach ($statuses as $status) {
            echo "   - room_status_id: $status\n";
        }
        
        // Vérifier la table room_statuses
        echo "\n📋 Vérification de la table room_statuses:\n";
        $stmt = $pdo->query("SELECT * FROM room_statuses");
        $roomStatuses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($roomStatuses as $status) {
            echo "   - ID: {$status['id']}, Nom: {$status['name']}\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
