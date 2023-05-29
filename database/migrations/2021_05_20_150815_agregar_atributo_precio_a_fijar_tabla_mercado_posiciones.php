<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AgregarAtributoPrecioAFijarTablaMercadoPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_posiciones', function (Blueprint $table) {
           $table->boolean('a_fijar')->nullable()->default(0);
           $table->float('precio')->nullable()->change();
        });
        DB::statement("ALTER TABLE mercado_posiciones MODIFY COLUMN moneda ENUM('USD', 'AR$') NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
