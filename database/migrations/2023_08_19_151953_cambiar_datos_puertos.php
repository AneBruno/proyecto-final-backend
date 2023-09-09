<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CambiarDatosPuertos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('puertos')->where('id', '2')->update(['nombre' => 'Rosario Sur']);
        DB::table('puertos')->where('id', '2')->update(['localidad' => 'Rosario']);
        DB::table('puertos')->where('id', '4')->update(['nombre' => 'Quequén/Necochea']);
        DB::table('puertos')->where('id', '2')->update(['localidad' => 'Quequén']);
        DB::table('puertos')->where('id', '2')->update(['provincia' => 'Buenos Aires']);
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
