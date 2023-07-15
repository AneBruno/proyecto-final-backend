<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambiarGruposMenuOtros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $ids = [10, 14, 17, 23, 25]; // IDs de los registros que deseas actualizar
        $nuevoValor = 'Configuración'; // Valor nuevo para el campo 'grupo'

        DB::table('accesos')->whereIn('id', $ids)->update(['grupo' => $nuevoValor]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $ids = [10, 14, 17, 23, 25]; // IDs de los registros que deseas actualizar
        $nuevoValor = 'Mercado'; // Valor nuevo para el campo 'grupo'

        DB::table('accesos')->whereIn('id', $ids)->update(['grupo' => $nuevoValor]);
    }
}
