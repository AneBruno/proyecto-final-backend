<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambiarDefaultHabilitadoCondiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('condiciones_pago', function (Blueprint $table) {
            // Cambiar el valor por defecto del campo
            $table->boolean('habilitado')->default(1)->change();
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
            // Revertir el cambio y restaurar el valor por defecto original
            $table->boolean('habilitado')->default(0)->change();
        });
    }
}
