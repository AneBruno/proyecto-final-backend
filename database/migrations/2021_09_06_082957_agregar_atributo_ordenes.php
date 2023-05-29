<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarAtributoOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_ordenes', function(Blueprint $table) {
            $table->enum('entrega', ['DISPONIBLE', 'LIMIT', 'CONTRACTUAL', 'FORWARD'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mercado_ordenes', function(Blueprint $table) {
            $table->dropColumn('entrega');
        });
    }
}
