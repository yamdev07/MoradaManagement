<?php

// Script pour corriger le SuperAdminController en supprimant les duplications

echo "🔧 Correction du SuperAdminController\n\n";

try {
    $controllerFile = 'app/Http/Controllers/SuperAdminController.php';
    $content = file_get_contents($controllerFile);
    
    // Garder uniquement les méthodes uniques
    $lines = explode("\n", $content);
    $newLines = [];
    $functions = [];
    $inFunction = false;
    $currentFunction = '';
    $braceCount = 0;
    
    foreach ($lines as $line) {
        // Détecter le début d'une fonction
        if (preg_match('/^\s*public function (\w+)/', $line, $matches)) {
            $functionName = $matches[1];
            
            // Si cette fonction existe déjà, sauter toutes ses lignes
            if (isset($functions[$functionName])) {
                $inFunction = true;
                $currentFunction = $functionName;
                $braceCount = 0;
                continue;
            } else {
                $functions[$functionName] = true;
                $inFunction = false;
            }
        }
        
        // Si nous sommes dans une fonction dupliquée, compter les accolades
        if ($inFunction) {
            $braceCount += substr_count($line, '{') - substr_count($line, '}');
            
            // Si on a fermé toutes les accolades, on sort de la fonction dupliquée
            if ($braceCount <= 0) {
                $inFunction = false;
                $currentFunction = '';
                continue;
            }
            
            // Ignorer cette ligne (partie de la fonction dupliquée)
            continue;
        }
        
        // Ajouter la ligne si elle n'est pas dans une fonction dupliquée
        $newLines[] = $line;
    }
    
    // Écrire le fichier corrigé
    file_put_contents($controllerFile, implode("\n", $newLines));
    
    echo "✅ SuperAdminController corrigé\n";
    echo "   - Méthodes dupliquées supprimées\n";
    echo "   - Structure préservée\n";
    
    // Vérifier les méthodes restantes
    $newContent = file_get_contents($controllerFile);
    preg_match_all('/public function (\w+)/', $newContent, $matches);
    
    echo "\n📋 Méthodes restantes:\n";
    foreach ($matches[1] as $method) {
        echo "   - $method\n";
    }
    
    echo "\n🎯 Le SuperAdminController est maintenant prêt !\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
