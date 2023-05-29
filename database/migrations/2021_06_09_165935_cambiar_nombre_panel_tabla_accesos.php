<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CambiarNombrePanelTablaAccesos extends Migration
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
                grupo = 'Panel'
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
                grupo = 'Panel de Mercado'
            WHERE nombre = 'Panel'
        ");
    }
}
