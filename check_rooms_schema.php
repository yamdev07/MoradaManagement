<?php

require_once __DIR__ . '/vendor/autoload.php';

// Démarrer l'application Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Colonnes de la table rooms ===\n";
$columns = Illuminate\Support\Facades\Schema::getColumnListing('rooms');
foreach ($columns as $column) {
    echo "- $column\n";
}
