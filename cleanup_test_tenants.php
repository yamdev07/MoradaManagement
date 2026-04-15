<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Trouver les tenants sans utilisateur admin (créations manuelles)
    $tenants = \App\Models\Tenant::where('is_active', false)
        ->whereDoesntHave('users', function($query) {
            $query->where('role', 'admin');
        })
        ->get();

    echo "Tenants à supprimer: " . $tenants->count() . "\n";
    
    foreach ($tenants as $tenant) {
        echo "Suppression de: " . $tenant->name . " (ID: " . $tenant->id . ")\n";
        $tenant->delete();
    }
    
    echo "✅ Nettoyage terminé.\n";
    echo "\n📋 Seuls les tenants avec inscription complète apparaîtront maintenant.\n";
    echo "🌐 Accès Super Admin: http://127.0.0.1:8000/super-admin/dashboard\n";

} catch (\Exception $e) {
    echo "❌ Erreur lors du nettoyage: " . $e->getMessage() . "\n";
}
