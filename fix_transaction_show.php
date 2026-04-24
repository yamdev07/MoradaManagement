<?php

// Script pour corriger le problème de route manquante dans transaction/show.blade.php

$filePath = 'resources/views/transaction/show.blade.php';
$backupPath = 'resources/views/transaction/show.blade.php.backup';

// Lire le fichier
$content = file_get_contents($filePath);
if (!$content) {
    echo "Impossible de lire le fichier $filePath\n";
    exit(1);
}

// Créer une sauvegarde
file_put_contents($backupPath, $content);

// Ancien code à remplacer
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
    echo "Aucune modification n'a été apportée. Le code à remplacer n'a pas été trouvé.\n";
    echo "Vérifiez que le fichier contient exactement le code attendu.\n";
    exit(1);
}

// Écrire le nouveau contenu
if (file_put_contents($filePath, $newContent)) {
    echo "✅ Fichier corrigé avec succès !\n";
    echo "📁 Sauvegarde créée : $backupPath\n";
    echo "🔧 Correction appliquée : Ajout de la condition @if(\$transaction->customer)\n";
    echo "🌐 Accédez à : http://127.0.0.1:8001/transaction/13\n";
} else {
    echo "❌ Erreur lors de l'écriture du fichier\n";
    exit(1);
}

?>
