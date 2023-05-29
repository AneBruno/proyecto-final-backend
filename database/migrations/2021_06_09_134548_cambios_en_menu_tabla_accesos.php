<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CambiosEnMenuTablaAccesos extends Migration
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
                grupo = 'Mercado'
            WHERE nombre = 'Puertos'
        ");

        Schema::table('accesos', function(Blueprint $table) {
            $table->integer('orden')->nullable();
        });

        DB::statement("UPDATE accesos SET orden = 1 WHERE nombre = 'Panel Mercado + CRM'");
        DB::statement("UPDATE accesos SET orden = 2 WHERE nombre = 'Posiciones de compra'");
        DB::statement("UPDATE accesos SET orden = 3 WHERE nombre = 'Órdenes'");
        DB::statement("UPDATE accesos SET orden = 4 WHERE nombre = 'Calidades por producto'");
        DB::statement("UPDATE accesos SET orden = 5 WHERE nombre = 'Categorías'");
        DB::statement("UPDATE accesos SET orden = 6 WHERE nombre = 'Productos'");
        DB::statement("UPDATE accesos SET orden = 7 WHERE nombre = 'Condiciones de pago'");
        DB::statement("UPDATE accesos SET orden = 8 WHERE nombre = 'Cosechas'");
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
                grupo = 'Clientes'
            WHERE nombre = 'Puertos'
        ");

        Schema::table('accesos', function(Blueprint $table) {
            $table->dropColumn('orden');
        });
    }
}
