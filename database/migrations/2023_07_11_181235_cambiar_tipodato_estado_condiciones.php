<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambiarTipodatoEstadoCondiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('condiciones_pago', function (Blueprint $table) {
            // Cambiar el tipo de dato y nombre del campo
            $table->tinyInteger('habilitado')->after('estado')->nullable(false)->default(0);
            $table->dropColumn('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('condiciones_pago', function (Blueprint $table) {
            // Revertir los cambios
            $table->enum('estado', ['Habilitado', 'Deshabilitado'])->after('habilitado')->nullable(false)->default('Habilitado');
            $table->dropColumn('habilitado');
        });
    }
}
