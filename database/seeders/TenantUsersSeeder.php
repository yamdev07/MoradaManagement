<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;
use Illuminate\Support\Facades\Schema;

class TenantUsersSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('tenants')) {
            return;
        }

        $tenants = Tenant::where('status', 1)->get();

        foreach ($tenants as $tenant) {
            // ton code ici
        }
    }
}