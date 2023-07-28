<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTablasEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contactos', function (Blueprint $table) {
            $table->dropForeign(['cargo_id']);
            $table->dropForeign(['empresa_id']);
            
        });
        Schema::table('redes_sociales', function (Blueprint $table) {
            $table->dropForeign(['contacto_id']);
            
        });
        Schema::dropIfExists('cargos');
        Schema::dropIfExists('redes_sociales');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
