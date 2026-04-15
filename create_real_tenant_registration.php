<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Simuler une inscription complète via le contrôleur
    $tenantRegistrationController = new \App\Http\Controllers\TenantRegistrationController();
    
    // Données du formulaire d'inscription
    $registrationData = [
        'name' => 'Hôtel Royal Palace',
        'subdomain' => 'royal-palace',
        'domain' => 'royal-palace.morada.com',
        'database_name' => 'morada_royal_palace',
        'database_user' => 'royal_palace_user',
        'database_password' => 'royal_palace_password_2024',
        'email' => 'contact@royal-palace.morada.com',
        'phone' => '+225 27 20 30 40 60',
        'address' => 'Cocody, Abidjan, Côte d\'Ivoire',
        'description' => 'Hôtel 5 étoiles de luxe avec services premium et spa moderne',
        'admin_name' => 'Admin Royal Palace',
        'admin_email' => 'admin@royal-palace.morada.com',
        'admin_password' => 'admin123',
        'theme_settings' => [
            'primary_color' => '#8b0000',
            'secondary_color' => '#600000',
            'accent_color' => '#ff4444',
            'background_color' => '#fff5f5',
            'text_color' => '#330000',
            'font_family' => 'Playfair Display',
            'logo_position' => 'center',
            'show_stats' => true,
            'enable_booking' => true,
            'enable_restaurant' => true
        ]
    ];

    // Créer le tenant
    $tenant = new \App\Models\Tenant();
    $tenant->fill($registrationData);
    $tenant->is_active = false; // En attente d'approbation
    $tenant->status = 0;
    $tenant->save();

    // Créer l'utilisateur admin
    $user = new \App\Models\User();
    $user->name = $registrationData['admin_name'];
    $user->email = $registrationData['admin_email'];
    $user->password = \Hash::make($registrationData['admin_password']);
    $user->role = 'admin';
    $user->tenant_id = $tenant->id;
    $user->random_key = \Str::random(32);
    $user->email_verified_at = now();
    $user->save();

    echo "✅ Inscription complète créée avec succès !\n";
    echo "📋 Nom: {$tenant->name}\n";
    echo "🆔 ID: {$tenant->id}\n";
    echo "🎨 Thème: Couleurs rouges royales\n";
    echo "👤 Admin: {$registrationData['admin_email']} / {$registrationData['admin_password']}\n";
    echo "📝 Statut: En attente d'approbation\n";
    echo "🌐 Formulaire: Simulation d'inscription via formulaire\n";
    echo "\n🎯 Ce tenant apparaîtra maintenant dans 'Inscriptions Complètes en Attente'\n";
    echo "🌐 Accès Super Admin: http://127.0.0.1:8000/super-admin/dashboard\n";

} catch (\Exception $e) {
    echo "❌ Erreur lors de la création: " . $e->getMessage() . "\n";
}
