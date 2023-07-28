<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTablasSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropForeign(['usuario_rol_id']);
            $table->dropForeign(['estado_id']);
            
        });
        Schema::table('solicitudes_formas_pago', function (Blueprint $table) {
            $table->dropForeign(['solicitud_id']);
            
        });
        Schema::dropIfExists('solicitudes');
        Schema::dropIfExists('estados_solicitudes');
        Schema::dropIfExists('solicitudes_formas_pago');
        
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
