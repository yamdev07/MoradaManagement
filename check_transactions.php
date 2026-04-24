<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;

echo "=== CHECKING TRANSACTIONS TABLE STRUCTURE ===\n";

try {
    $columns = DB::select("DESCRIBE transactions");
    
    echo "Columns in transactions table:\n";
    foreach ($columns as $column) {
        echo "- {$column->Field} ({$column->Type}) " . ($column->Null == 'NO' ? 'NOT NULL' : 'NULL') . "\n";
    }
    
    echo "\n=== CHECKING LATEST TRANSACTIONS ===\n";
    
    $transactions = DB::table('transactions')->limit(3)->get(['id', 'user_id', 'customer_id', 'room_id', 'status', 'created_at']);
    echo "Latest transactions:\n";
    foreach ($transactions as $transaction) {
        echo "ID: {$transaction->id}, User: {$transaction->user_id}, Customer: {$transaction->customer_id}, Room: {$transaction->room_id}, Status: {$transaction->status}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
