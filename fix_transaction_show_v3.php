<?php

// Script pour corriger le problème de route manquante dans transaction/show.blade.php

$filePath = 'resources/views/transaction/show.blade.php';
$backupPath = 'resources/views/transaction/show.blade.php.backup.' . date('Y-m-d-H-i-s');

// Lire le fichier
$content = file_get_contents($filePath);
if (!$content) {
    echo "Impossible de lire le fichier $filePath\n";
    exit(1);
}

// Créer une sauvegarde
file_put_contents($backupPath, $content);

echo "📁 Sauvegarde créée : $backupPath\n";

// Ancien code à remplacer (exactement comme dans le fichier avec les retours à la ligne)
$oldCode = '                    <div class="d-flex gap-2 mt-2">
                        <a href="{{ route(\'customer.show\', $transaction->customer) }}" class="btn-modern btn-outline-modern btn-sm">
                            <i class="fas fa-eye me-1"></i>Voir profil
                        </a>
                        <a href="{{ route(\'transaction.reservation.customerReservations\', $transaction->customer) }}" class="btn-modern btn-outline-modern btn-sm">
                            <i class="fas fa-history me-1"></i>Historique
                        </a>
                    </div>';

// Nouveau code corrigé
$newCode = '@if($transaction->customer)
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

// Remplacer le code
$newContent = str_replace($oldCode, $newCode, $content);

if ($newContent === $content) {
    echo "❌ Aucune modification n'a été apportée.\n";
    echo "Le code à remplacer n'a pas été trouvé exactement.\n";
    
    // Afficher les lignes autour du problème pour débogage
    $lines = file($filePath);
    echo "\n🔍 Contenu autour de la ligne 856 :\n";
    for ($i = 854; $i <= 862; $i++) {
        if (isset($lines[$i])) {
            echo sprintf("%d: %s", $i + 1, $lines[$i]);
        }
    }
    
    echo "\n🔧 Tentative avec un format différent...\n";
    
    // Essayer avec le format exact montré dans la sortie
    $oldCode2 = "                    <div class=\"d-flex gap-2 mt-2\">\n                        <a href=\"{{ route('customer.show', \$transaction->customer) }}\" class=\"btn-modern btn-outline-modern btn-sm\">\n                            <i class=\"fas fa-eye me-1\"></i>Voir profil\n                        </a>\n                        <a href=\"{{ route('transaction.reservation.customerReservations', \$transaction->customer) }}\" class=\"btn-modern btn-outline-modern btn-sm\">\n                            <i class=\"fas fa-history me-1\"></i>Historique\n                        </a>\n                    </div>";
    
    $newContent2 = str_replace($oldCode2, $newCode, $content);
    
    if ($newContent2 !== $content) {
        if (file_put_contents($filePath, $newContent2)) {
            echo "✅ Fichier corrigé avec succès (format 2) !\n";
            echo "🔧 Correction appliquée : Ajout de la condition @if(\$transaction->customer)\n";
            echo "🌐 Accédez à : http://127.0.0.1:8001/transaction/13\n";
            echo "🎯 Le problème de route manquante est maintenant résolu !\n";
            exit(0);
        }
    }
    
    exit(1);
}

// Écrire le nouveau contenu
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
