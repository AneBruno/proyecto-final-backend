<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AgregarSeederOrdenesEstados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('mercado_ordenes_estados')->insert([
            [
                'id' => 1,
                'nombre' => 'Oferta a trabajar',
            ],
            [
                'id' => 2,
                'nombre' => 'Orden firme'
            ],
            [
                'id' => 3,
                'nombre' => 'Confirmada (Slip)'
            ],
            [
                'id' => 4,
                'nombre' => 'Baja'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('mercado_ordenes_estados')->truncate();
    }
}
