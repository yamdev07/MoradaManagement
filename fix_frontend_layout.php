<?php

// Correction du layout frontend

echo "🔧 Correction du layout frontend\n\n";

$file = 'resources/views/frontend/layouts/master.blade.php';
$content = file_get_contents($file);

// Supprimer les lignes vides à la fin du fichier
$content = rtrim($content, "\n\r");

// Réécrire le fichier
file_put_contents($file, $content);

echo "✅ Fichier corrigé - lignes vides supprimées à la fin\n";

// Vérifier la nouvelle taille
$newSize = filesize($file);
echo "📏 Nouvelle taille: " . number_format($newSize) . " octets\n";

// Compter les lignes
$lines = count(explode("\n", $content));
echo "📄 Nouveau nombre de lignes: " . $lines . "\n";

echo "\n🎉 Layout frontend corrigé !\n";

?>
