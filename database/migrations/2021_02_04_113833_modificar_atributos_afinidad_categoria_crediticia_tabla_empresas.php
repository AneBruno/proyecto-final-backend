<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; 

class ModificarAtributosAfinidadCategoriaCrediticiaTablaEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Cambios para el atributo afinidad
        DB::raw(
            "ALTER TABLE empresas MODIFY
                    COLUMN afinidad ENUM('FIDEIZADO', 'NO_FIDEIZADO', 'FIDELIZADO', 'NO_FIDELIZADO')");

        DB::raw("UPDATE empresas SET afinidad = 'FIDELIZADO' WHERE afinidad = 'FIDEIZADO'");
        DB::raw("UPDATE empresas SET afinidad = 'NO_FIDELIZADO' WHERE afinidad = 'NO_FIDEIZADO'");

        DB::statement("ALTER TABLE empresas MODIFY COLUMN afinidad ENUM('FIDELIZADO', 'NO_FIDELIZADO')");

        //Cambios para el atributo categoria_crediticia
        DB::raw(
            "ALTER TABLE empresas MODIFY
                    COLUMN categoria_crediticia
                     ENUM('VENDER', 'PREGUNTAR', 'NO_VENDER', 'OPERAR', 'NO_OPERAR', 'CONSULTAR')"
        );

        DB::raw("UPDATE empresas SET categoria_crediticia = 'OPERAR' WHERE categoria_crediticia = 'VENDER'");
        DB::raw("UPDATE empresas SET categoria_crediticia = 'CONSULTAR' WHERE categoria_crediticia = 'PREGUNTAR'");
        DB::raw("UPDATE empresas SET categoria_crediticia = 'NO_OPERAR' WHERE categoria_crediticia = 'NO_VENDER'");

        DB::statement(
            "ALTER TABLE empresas MODIFY
                    COLUMN categoria_crediticia
                     ENUM('OPERAR', 'NO_OPERAR', 'CONSULTAR')"
        );
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
