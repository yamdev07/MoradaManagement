<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    if (!Schema::hasTable('tenants')) {
        return;
    }

    Schema::table('tenants', function (Blueprint $table) {
        $table->string('domain')->nullable();
    });
}

public function down(): void
{
    if (!Schema::hasTable('tenants')) {
        return;
    }

    Schema::table('tenants', function (Blueprint $table) {
        $table->dropColumn('domain');
    });
}
}


