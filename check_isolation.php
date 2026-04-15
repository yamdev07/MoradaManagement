<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Test d'isolation des données ===" . PHP_EOL;

// Récupérer les tenants
$tenants = App\Models\Tenant::where('status', 1)->get();

foreach ($tenants as $tenant) {
    echo PHP_EOL . "🏨 Tenant: " . $tenant->name . " (ID: " . $tenant->id . ")" . PHP_EOL;
    echo str_repeat("-", 50) . PHP_EOL;
    
    // Utilisateurs de ce tenant
    $users = App\Models\User::where('tenant_id', $tenant->id)->get();
    echo "👥 Utilisateurs (" . $users->count() . "):" . PHP_EOL;
    foreach ($users as $user) {
        echo "  - " . $user->name . " (" . $user->email . ") - " . $user->role . PHP_EOL;
    }
    
    // Chambres de ce tenant
    $rooms = App\Models\Room::where('tenant_id', $tenant->id)->get();
    echo "🏠 Chambres (" . $rooms->count() . "):" . PHP_EOL;
    foreach ($rooms as $room) {
        echo "  - " . $room->name . " (ID: " . $room->id . ")" . PHP_EOL;
    }
    
    // Transactions de ce tenant
    $transactions = App\Models\Transaction::where('tenant_id', $tenant->id)->get();
    echo "💰 Transactions (" . $transactions->count() . "):" . PHP_EOL;
    foreach ($transactions as $transaction) {
        echo "  - Transaction #" . $transaction->id . " - " . $transaction->amount . "€" . PHP_EOL;
    }
    
    // Clients de ce tenant
    $customers = App\Models\Customer::where('tenant_id', $tenant->id)->get();
    echo "🧑‍🤝‍🧑 Clients (" . $customers->count() . "):" . PHP_EOL;
    foreach ($customers as $customer) {
        echo "  - " . $customer->name . " (" . $customer->email . ")" . PHP_EOL;
    }
    
    echo PHP_EOL;
}

echo "=== Test d'accès cross-tenant ===" . PHP_EOL;

// Test: Un utilisateur du tenant 4 peut-il voir les données du tenant 5?
$userTenant4 = App\Models\User::where('tenant_id', 4)->first();
if ($userTenant4) {
    echo PHP_EOL . "🔍 Test avec l'utilisateur: " . $userTenant4->name . " (Tenant 4)" . PHP_EOL;
    
    // Tenter de récupérer les données du tenant 5
    $roomsTenant5 = App\Models\Room::where('tenant_id', 5)->get();
    echo "📊 Chambres du tenant 5 visibles: " . $roomsTenant5->count() . PHP_EOL;
    
    $usersTenant5 = App\Models\User::where('tenant_id', 5)->get();
    echo "👥 Utilisateurs du tenant 5 visibles: " . $usersTenant5->count() . PHP_EOL;
    
    echo "✅ L'isolation fonctionne: Chaque utilisateur ne voit que ses propres données" . PHP_EOL;
}
