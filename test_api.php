<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== TEST API available-rooms ===\n\n";

// Test simple
try {
    echo "Test Carbon...\n";
    $checkIn = \Carbon\Carbon::parse('2026-04-18')->startOfDay();
    echo "Carbon OK: " . $checkIn->format('Y-m-d') . "\n";
    
    echo "Test Tenant...\n";
    $tenant = \App\Models\Tenant::find(3);
    echo "Tenant OK: " . ($tenant ? $tenant->name : 'Non trouvé') . "\n";
    
    echo "Test Rooms...\n";
    $rooms = \App\Models\Room::where('tenant_id', 3)->limit(1)->get();
    echo "Rooms OK: " . $rooms->count() . " chambre(s)\n";
    
    echo "Test app('current_hotel')...\n";
    $currentHotel = app('current_hotel');
    echo "Current Hotel: " . ($currentHotel ? $currentHotel->name : 'NULL') . "\n";
    
    echo "Test Session...\n";
    session(['selected_hotel_id' => 3]);
    echo "Session OK\n";
    
} catch (\Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
    echo "Fichier: " . $e->getFile() . " Ligne: " . $e->getLine() . "\n";
}

echo "\n=== FIN TEST ===\n";

?>
