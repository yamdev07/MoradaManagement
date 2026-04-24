<?php

// Lire le fichier original
$content = file_get_contents('app\Http\Controllers\FrontendController.php');

// Remplacer la section problématique
$oldPattern = "/Log::info\('Chambre disponible'\);\s*\n\s*\/\/ Toujours essayer de créer l'utilisateur, avec gestion des doublons/";
$newPattern = "Log::info('Chambre disponible');\n\n            // Récupérer le tenant_id\n            \$tenantId = session('selected_hotel_id') ?: auth()->user()->tenant_id;\n            \n            // Toujours essayer de créer l'utilisateur, avec gestion des doublons";

$content = preg_replace($oldPattern, $newPattern, $content);

// Écrire le fichier corrigé
file_put_contents('app\Http\Controllers\FrontendController.php', $content);

echo "Fix appliqué avec succès !";

?>
