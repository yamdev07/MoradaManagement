<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;

echo "=== CHECKING TABLES ===\n";

try {
    $tables = DB::select('SHOW TABLES LIKE "performance_schema%"');
    
    if (empty($tables)) {
        echo "No performance_schema tables found\n";
    } else {
        echo "Found performance_schema tables:\n";
        foreach ($tables as $table) {
            echo "- " . $table->Tables_in_performance_schema . "\n";
        }
    }
    
    echo "\n=== CHECKING TENANTS TABLE ===\n";
    
    $tenants = DB::table('tenants')->limit(3)->get(['id', 'name', 'logo']);
    echo "Tenants in database:\n";
    foreach ($tenants as $tenant) {
        echo "ID: {$tenant->id}, Name: {$tenant->name}, Logo: " . ($tenant->logo ?? 'null') . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
