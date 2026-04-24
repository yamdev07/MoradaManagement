<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

// Simuler une requête de dashboard
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

echo "=== DEBUG TENANT ===\n";

// Vérifier si l'utilisateur est connecté
if (Auth::check()) {
    echo "Utilisateur connecté: " . Auth::user()->name . "\n";
    echo "User tenant_id: " . Auth::user()->tenant_id . "\n";
} else {
    echo "Aucun utilisateur connecté\n";
}

// Vérifier les tenants disponibles
$tenants = Tenant::all();
echo "\nTenants disponibles:\n";
foreach ($tenants as $tenant) {
    echo "- ID: {$tenant->id}, Name: {$tenant->name}, Logo: " . ($tenant->logo ?? 'non') . "\n";
}

// Vérifier la session
echo "\nSession selected_hotel_id: " . session('selected_hotel_id', 'non défini') . "\n";
