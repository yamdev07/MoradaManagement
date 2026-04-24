<?php

// Forcer le nettoyage complet de tous les caches

echo "🧹 Nettoyage forcé de tous les caches\n\n";

try {
    // 1. Supprimer manuellement les fichiers de cache
    $cacheDirs = [
        'bootstrap/cache',
        'storage/framework/cache',
        'storage/framework/sessions',
        'storage/framework/views',
        'storage/framework/testing'
    ];
    
    foreach ($cacheDirs as $dir) {
        if (is_dir($dir)) {
            $files = glob($dir . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                    echo "✅ Supprimé: " . basename($file) . "\n";
                }
            }
            echo "📁 Nettoyé: " . $dir . "\n";
        }
    }
    
    // 2. Recréer les fichiers nécessaires
    $requiredFiles = [
        'bootstrap/cache/.gitkeep',
        'storage/framework/cache/.gitkeep',
        'storage/framework/sessions/.gitkeep',
        'storage/framework/views/.gitkeep',
        'storage/framework/testing/.gitkeep'
    ];
    
    foreach ($requiredFiles as $file) {
        $dir = dirname($file);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        if (!file_exists($file)) {
            file_put_contents($file, '');
            echo "✅ Recréé: " . $file . "\n";
        }
    }
    
    echo "\n🎯 Nettoyage terminé !\n";
    echo "✅ Tous les caches ont été supprimés\n";
    echo "✅ Fichiers .gitkeep recréés\n";
    echo "✅ Prêt pour un redémarrage propre\n\n";
    
    echo "🚀 Redémarrez le serveur avec: php artisan serve\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
