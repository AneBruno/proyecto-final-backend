<?php

use Illuminate\Database\Migrations\Migration;
use App\Modules\Usuarios\Accesos\Acceso;
use App\Modules\Usuarios\Accesos\AccesosService;

class AccesoActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $acceso = Acceso::crearMenu('Actividades', 'Clientes', 'clientes/actividades');        
        AccesosService::asignarRolId($acceso, 1);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $rs = Acceso::listarTodos([
            'nombre' => 'actividades',
            'uri'    => 'clientes/actividades',
        ]);
        foreach($rs as $row) {
            AccesosService::borrar($row->id);
        }
    }
}
