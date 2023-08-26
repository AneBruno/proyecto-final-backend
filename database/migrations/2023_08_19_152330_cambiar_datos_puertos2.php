<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambiarDatosPuertos2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('puertos')->where('id', '2')->update(['localidad' => 'Rosario']);
        DB::table('puertos')->where('id', '2')->update(['provincia' => 'Santa Fe']);
        DB::table('puertos')->where('id', '4')->update(['localidad' => 'Quequén']);
        DB::table('puertos')->where('id', '4')->update(['provincia' => 'Buenos Aires']);
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
