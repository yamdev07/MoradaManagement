<?php

// Analyseur de syntaxe Blade pour trouver les @if non fermés

echo "🔍 Analyse de la syntaxe Blade du layout frontend\n\n";

$file = 'resources/views/frontend/layouts/master.blade.php';
$content = file_get_contents($file);

$lines = explode("\n", $content);
$stack = [];
$issues = [];

foreach ($lines as $lineNumber => $line) {
    // Chercher les directives @if
    if (preg_match('/@if\s*\(/', $line)) {
        array_push($stack, ['type' => 'if', 'line' => $lineNumber + 1, 'content' => trim($line)]);
        echo "Ligne " . ($lineNumber + 1) . ": @if trouvé\n";
    }
    
    // Chercher les directives @else
    if (preg_match('/@else/', $line)) {
        if (!empty($stack) && end($stack)['type'] === 'if') {
            echo "Ligne " . ($lineNumber + 1) . ": @else trouvé (ferme le @if de la ligne " . end($stack)['line'] . ")\n";
        }
    }
    
    // Chercher les directives @endif
    if (preg_match('/@endif/', $line)) {
        if (!empty($stack) && end($stack)['type'] === 'if') {
            $popped = array_pop($stack);
            echo "Ligne " . ($lineNumber + 1) . ": @endif trouvé (ferme le @if de la ligne " . $popped['line'] . ")\n";
        } else {
            echo "Ligne " . ($lineNumber + 1) . ": @endif trouvé sans @if correspondant !\n";
            $issues[] = "@endif sans @if correspondant à la ligne " . ($lineNumber + 1);
        }
    }
    
    // Chercher les directives @auth/@endauth
    if (preg_match('/@auth/', $line)) {
        array_push($stack, ['type' => 'auth', 'line' => $lineNumber + 1, 'content' => trim($line)]);
        echo "Ligne " . ($lineNumber + 1) . ": @auth trouvé\n";
    }
    
    if (preg_match('/@endauth/', $line)) {
        if (!empty($stack) && end($stack)['type'] === 'auth') {
            $popped = array_pop($stack);
            echo "Ligne " . ($lineNumber + 1) . ": @endauth trouvé (ferme le @auth de la ligne " . $popped['line'] . ")\n";
        } else {
            echo "Ligne " . ($lineNumber + 1) . ": @endauth trouvé sans @auth correspondant !\n";
            $issues[] = "@endauth sans @auth correspondant à la ligne " . ($lineNumber + 1);
        }
    }
}

echo "\n📋 Résultat de l'analyse:\n";

if (!empty($stack)) {
    echo "❌ Blocs non fermés trouvés:\n";
    foreach ($stack as $unclosed) {
        echo "   - " . $unclosed['type'] . " à la ligne " . $unclosed['line'] . ": " . $unclosed['content'] . "\n";
        $issues[] = $unclosed['type'] . " non fermé à la ligne " . $unclosed['line'];
    }
} else {
    echo "✅ Tous les blocs sont correctement fermés\n";
}

if (!empty($issues)) {
    echo "\n🚨 Problèmes détectés:\n";
    foreach ($issues as $issue) {
        echo "   - " . $issue . "\n";
    }
} else {
    echo "\n✅ Aucun problème de syntaxe détecté\n";
}

?>
