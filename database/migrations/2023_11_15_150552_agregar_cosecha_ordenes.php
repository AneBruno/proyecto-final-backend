<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarCosechaOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('mercado_ordenes', function (Blueprint $table) {
            // Agregar el nuevo campo cosecha_id
            $table->unsignedBigInteger('cosecha_id');

            // Definir la clave foránea
            $table->foreign('cosecha_id')->references('id')->on('mercado_cosechas')->onDelete('set null');
        });*/
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
