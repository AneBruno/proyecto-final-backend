<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixOrdenamientoTablaAccesos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            UPDATE accesos SET
                orden = null
            WHERE nombre = 'Categorías'
        ");

        DB::statement("
            UPDATE accesos SET
                orden = 5
            WHERE nombre = 'Tipos de producto'
        ");

        DB::statement("
            UPDATE accesos SET
                orden = 9
            WHERE nombre = 'Puertos'
        ");


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
