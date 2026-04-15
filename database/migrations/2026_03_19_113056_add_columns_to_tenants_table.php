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
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('domain')->nullable()->after('name');
            $table->string('contact_email')->nullable()->after('domain');
            $table->string('contact_phone')->nullable()->after('contact_email');
            $table->boolean('is_active')->default(true)->after('contact_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn(['domain', 'contact_email', 'contact_phone', 'is_active']);
        });
    }
};
