<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "Testing database connection...\n";

try {
    $pdo = \DB::connection()->getPdo();
    echo "✅ Database connected successfully\n";
    
    // Test query
    $tenants = \DB::table('tenants')->where('status', 1)->get();
    echo "✅ Query executed successfully. Found " . $tenants->count() . " active tenants\n";
    
} catch (\Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    echo "Error details: " . $e->getTraceAsString() . "\n";
}
