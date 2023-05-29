<?php

use Illuminate\Database\Migrations\Migration;
use App\Modules\Usuarios\Accesos\Acceso;
use App\Modules\Usuarios\Accesos\AccesosService;

class AccesoMenuMercadoCosechas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $acceso = Acceso::crearMenu('Cosechas', 'Mercado', 'mercado/cosechas');
        AccesosService::asignarRolId($acceso, 1);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        AccesosService::borrarPorCoincidencia([
            'uri' => 'mercado/cosechas',
        ]);
    }
}
