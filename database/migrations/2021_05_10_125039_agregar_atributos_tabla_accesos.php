<?php

use App\Modules\Usuarios\Accesos\Acceso;
use App\Modules\Usuarios\Accesos\AccesosService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarAtributosTablaAccesos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $denunciar = Acceso::crearAccion('Denunciar posición', 'Mercado');
        $retirar = Acceso::crearAccion('Retirar posición', 'Mercado');
        $eliminar = Acceso::crearAccion('Eliminar posición', 'Mercado');

        AccesosService::asignarRolId($denunciar, 1);
        AccesosService::asignarRolId($denunciar, 2);
        AccesosService::asignarRolId($denunciar, 3);
        AccesosService::asignarRolId($denunciar, 4);

        AccesosService::asignarRolId($retirar, 1);
        AccesosService::asignarRolId($retirar, 2);
        AccesosService::asignarRolId($retirar, 3);
        AccesosService::asignarRolId($retirar, 4);

        AccesosService::asignarRolId($eliminar, 1);
        AccesosService::asignarRolId($eliminar, 2);
        AccesosService::asignarRolId($eliminar, 3);
        AccesosService::asignarRolId($eliminar, 4);
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
