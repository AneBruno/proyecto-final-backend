<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Modules\Usuarios\Accesos\AccesosService;

class FixPermisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            UPDATE accesos SET
                nombre = 'Posiciones de compra'
            WHERE nombre = 'Posiciones'
        ");
        

        $rs = AccesosService::borrarPorCoincidencia([
            'uri' => 'mercado-ordenes',
        ]);
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
