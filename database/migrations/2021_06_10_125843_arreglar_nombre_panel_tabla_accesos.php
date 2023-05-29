<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ArreglarNombrePanelTablaAccesos extends Migration
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
            WHERE nombre = 'Panel Mercado + CRM'
        ");

        DB::statement("
            UPDATE accesos SET
                nombre = 'Panel de Mercado'
            WHERE nombre = 'Panel'
        ");

        DB::statement("
            UPDATE accesos SET
                orden = 1
            WHERE nombre = 'Panel de Mercado'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
            UPDATE accesos SET
                orden = 1
            WHERE nombre = 'Panel Mercado + CRM'
        ");

        DB::statement("
            UPDATE accesos SET
                nombre = 'Panel'
            WHERE nombre = 'Panel de Mercado'
        ");

        DB::statement("
            UPDATE accesos SET
                orden = null
            WHERE nombre = 'Panel'
        ");
    }
}
