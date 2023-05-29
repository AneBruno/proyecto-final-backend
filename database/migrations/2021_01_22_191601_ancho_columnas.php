<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
//Timbues - San Martin - San Lorenzo - Punta Quebracho -Timbues - San Martin - San Lorenzo - Punta Quebracho
class AnchoColumnas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('puertos', function (Blueprint $table) {
            $table->string('nombre', 128)->change();
            $table->string('direccion', 128)->change();
        });

        // como esto no funciona... 
        /*Schema::table('puertos', function (Blueprint $table) {
            $table->string('terminal', 128)->change();
        });*/
        
        // hago esto
        DB::statement('ALTER TABLE puertos MODIFY terminal VARCHAR(128)');
        
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('razon_social', 128)->change();
            $table->string('direccion', 128)->change();
        });
        
        Schema::table('establecimientos_empresa', function (Blueprint $table) {
            $table->string('nombre', 128)->change();
            $table->string('direccion', 128)->change();
        });
        
        Schema::table('oficinas_empresa', function (Blueprint $table) {
            $table->string('nombre', 128)->change();
            $table->string('direccion', 128)->change();
        });
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
