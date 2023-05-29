<?php

use App\Modules\Usuarios\Accesos\Acceso;
use App\Modules\Usuarios\Accesos\AccesosService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarAccesosTablaAccesos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $retirar = Acceso::crearAccion('Retirar orden', 'Mercado');
        $eliminar = Acceso::crearAccion('Eliminar orden', 'Mercado');

        AccesosService::asignarRolId($retirar, 1);
        AccesosService::asignarRolId($retirar, 2);
        AccesosService::asignarRolId($retirar, 3);
        AccesosService::asignarRolId($retirar, 4);
        AccesosService::asignarRolId($retirar, 5);

        AccesosService::asignarRolId($eliminar, 1);
        AccesosService::asignarRolId($eliminar, 2);
        AccesosService::asignarRolId($eliminar, 3);
        AccesosService::asignarRolId($eliminar, 4);
        AccesosService::asignarRolId($eliminar, 5);
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
