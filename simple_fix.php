<?php

// Solution simple et directe pour corriger le problème

$filePath = 'resources/views/transaction/show.blade.php';

echo "🔧 Correction du fichier $filePath...\n";

// Lire tout le contenu
$content = file_get_contents($filePath);
if (!$content) {
    echo "❌ Impossible de lire le fichier\n";
    exit(1);
}

// Sauvegarde
$backupPath = $filePath . '.backup.' . date('Y-m-d-H-i-s');
file_put_contents($backupPath, $content);
echo "📁 Sauvegarde créée : $backupPath\n";

// Trouver et remplacer la section problématique
$pattern = '/(\s+<div class="d-flex gap-2 mt-2">\s+<a href="\{\{ route\(\'customer\.show\', \$transaction->customer\) \}\}" class="btn-modern btn-outline-modern btn-sm">\s+<i class="fas fa-eye me-1"><\/i>Voir profil\s+<\/a>\s+<a href="\{\{ route\(\'transaction\.reservation\.customerReservations\', \$transaction->customer\) \}\}" class="btn-modern btn-outline-modern btn-sm">\s+<i class="fas fa-history me-1"><\/i>Historique\s+<\/a>\s+<\/div>)/s';

$replacement = '@if($transaction->customer)
                    <div class="d-flex gap-2 mt-2">
                        <a href="{{ route(\'customer.show\', $transaction->customer) }}" class="btn-modern btn-outline-modern btn-sm">
                            <i class="fas fa-eye me-1"></i>Voir profil
                        </a>
                        <a href="{{ route(\'transaction.reservation.customerReservations\', $transaction->customer) }}" class="btn-modern btn-outline-modern btn-sm">
                            <i class="fas fa-history me-1"></i>Historique
                        </a>
                    </div>
                    @else
                    <div class="alert alert-warning mt-2">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Client non disponible - Impossible d\'afficher les liens
                    </div>
                    @endif';

$newContent = preg_replace($pattern, $replacement, $content);

if ($newContent === $content) {
    echo "❌ Le pattern n'a pas été trouvé. Tentative alternative...\n";
    
    // Alternative: chercher juste la première ligne et remplacer la section
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);
    $startLine = -1;
    
    for ($i = 0; $i < count($lines); $i++) {
        if (strpos($lines[$i], 'd-flex gap-2 mt-2') !== false && strpos($lines[$i], 'customer.show') !== false) {
            $startLine = $i;
            break;
        }
    }
    
    if ($startLine === -1) {
        echo "❌ Impossible de trouver la section à corriger\n";
        echo "🔍 Recherche de 'd-flex gap-2 mt-2'...\n";
        for ($i = 850; $i < min(870, count($lines)); $i++) {
            echo sprintf("Ligne %d: %s\n", $i + 1, $lines[$i]);
        }
        exit(1);
    }
    
    echo "📍 Section trouvée à la ligne " . ($startLine + 1) . "\n";
    
    // Remplacer manuellement les lignes
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
    
    // Sauter les anciennes lignes (8 lignes)
    $newLines = array_merge($newLines, array_slice($lines, $startLine + 8));
    
    $newContent = implode("\n", $newLines);
}

// Écrire le fichier corrigé
if (file_put_contents($filePath, $newContent)) {
    echo "✅ Fichier corrigé avec succès !\n";
    echo "🔧 Correction appliquée : Ajout de la condition @if(\$transaction->customer)\n";
    echo "🌐 Accédez à : http://127.0.0.1:8001/transaction/13\n";
    echo "🎯 Le problème de route manquante est maintenant résolu !\n";
} else {
    echo "❌ Erreur lors de l'écriture du fichier\n";
    exit(1);
}

?>
