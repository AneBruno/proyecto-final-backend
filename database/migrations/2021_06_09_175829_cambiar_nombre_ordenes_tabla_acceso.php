<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CambiarNombreOrdenesTablaAcceso extends Migration
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
                nombre = 'Órdenes de venta'
            WHERE nombre = 'Órdenes'
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
                nombre = 'Órdenes'
            WHERE nombre = 'Órdenes de venta'
        ");
    }
}
