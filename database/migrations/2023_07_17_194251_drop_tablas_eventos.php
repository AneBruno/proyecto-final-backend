<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTablasEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventos_ordenes', function (Blueprint $table) {
            $table->dropForeign(['orden_id']);
            $table->dropForeign(['evento_id']);
            
        });
        Schema::dropIfExists('eventos_ordenes');
        
        /////////////////////
        Schema::table('eventos_contactos', function (Blueprint $table) {
            $table->dropForeign(['contacto_id']);
            $table->dropForeign(['evento_id']);
            
        });
        Schema::dropIfExists('eventos_contactos');
        
        ///////////////
        Schema::table('eventos_responsables', function (Blueprint $table) {
            $table->dropForeign(['usuario_id']);
            $table->dropForeign(['evento_id']);
            
        });
        Schema::dropIfExists('eventos_responsables');
        
        /////////
        Schema::table('eventos_empresas', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']);
            $table->dropForeign(['evento_id']);
            
        });
        Schema::dropIfExists('eventos_empresas');
        
        //////////////////////
        Schema::table('eventos_archivo', function (Blueprint $table) {
            $table->dropForeign(['evento_id']);
            
        });
        Schema::dropIfExists('eventos_archivo');
        
        /////////////////////
        Schema::table('eventos', function (Blueprint $table) {
            $table->dropForeign(['usuario_creador_id']);
            $table->dropForeign(['tipo_evento_id']);
            $table->dropForeign(['usuario_cierre_id']);
            
        });
        Schema::dropIfExists('eventos');
        
        //////////
        Schema::dropIfExists('tipos_evento');
        
        
        
        
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
