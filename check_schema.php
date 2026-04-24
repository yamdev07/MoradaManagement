<?php

require_once __DIR__ . '/vendor/autoload.php';

// Démarrer l'application Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Colonnes de la table tenants ===\n";
$columns = Illuminate\Support\Facades\Schema::getColumnListing('tenants');
foreach ($columns as $column) {
    echo "- $column\n";
}

echo "\n=== Colonnes de la table users ===\n";
$usersColumns = Illuminate\Support\Facades\Schema::getColumnListing('users');
foreach ($usersColumns as $column) {
    echo "- $column\n";
}
