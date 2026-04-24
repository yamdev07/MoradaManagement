<?php

// Script final pour corriger le problème de route manquante

$filePath = 'resources/views/transaction/show.blade.php';

// Lire le fichier ligne par ligne
$lines = file($filePath, FILE_IGNORE_NEW_LINES);
if (!$lines) {
    echo "Impossible de lire le fichier\n";
    exit(1);
}

// Trouver les lignes exactes à remplacer
$startLine = -1;
$endLine = -1;

for ($i = 0; $i < count($lines); $i++) {
    if (strpos($lines[$i], '<div class="d-flex gap-2 mt-2">') !== false && strpos($lines[$i], 'route(\'customer.show\'') !== false) {
        $startLine = $i;
        // Trouver la fin
        for ($j = $i; $j < count($lines); $j++) {
            if (strpos($lines[$j], '</div>') !== false && strpos($lines[$j], 'd-flex gap-2') === false) {
                $endLine = $j;
                break;
            }
        }
        break;
    }
}

if ($startLine === -1 || $endLine === -1) {
    echo "❌ Impossible de trouver les lignes à remplacer\n";
    exit(1);
}

echo "🔍 Lignes trouvées : $startLine à $endLine\n";

// Créer une sauvegarde
$backupPath = 'resources/views/transaction/show.blade.php.backup.' . date('Y-m-d-H-i-s');
file_put_contents($backupPath, implode("\n", $lines));

// Remplacer les lignes
$newLines = array_slice($lines, 0, $startLine);

// Ajouter le nouveau code
$newLines[] = '@if($transaction->customer)';
$newLines[] = '                    <div class="d-flex gap-2 mt-2">';
$newLines[] = '                        <a href="{{ route(\'customer.show\', $transaction->customer) }}" class="btn-modern btn-outline-modern btn-sm">';
$newLines[] = '                            <i class="fas fa-eye me-1"></i>Voir profil';
$newLines[] = '                        </a>';
$newLines[] = '                        <a href="{{ route(\'transaction.reservation.customerReservations\', $transaction->customer) }}" class="btn-modern btn-outline-modern btn-sm">';
$newLines[] = '                            <i class="fas fa-history me-1"></i>Historique';
$newLines[] = '                        </a>';
$newLines[] = '                    </div>';
$newLines[] = '                    @else';
$newLines[] = '                    <div class="alert alert-warning mt-2">';
$newLines[] = '                        <i class="fas fa-exclamation-triangle me-2"></i>';
$newLines[] = '                        Client non disponible - Impossible d\'afficher les liens';
$newLines[] = '                    </div>';
$newLines[] = '                    @endif';

// Ajouter le reste du fichier
$newLines = array_merge($newLines, array_slice($lines, $endLine + 1));

// Écrire le fichier
if (file_put_contents($filePath, implode("\n", $newLines))) {
    echo "✅ Fichier corrigé avec succès !\n";
    echo "📁 Sauvegarde créée : $backupPath\n";
    echo "🔧 Correction appliquée : Ajout de la condition @if(\$transaction->customer)\n";
    echo "🌐 Accédez à : http://127.0.0.1:8001/transaction/13\n";
    echo "🎯 Le problème de route manquante est maintenant résolu !\n";
} else {
    echo "❌ Erreur lors de l'écriture du fichier\n";
    exit(1);
}

?>
