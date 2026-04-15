<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TenantUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer tous les tenants actifs
        $tenants = Tenant::where('status', 1)->get();

        foreach ($tenants as $tenant) {
            // Créer un administrateur pour ce tenant
            $adminEmail = 'admin-' . $tenant->id . '@' . str_replace(' ', '', strtolower($tenant->name)) . '.com';
            User::updateOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => 'Administrateur ' . $tenant->name,
                    'password' => Hash::make('admin' . $tenant->id . '2024'),
                    'role' => 'Admin',
                    'tenant_id' => $tenant->id,
                    'random_key' => Str::random(32),
                ]
            );

            // Créer un réceptionniste pour ce tenant
            $receptionEmail = 'reception-' . $tenant->id . '@' . str_replace(' ', '', strtolower($tenant->name)) . '.com';
            User::updateOrCreate(
                ['email' => $receptionEmail],
                [
                    'name' => 'Réceptionniste ' . $tenant->name,
                    'password' => Hash::make('reception' . $tenant->id . '2024'),
                    'role' => 'Receptionist',
                    'tenant_id' => $tenant->id,
                    'random_key' => Str::random(32),
                ]
            );

            // Afficher les identifiants créés
            $this->command->info("Tenant: {$tenant->name} (ID: {$tenant->id})");
            $this->command->info("  Admin: {$adminEmail} / admin{$tenant->id}2024");
            $this->command->info("  Reception: {$receptionEmail} / reception{$tenant->id}2024");
            $this->command->info("------------------------------------------------");
        }
    }
}
