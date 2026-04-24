<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

use App\Models\Tenant;

echo "=== CHECK TENANTS ===\n";

$tenants = Tenant::all();
echo "Total tenants: " . $tenants->count() . "\n\n";

foreach ($tenants as $tenant) {
    echo "ID: {$tenant->id}\n";
    echo "Name: {$tenant->name}\n";
    echo "Logo: " . ($tenant->logo ?? 'null') . "\n";
    echo "Domain: " . ($tenant->domain ?? 'null') . "\n";
    echo "Subdomain: " . ($tenant->subdomain ?? 'null') . "\n";
    echo "---\n";
}
