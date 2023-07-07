<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarCampoOficinaId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign(['oficina_id']);
        });
    
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn('oficina_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
                $table->foreign('oficina_id')
                      ->references('id')
                      ->on('oficinas')
                      ->onDelete('cascade');
            });
        
            Schema::table('usuarios', function (Blueprint $table) {
                $table->addColumn('bigint unsigned', 'oficina_id');
            });
    }
}
