<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarCamposProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('uso_frecuente');
            $table->dropColumn('unidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->varchar(255)('uso_frecuente');
        });

        DB::statement("ALTER TABLE productos ADD unidad ENUM('TONELADAS', 'UNIDADES')");
    }
}
