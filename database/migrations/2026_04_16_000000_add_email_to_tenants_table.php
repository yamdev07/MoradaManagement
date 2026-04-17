<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tenants')) {
            return;
        }

        Schema::table('tenants', function (Blueprint $table) {
            if (!Schema::hasColumn('tenants', 'email')) {
                $table->string('email')->nullable()->unique()->after('domain');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('tenants')) {
            return;
        }

        Schema::table('tenants', function (Blueprint $table) {
            if (Schema::hasColumn('tenants', 'email')) {
                $table->dropUnique(['email']);
                $table->dropColumn('email');
            }
        });
    }
};
