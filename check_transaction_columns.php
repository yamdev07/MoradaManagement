<?php

// Vérifier les colonnes de la table transactions

echo "🔍 VÉRIFICATION DES COLONNES DE LA TABLE TRANSACTIONS\n\n";

try {
    // Utiliser une connexion directe pour vérifier les colonnes
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    $stmt = $pdo->query("DESCRIBE transactions");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "📋 Colonnes trouvées dans la table 'transactions':\n";
    foreach ($columns as $column) {
        echo "   - $column\n";
    }
    
    echo "\n🎯 Vérification des colonnes utilisées:\n";
    
    // Vérifier si les colonnes importantes existent
    $importantColumns = ['amount', 'total_amount', 'price', 'cost', 'value', 'revenue'];
    
    foreach ($importantColumns as $column) {
        if (in_array($column, $columns)) {
            echo "   ✅ $column: EXISTE\n";
        } else {
            echo "   ❌ $column: MANQUANTE\n";
        }
    }
    
    // Vérifier les valeurs de la première transaction pour voir les données
    echo "\n📊 Exemple de données de transaction:\n";
    $stmt = $pdo->query("SELECT * FROM transactions WHERE tenant_id = 3 LIMIT 1");
    $transaction = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($transaction) {
        echo "   - Transaction ID: " . $transaction['id'] . "\n";
        echo "   - Tenant ID: " . $transaction['tenant_id'] . "\n";
        echo "   - Données disponibles:\n";
        foreach ($transaction as $key => $value) {
            if (!is_null($value) && $key !== 'id') {
                echo "     - $key: $value\n";
            }
        }
    } else {
        echo "   - Aucune transaction trouvée pour le tenant 3\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
