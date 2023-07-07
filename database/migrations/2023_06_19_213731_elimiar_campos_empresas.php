<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ElimiarCamposEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('comision_comprador');
            $table->dropColumn('comision_vendedor');
            $table->dropColumn('categoria_crediticia');
            $table->dropColumn('afinidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->addColumn('decimal(10,2)', 'comision_comprador');
            $table->addColumn('decimal(10,2)', 'comision_vendedor');
        });
        DB::statement("ALTER TABLE empresas ADD categoria_crediticia ENUM('OPERAR', 'NO_OPERAR' , 'CONSULTAR')");
        DB::statement("ALTER TABLE empresas ADD afinidad ENUM('FIDELIZADO', 'NO_FIDELIZADO')");
        
    }
}
