<?php

use Illuminate\Database\Migrations\Migration;
use App\Modules\Usuarios\Accesos\Acceso;
use App\Modules\Usuarios\Accesos\AccesosService;

class AccesoMenuCondicionesPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $acceso = Acceso::crearMenu('Condiciones de pago', 'Mercado', 'mercado/condicionesPago');
        AccesosService::asignarRolId($acceso, 1);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $rs = AccesosService::borrarPorCoincidencia([
            'uri' => 'mercado/condicionesPago',
        ]);
    }
}
