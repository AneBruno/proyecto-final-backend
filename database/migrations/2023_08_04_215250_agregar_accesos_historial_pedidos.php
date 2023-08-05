<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarAccesosHistorialPedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('accesos')->insert([
            'nombre' => 'Historial de pedidos',
            'grupo' => 'Mercado',
            'uri' => 'mercado/historial',
            'tipo' => 'menu',
            'orden' => '4'
        ]);

   
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
