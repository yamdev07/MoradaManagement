<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Vérification des utilisateurs par tenant ===" . PHP_EOL;

$users = App\Models\User::whereNotNull('tenant_id')->get();

foreach ($users as $user) {
    $tenant = App\Models\Tenant::find($user->tenant_id);
    echo sprintf(
        "ID: %d | Email: %s | Rôle: %s | Tenant: %s (ID: %d)" . PHP_EOL,
        $user->id,
        $user->email,
        $user->role,
        $tenant ? $tenant->name : 'Inconnu',
        $user->tenant_id
    );
}

echo PHP_EOL . "=== Total utilisateurs: " . $users->count() . " ===" . PHP_EOL;
