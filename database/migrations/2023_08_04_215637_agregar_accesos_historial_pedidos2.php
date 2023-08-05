<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarAccesosHistorialPedidos2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('accesos_roles')->insert([
            'rol_id' => '1',
            'acceso_id' => '35'
        ],
        [
            'rol_id' => '3',
            'acceso_id' => '35'
        ],
        [
            'rol_id' => '4',
            'acceso_id' => '35' 
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
