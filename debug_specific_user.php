<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;

echo "=== DEBUG SPECIFIC USER ===\n";

$email = 'majorelle@gmail.com';

try {
    echo "Recherche d'utilisateurs avec email '{$email}':\n";
    
    // Recherche de tous les utilisateurs avec cet email
    $users = DB::table('users')->where('email', $email)->get(['id', 'name', 'email', 'tenant_id', 'role', 'created_at']);
    
    if ($users->isEmpty()) {
        echo "Aucun utilisateur trouvé avec cet email.\n";
    } else {
        echo "Utilisateurs trouvés:\n";
        foreach ($users as $user) {
            echo "- ID: {$user->id}, Name: {$user->name}, Email: {$user->email}, Tenant ID: " . ($user->tenant_id ?? 'NULL') . ", Role: {$user->role}, Created: {$user->created_at}\n";
        }
    }
    
    echo "\n=== Vérification de la logique de recherche ===\n";
    
    $tenantId = 77;
    echo "Tenant ID utilisé: {$tenantId}\n";
    
    // Test de la requête exacte utilisée dans le code
    $existingUser = DB::table('users')
        ->where('email', $email)
        ->where(function($query) use ($tenantId) {
            if ($tenantId) {
                $query->where('tenant_id', $tenantId);
            } else {
                $query->whereNull('tenant_id');
            }
        })
        ->first();
    
    if ($existingUser) {
        echo "✅ Utilisateur trouvé avec la logique actuelle: ID {$existingUser->id}, Tenant ID: " . ($existingUser->tenant_id ?? 'NULL') . "\n";
    } else {
        echo "❌ Aucun utilisateur trouvé avec la logique actuelle\n";
    }
    
    echo "\n=== Test avec tenant_id = 77 ===\n";
    $userWithTenantId = DB::table('users')->where('email', $email)->where('tenant_id', 77)->first();
    if ($userWithTenantId) {
        echo "✅ Utilisateur trouvé avec tenant_id=77: ID {$userWithTenantId->id}\n";
    } else {
        echo "❌ Aucun utilisateur trouvé avec tenant_id=77\n";
    }
    
    echo "\n=== Test avec tenant_id = NULL ===\n";
    $userWithoutTenantId = DB::table('users')->where('email', $email)->whereNull('tenant_id')->first();
    if ($userWithoutTenantId) {
        echo "✅ Utilisateur trouvé avec tenant_id=NULL: ID {$userWithoutTenantId->id}\n";
    } else {
        echo "❌ Aucun utilisateur trouvé avec tenant_id=NULL\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
