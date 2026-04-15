<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Créer un tenant de test
    $tenant = new \App\Models\Tenant();
    $tenant->name = 'Hôtel Azure Paradise';
    $tenant->subdomain = 'azure-paradise';
    $tenant->domain = 'azure-paradise.morada.com';
    $tenant->database_name = 'morada_azure_paradise';
    $tenant->database_user = 'azure_paradise_user';
    $tenant->database_password = 'azure_paradise_password_2024';
    $tenant->email = 'contact@azure-paradise.morada.com';
    $tenant->phone = '+225 27 20 30 40 50';
    $tenant->address = 'Plateau, Abidjan, Côte d\'Ivoire';
    $tenant->description = 'Hôtel de luxe avec vue sur l\'océan, service premium et spa moderne';
    $tenant->theme_settings = [
        'primary_color' => '#0066cc',
        'secondary_color' => '#004499',
        'accent_color' => '#3399ff',
        'background_color' => '#f0f8ff',
        'text_color' => '#003366',
        'font_family' => 'Montserrat',
        'logo_position' => 'center',
        'show_stats' => true,
        'enable_booking' => true,
        'enable_restaurant' => true
    ];
    $tenant->is_active = false; // En attente d'approbation
    $tenant->status = 0;
    $tenant->save();

    // Créer un utilisateur admin pour ce tenant
    $user = new \App\Models\User();
    $user->name = 'Admin Azure Paradise';
    $user->email = 'admin@azure-paradise.morada.com';
    $user->password = \Hash::make('admin123');
    $user->role = 'admin';
    $user->tenant_id = $tenant->id;
    $user->random_key = \Str::random(32);
    $user->email_verified_at = now();
    $user->save();

    echo "✅ Tenant de test créé avec succès !\n";
    echo "📋 Nom: {$tenant->name}\n";
    echo "🆔 ID: {$tenant->id}\n";
    echo "🎨 Thème: Couleurs bleues Azure\n";
    echo "👤 Admin: admin@azure-paradise.morada.com / admin123\n";
    echo "📝 Statut: En attente d'approbation\n";
    echo "\n🌐 Accès Super Admin: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "📝 Le tenant apparaîtra dans la section 'Demandes d'Inscription en Attente'\n";

} catch (\Exception $e) {
    echo "❌ Erreur lors de la création du tenant: " . $e->getMessage() . "\n";
}
