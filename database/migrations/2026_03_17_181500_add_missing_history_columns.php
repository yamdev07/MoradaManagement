<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingHistoryColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('histories', function (Blueprint $table) {
            // Vérifier si les colonnes existent avant de les ajouter
            if (!Schema::hasColumn('histories', 'transaction_id')) {
                $table->unsignedBigInteger('transaction_id')->nullable();
            }
            
            if (!Schema::hasColumn('histories', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
            }
            
            if (!Schema::hasColumn('histories', 'action')) {
                $table->string('action')->nullable();
            }
            
            if (!Schema::hasColumn('histories', 'description')) {
                $table->text('description')->nullable();
            }
            
            if (!Schema::hasColumn('histories', 'old_values')) {
                $table->json('old_values')->nullable();
            }
            
            if (!Schema::hasColumn('histories', 'new_values')) {
                $table->json('new_values')->nullable();
            }
            
            if (!Schema::hasColumn('histories', 'notes')) {
                $table->text('notes')->nullable();
            }
            
            // Ajouter les contraintes de clés étrangères si nécessaire
            if (Schema::hasColumn('histories', 'transaction_id')) {
                $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            }
            
            if (Schema::hasColumn('histories', 'user_id')) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::table('histories', function (Blueprint $table) {
            if (Schema::hasColumn('histories', 'transaction_id')) {
                $table->dropForeign(['transaction_id']);
                $table->dropColumn('transaction_id');
            }
            
            if (Schema::hasColumn('histories', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            
            if (Schema::hasColumn('histories', 'action')) {
                $table->dropColumn('action');
            }
            
            if (Schema::hasColumn('histories', 'description')) {
                $table->dropColumn('description');
            }
            
            if (Schema::hasColumn('histories', 'old_values')) {
                $table->dropColumn('old_values');
            }
            
            if (Schema::hasColumn('histories', 'new_values')) {
                $table->dropColumn('new_values');
            }
            
            if (Schema::hasColumn('histories', 'notes')) {
                $table->dropColumn('notes');
            }
        });
    }
}
