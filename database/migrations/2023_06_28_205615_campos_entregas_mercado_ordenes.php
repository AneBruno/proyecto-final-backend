<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CamposEntregasMercadoOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_ordenes', function (Blueprint $table) {
            
            $table->date('fecha_entrega_inicio')->nullable()->change();
            $table->date('fecha_entrega_fin')->nullable()->change();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mercado_ordenes', function (Blueprint $table) {
            
            $table->date('fecha_entrega_inicio')->nullable(false)->change();
            $table->date('fecha_entrega_fin')->nullable(false)->change();
    });
    }
}
