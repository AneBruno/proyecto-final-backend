<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CamposEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function(Blueprint $table) {
            $table->bigInteger('cuit')->change();
            $table->string('cuit')->unique('cuit')->change();
            $table->index(['habilitada'        ], 'habilitada'     );
            $table->index(['cuit', 'habilitada'], 'cuit_habilitada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function(Blueprint $table) {
            $table->string('cuit', 50)->change();
            
            $table->dropIndex('cuit'           );
            $table->dropIndex('habilitada'     );
            $table->dropIndex('cuit_habilitada');
        });
    }
}
