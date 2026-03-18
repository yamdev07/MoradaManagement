<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingTransactionColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Vérifier si les colonnes existent avant de les ajouter
            if (!Schema::hasColumn('transactions', 'total_price')) {
                $table->decimal('total_price', 10, 2)->nullable();
            }
            
            if (!Schema::hasColumn('transactions', 'total_payment')) {
                $table->decimal('total_payment', 10, 2)->default(0);
            }
            
            if (!Schema::hasColumn('transactions', 'notes')) {
                $table->text('notes')->nullable();
            }
            
            if (!Schema::hasColumn('transactions', 'person_count')) {
                $table->integer('person_count')->default(1);
            }
            
            if (!Schema::hasColumn('transactions', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'total_price')) {
                $table->dropColumn('total_price');
            }
            
            if (Schema::hasColumn('transactions', 'total_payment')) {
                $table->dropColumn('total_payment');
            }
            
            if (Schema::hasColumn('transactions', 'notes')) {
                $table->dropColumn('notes');
            }
            
            if (Schema::hasColumn('transactions', 'person_count')) {
                $table->dropColumn('person_count');
            }
            
            if (Schema::hasColumn('transactions', 'created_by')) {
                $table->dropColumn('created_by');
            }
        });
    }
}
