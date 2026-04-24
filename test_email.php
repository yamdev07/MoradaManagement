<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use App\Models\Tenant;
use App\Jobs\SendTenantApprovalEmail;
use Illuminate\Support\Facades\Mail;

// Démarrer l'application Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Test d'envoi d'email ===\n\n";

try {
    // Vérifier qu'il y a un Super Admin
    $superAdmin = User::where('role', 'Super')->first();
    echo "Super Admin trouvé: " . ($superAdmin ? $superAdmin->name : 'Non trouvé') . "\n";
    
    // Vérifier qu'il y a un tenant
    $tenant = Tenant::first();
    echo "Tenant trouvé: " . ($tenant ? $tenant->name : 'Non trouvé') . "\n";
    
    if ($superAdmin && $tenant) {
        echo "\n--- Test d'envoi d'email ---\n";
        echo "Tenant: {$tenant->name} ({$tenant->email})\n";
        echo "Super Admin: {$superAdmin->name} ({$superAdmin->email})\n";
        
        // Tester la configuration email
        echo "\nConfiguration email:\n";
        echo "MAIL_MAILER: " . env('MAIL_MAILER') . "\n";
        echo "MAIL_HOST: " . env('MAIL_HOST') . "\n";
        echo "MAIL_PORT: " . env('MAIL_PORT') . "\n";
        echo "MAIL_USERNAME: " . env('MAIL_USERNAME') . "\n";
        echo "MAIL_FROM_ADDRESS: " . env('MAIL_FROM_ADDRESS') . "\n";
        
        // Dispatch du job
        echo "\n--- Dispatch du job d'email ---\n";
        SendTenantApprovalEmail::dispatch($tenant, $superAdmin);
        echo "✅ Job dispatché avec succès!\n";
        
        // Vérifier la queue
        echo "\n--- Vérification de la queue ---\n";
        $queueSize = \Illuminate\Support\Facades\Queue::size();
        echo "Jobs en attente: {$queueSize}\n";
        
        echo "\n✅ Test terminé avec succès!\n";
        echo "Pour traiter les emails, lancez: php artisan queue:work\n";
        
    } else {
        echo "\n❌ Données manquantes:\n";
        if (!$superAdmin) echo "- Aucun Super Admin trouvé\n";
        if (!$tenant) echo "- Aucun Tenant trouvé\n";
        echo "\nCréez d'abord les données nécessaires.\n";
    }
    
} catch (Exception $e) {
    echo "\n❌ Erreur: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}

echo "\n=== Fin du test ===\n";
