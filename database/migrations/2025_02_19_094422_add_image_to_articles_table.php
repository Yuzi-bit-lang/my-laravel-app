<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Vérifier si la colonne 'image' existe déjà avant d'essayer de l'ajouter
        if (!Schema::hasColumn('articles', 'image')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->string('image')->nullable()->after('instruction');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('image'); // Supprime la colonne image si on rollback la migration
        });
    }
}
