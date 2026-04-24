<?php

// Vérification de l'intégrité du fichier

echo "🔍 Vérification de l'intégrité du fichier frontend/master.blade.php\n\n";

$file = 'resources/views/frontend/layouts/master.blade.php';

// 1. Vérifier si le fichier existe
if (!file_exists($file)) {
    echo "❌ Le fichier n'existe pas\n";
    exit;
}

echo "✅ Fichier trouvé\n";

// 2. Vérifier la taille
$size = filesize($file);
echo "📏 Taille: " . number_format($size) . " octets\n";

// 3. Compter les lignes
$content = file_get_contents($file);
$lines = explode("\n", $content);
echo "📄 Nombre de lignes: " . count($lines) . "\n";

// 4. Vérifier les caractères de fin de fichier
$lastLine = end($lines);
echo "🔚 Dernière ligne: '" . trim($lastLine) . "'\n";

// 5. Vérifier s'il y a des caractères UTF-8 cachés
$utf8Content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');
if ($content !== $utf8Content) {
    echo "⚠️ Problème d'encodage UTF-8 détecté\n";
} else {
    echo "✅ Encodage UTF-8 correct\n";
}

// 6. Vérifier les caractères invisibles
$invisibleChars = ["\r", "\t", "\0", "\x0B", "\f"];
foreach ($invisibleChars as $char) {
    $count = substr_count($content, $char);
    if ($count > 0) {
        echo "⚠️ Caractère invisible détecté: " . ord($char) . " (x" . dechex(ord($char)) . ") - " . $count . " occurrences\n";
    }
}

// 7. Vérifier la structure HTML de base
if (strpos($content, '<html') !== false && strpos($content, '</html>') !== false) {
    echo "✅ Structure HTML complète\n";
} else {
    echo "⚠️ Structure HTML incomplète\n";
}

// 8. Vérifier les balises PHP/Blade
$phpOpen = substr_count($content, '<?php');
$phpClose = substr_count($content, '?>');
echo "🐘 Balises PHP: " . $phpOpen . " ouvertes, " . $phpClose . " fermées\n";

$bladeIf = substr_count($content, '@if');
$bladeEndif = substr_count($content, '@endif');
echo "🔹 @if: " . $bladeIf . ", @endif: " . $bladeEndif . "\n";

$bladeAuth = substr_count($content, '@auth');
$bladeEndauth = substr_count($content, '@endauth');
echo "👤 @auth: " . $bladeAuth . ", @endauth: " . $bladeEndauth . "\n";

// 9. Vérifier les lignes suspectes
echo "\n🔍 Analyse des lignes suspectes:\n";
foreach ($lines as $lineNumber => $line) {
    $trimmed = trim($line);
    
    // Lignes vides avec seulement des espaces
    if ($trimmed === '' && strlen($line) > 0) {
        echo "Ligne " . ($lineNumber + 1) . ": Contient seulement des espaces\n";
    }
    
    // Lignes avec des caractères non visibles
    if (preg_match('/[\x00-\x1F\x7F]/', $line)) {
        echo "Ligne " . ($lineNumber + 1) . ": Contient des caractères de contrôle\n";
    }
}

echo "\n🎯 Conclusion: ";
if ($bladeIf === $bladeEndif && $bladeAuth === $bladeEndauth) {
    echo "✅ La structure Blade semble correcte\n";
} else {
    echo "❌ Il y a un déséquilibre dans les directives Blade\n";
}

?>
