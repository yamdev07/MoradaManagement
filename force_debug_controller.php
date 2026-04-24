<?php

// Script pour forcer le débogage dans le contrôleur de réservation

echo "🔧 Ajout de débogage forcé dans TransactionRoomReservationController\n\n";

try {
    $controllerFile = 'app/Http/Controllers/TransactionRoomReservationController.php';
    
    // Lire le contenu actuel du contrôleur
    $content = file_get_contents($controllerFile);
    if (!$content) {
        echo "❌ Impossible de lire le fichier du contrôleur\n";
        exit;
    }
    
    // Ajouter du débogage au début de la méthode createIdentity
    $debugCode = '
        // DÉBOGAGE FORCÉ - À SUPPRIMER APRÈS RÉSOLUTION
        error_log("=== DÉBOGAGE createIdentity ===");
        error_log("Session hotel_id: " . (session(\'hotel_id\') ?: \'NON\'));
        error_log("Session user_id: " . (session(\'user_id\') ?: \'NON\'));
        error_log("TenantColors: " . (view()->shared(\'tenantColors\') ? json_encode(view()->shared(\'tenantColors\')) : \'NON\'));
        
        // Vérifier le tenant
        try {
            $tenant = \App\Models\Tenant::find(session(\'hotel_id\'));
            if ($tenant) {
                error_log("Tenant trouvé: " . $tenant->name);
                error_log("Theme settings: " . ($tenant->theme_settings ? \'OUI\' : \'NON\'));
                error_log("Theme settings brut: " . $tenant->theme_settings);
            } else {
                error_log("Tenant NON trouvé");
            }
        } catch (Exception $e) {
            error_log("Erreur recherche tenant: " . $e->getMessage());
        }
    ';
    
    // Trouver la position de la méthode createIdentity
    $pattern = '/public function createIdentity\(\)/';
    $replacement = 'public function createIdentity() {' . $debugCode;
    
    // Remplacer dans le contenu
    $newContent = preg_replace($pattern, $replacement, $content);
    
    if ($newContent && $newContent !== $content) {
        // Écrire le nouveau contenu
        if (file_put_contents($controllerFile, $newContent)) {
            echo "✅ Débogage ajouté au contrôleur createIdentity\n";
            echo "📁 Fichier modifié: $controllerFile\n";
            
            // Afficher les lignes modifiées
            $lines = explode("\n", $newContent);
            $lineNumber = 1;
            foreach ($lines as $line) {
                if (strpos($line, 'DÉBOGAGE FORCÉ') !== false) {
                    echo "Ligne $lineNumber: $line\n";
                    $lineNumber++;
                    if ($lineNumber > 40) break; // Limiter l\'affichage
                } else {
                    $lineNumber++;
                }
            }
        } else {
            echo "❌ Erreur lors de l\'écriture du fichier\n";
        }
    } else {
        echo "❌ Le contenu n\'a pas changé\n";
    }
    
    echo "\n🎯 Instructions:\n";
    echo "1. Actualisez la page: http://127.0.0.1:8000/transaction/reservation/createIdentity\n";
    echo "2. Regardez le fichier de log: storage/logs/laravel.log\n";
    echo "3. Le débogage affichera les informations dans les logs\n";
    echo "4. Après diagnostic, supprimez le code de débogage\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
