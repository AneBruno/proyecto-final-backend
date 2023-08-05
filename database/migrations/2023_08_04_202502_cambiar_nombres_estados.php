<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambiarNombresEstados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('mercado_ordenes_estados')->where('id', 1)->update(['nombre' => 'Activa']);
        DB::table('mercado_ordenes_estados')->where('id', 3)->update(['nombre' => 'Confirmada']);
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
