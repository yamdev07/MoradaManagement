# Script PowerShell pour corriger le problème de route manquante

$filePath = "resources\views\transaction\show.blade.php"
$backupPath = "resources\views\transaction\show.blade.php.backup.$(Get-Date -Format 'yyyy-MM-dd-HH-mm-ss')"

# Lire le fichier
$content = Get-Content -Path $filePath -Raw

# Créer une sauvegarde
$content | Set-Content -Path $backupPath
Write-Host "📁 Sauvegarde créée : $backupPath" -ForegroundColor Green

# Ancien code à remplacer
$oldCode = @"
                    <div class="d-flex gap-2 mt-2">
                        <a href="{{ route('customer.show', $transaction->customer) }}" class="btn-modern btn-outline-modern btn-sm">
                            <i class="fas fa-eye me-1"></i>Voir profil
                        </a>
                        <a href="{{ route('transaction.reservation.customerReservations', $transaction->customer) }}" class="btn-modern btn-outline-modern btn-sm">
                            <i class="fas fa-history me-1"></i>Historique
                        </a>
                    </div>
"@

# Nouveau code corrigé
$newCode = @"
@if($transaction->customer)
                    <div class="d-flex gap-2 mt-2">
                        <a href="{{ route('customer.show', $transaction->customer) }}" class="btn-modern btn-outline-modern btn-sm">
                            <i class="fas fa-eye me-1"></i>Voir profil
                        </a>
                        <a href="{{ route('transaction.reservation.customerReservations', $transaction->customer) }}" class="btn-modern btn-outline-modern btn-sm">
                            <i class="fas fa-history me-1"></i>Historique
                        </a>
                    </div>
                    @else
                    <div class="alert alert-warning mt-2">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Client non disponible - Impossible d'afficher les liens
                    </div>
                    @endif
"@

# Remplacer le code
$newContent = $content -replace [regex]::Escape($oldCode), $newCode

if ($newContent -eq $content) {
    Write-Host "❌ Aucune modification n'a été apportée." -ForegroundColor Red
    Write-Host "Le code à remplacer n'a pas été trouvé exactement." -ForegroundColor Red
    exit 1
}

# Écrire le nouveau contenu
$newContent | Set-Content -Path $filePath

Write-Host "✅ Fichier corrigé avec succès !" -ForegroundColor Green
Write-Host "🔧 Correction appliquée : Ajout de la condition @if(`$transaction->customer)" -ForegroundColor Green
Write-Host "🌐 Accédez à : http://127.0.0.1:8001/transaction/13" -ForegroundColor Green
Write-Host "🎯 Le problème de route manquante est maintenant résolu !" -ForegroundColor Green
