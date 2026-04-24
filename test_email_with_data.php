<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use App\Models\Tenant;
use App\Jobs\SendTenantApprovalEmail;

// Démarrer l'application Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Test d'envoi d'email avec données valides ===\n\n";

try {
    // Créer un tenant de test avec email valide
    $testTenant = Tenant::where('email', 'test@hotel.com')->first();
    if (!$testTenant) {
        echo "Création d'un tenant de test...\n";
        $testTenant = new Tenant();
        $testTenant->name = 'Hotel Test Email';
        $testTenant->subdomain = 'hotel-test-email';
        $testTenant->domain = 'hotel-test-email.com';
        $testTenant->email = 'test@hotel.com';
        $testTenant->phone = '+1234567890';
        $testTenant->address = '123 Test Street, Test City, Test Country';
        $testTenant->description = 'Hôtel de test pour les emails';
        $testTenant->is_active = false;
        $testTenant->status = 0;
        $testTenant->database_name = 'hotelio_test_email';
        $testTenant->database_user = 'hotelio_user_test_email';
        $testTenant->database_password = 'test_password_123';
        $testTenant->theme_settings = [
            'primary_color' => '#8b4513',
            'secondary_color' => '#d2b48c',
            'accent_color' => '#f59e0b'
        ];
        $testTenant->save();
        echo "✅ Tenant de test créé\n";
    } else {
        echo "✅ Tenant de test existant trouvé\n";
    }
    
    // Vérifier le Super Admin
    $superAdmin = User::where('role', 'Super')->first();
    echo "✅ Super Admin: {$superAdmin->name}\n";
    
    // Afficher les informations du test
    echo "\n--- Informations du test ---\n";
    echo "Tenant: {$testTenant->name} ({$testTenant->email})\n";
    echo "Super Admin: {$superAdmin->name} ({$superAdmin->email})\n";
    
    // Configuration email
    echo "\n--- Configuration email ---\n";
    echo "MAIL_MAILER: " . env('MAIL_MAILER') . "\n";
    echo "MAIL_HOST: " . env('MAIL_HOST') . "\n";
    echo "MAIL_PORT: " . env('MAIL_PORT') . "\n";
    echo "MAIL_USERNAME: " . env('MAIL_USERNAME') . "\n";
    echo "MAIL_FROM_ADDRESS: " . env('MAIL_FROM_ADDRESS') . "\n";
    
    // Dispatch du job
    echo "\n--- Dispatch du job d'email ---\n";
    SendTenantApprovalEmail::dispatch($testTenant, $superAdmin);
    echo "✅ Job dispatché avec succès!\n";
    
    // Vérifier la queue
    echo "\n--- Vérification de la queue ---\n";
    $queueSize = \Illuminate\Support\Facades\Queue::size();
    echo "Jobs en attente: {$queueSize}\n";
    
    echo "\n🎉 Test terminé avec succès!\n";
    echo "Pour traiter les emails, lancez: php artisan queue:work\n";
    echo "L'email sera envoyé à: {$testTenant->email}\n";
    
} catch (Exception $e) {
    echo "\n❌ Erreur: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}

echo "\n=== Fin du test ===\n";
