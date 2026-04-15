<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;
use App\Models\User;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer deux tenants de test
        $tenant1 = Tenant::create([
            'name' => 'Hôtel Cactus Palace - Bénin',
            'subdomain' => 'benin',
            'database_name' => 'morada_benin',
            'database_user' => 'morada_user',
            'database_password' => 'password123',
        ]);

        $tenant2 = Tenant::create([
            'name' => 'Hôtel Cactus Palace - Côte d\'Ivoire',
            'subdomain' => 'cotedivoire',
            'database_name' => 'morada_cotedivoire',
            'database_user' => 'morada_user',
            'database_password' => 'password123',
        ]);

        // Mettre à jour l'utilisateur admin existant pour le tenant 1
        $adminUser = User::where('email', 'admin@cactuspalace.com')->first();
        if ($adminUser) {
            $adminUser->update(['tenant_id' => $tenant1->id]);
        }

        // Créer des utilisateurs de test pour chaque tenant
        User::create([
            'name' => 'Admin Bénin',
            'email' => 'admin-bj@cactuspalace.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'tenant_id' => $tenant1->id,
            'random_key' => Str::random(32),
        ]);

        User::create([
            'name' => 'Admin Côte d\'Ivoire',
            'email' => 'admin-ci@cactuspalace.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'tenant_id' => $tenant2->id,
            'random_key' => Str::random(32),
        ]);

        $this->command->info('✅ Tenants créés avec succès!');
        $this->command->info('📧 Comptes de test:');
        $this->command->info('   - Bénin: admin-bj@cactuspalace.com / password');
        $this->command->info('   - Côte d\'Ivoire: admin-ci@cactuspalace.com / password');
    }
}
