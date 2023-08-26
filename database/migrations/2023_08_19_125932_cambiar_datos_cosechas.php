<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambiarDatosCosechas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('mercado_cosechas')->where('id', '3')->delete();
        DB::table('mercado_cosechas')->where('id', '1')->update(['descripcion' => '22/23']);
        DB::table('mercado_cosechas')->where('id', '2')->update(['descripcion' => '23/24']);
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
