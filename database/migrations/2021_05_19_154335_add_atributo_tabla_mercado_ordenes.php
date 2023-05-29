<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAtributoTablaMercadoOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('mercado_ordenes', function (Blueprint $table) {
           $table->unsignedBigInteger('establecimiento_id')->nullable();
           $table->foreign('establecimiento_id')->references('id')->on('establecimientos_empresa');
       });
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
