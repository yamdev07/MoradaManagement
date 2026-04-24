<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;

echo "=== CHECKING USERS TABLE ===\n";

try {
    $columns = DB::select("DESCRIBE users");
    
    echo "Columns in users table:\n";
    foreach ($columns as $column) {
        echo "- {$column->Field} ({$column->Type}) " . ($column->Null == 'NO' ? 'NOT NULL' : 'NULL') . "\n";
    }
    
    echo "\n=== CHECKING FOR DUPLICATE EMAIL ===\n";
    
    $email = 'majorelle@gmail.com';
    $users = DB::table('users')->where('email', $email)->get(['id', 'name', 'email', 'tenant_id']);
    
    echo "Users with email '{$email}':\n";
    foreach ($users as $user) {
        echo "- ID: {$user->id}, Name: {$user->name}, Email: {$user->email}, Tenant ID: " . ($user->tenant_id ?? 'null') . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
