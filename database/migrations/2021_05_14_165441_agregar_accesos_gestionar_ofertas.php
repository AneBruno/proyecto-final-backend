<?php

use App\Modules\Usuarios\Accesos\Acceso;
use App\Modules\Usuarios\Accesos\AccesosService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarAccesosGestionarOfertas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $gestionarOferta = Acceso::crearAccion('Gestionar ofertas', 'Mercado');

        AccesosService::asignarRolId($gestionarOferta, 2);
        AccesosService::asignarRolId($gestionarOferta, 3);
        AccesosService::asignarRolId($gestionarOferta, 4);
        AccesosService::asignarRolId($gestionarOferta, 6);
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
