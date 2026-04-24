<?php

require_once __DIR__ . '/vendor/autoload.php';

// Démarrer l'application Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Colonnes de la table transactions ===\n";
$columns = Illuminate\Support\Facades\Schema::getColumnListing('transactions');
foreach ($columns as $column) {
    echo "- $column\n";
}
