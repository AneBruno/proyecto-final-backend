<?php

use App\Modules\Usuarios\Accesos\Acceso;
use App\Modules\Usuarios\Accesos\AccesosService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearAccesosClientesTiposEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $acceso = Acceso::crearMenu('Tipos de eventos CRM', 'Clientes', 'clientes/tipos-eventos');
        AccesosService::asignarRolId($acceso, 1);

        DB::statement("UPDATE accesos SET orden = 1 WHERE nombre = 'Clientes'");
        DB::statement("UPDATE accesos SET orden = 2 WHERE nombre = 'Contactos'");
        DB::statement("UPDATE accesos SET orden = 3 WHERE nombre = 'Tipos de eventos CRM'");
        DB::statement("UPDATE accesos SET orden = 4 WHERE nombre = 'Eventos CRM'");
        DB::statement("UPDATE accesos SET orden = 5 WHERE nombre = 'Volúmenes Estimados'");
        DB::statement("UPDATE accesos SET orden = 6 WHERE nombre = 'Categorías'");
        DB::statement("UPDATE accesos SET orden = 7 WHERE nombre = 'Cargos'");
        DB::statement("UPDATE accesos SET orden = 8 WHERE nombre = 'Actividades'");

        Acceso::crearAccion('tipos_eventos_habilitar', 'Clientes');
        Acceso::crearAccion('tipos_eventos_deshabilitar', 'Clientes');
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
