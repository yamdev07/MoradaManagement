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
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'actual_check_in')) {
                $table->datetime('actual_check_in')->nullable()->after('check_in_time');
            }
            if (!Schema::hasColumn('transactions', 'actual_check_out')) {
                $table->datetime('actual_check_out')->nullable()->after('check_out_time');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['actual_check_in', 'actual_check_out']);
        });
    }
};
