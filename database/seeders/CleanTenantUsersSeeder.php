<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CleanTenantUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer tous les tenants actifs
        $tenants = Tenant::where('status', 1)->get();

        foreach ($tenants as $tenant) {
            // Nettoyer le nom du tenant pour l'email
            $cleanName = $this->cleanTenantName($tenant->name);
            
            // Créer un administrateur pour ce tenant
            $adminEmail = 'admin-' . $tenant->id . '@' . $cleanName . '.com';
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
            $receptionEmail = 'reception-' . $tenant->id . '@' . $cleanName . '.com';
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

    private function cleanTenantName($name)
    {
        // Remplacer les caractères spéciaux et espaces
        $clean = str_replace([' ', 'é', 'è', 'ê', 'ë', 'î', 'ï', 'ô', 'ö', 'ù', 'û', 'ü', 'â', 'ä', 'à', 'ç', 'ñ', '-'], ['', 'e', 'e', 'e', 'e', 'i', 'i', 'o', 'o', 'u', 'u', 'u', 'a', 'a', 'a', 'c', 'n', ''], strtolower($name));
        $clean = preg_replace('/[^a-z0-9]/', '', $clean);
        return $clean;
    }
}
