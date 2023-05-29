<?php

use Illuminate\Database\Migrations\Migration;
use App\Modules\Usuarios\Accesos\Acceso;
use App\Modules\Usuarios\Accesos\AccesosService;

class AccesoPanelMercado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $acceso = Acceso::crearMenu('Panel', 'Mercado', 'mercado/panel');        
        AccesosService::asignarRolId($acceso, 1);
        AccesosService::asignarRolId($acceso, 2);
        AccesosService::asignarRolId($acceso, 3);
        AccesosService::asignarRolId($acceso, 4);
        AccesosService::asignarRolId($acceso, 5);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $rs = Acceso::listarTodos([
            'nombre' => 'Panel',
            'uri'    => 'mercado/panel',
        ]);
        foreach($rs as $row) {
            AccesosService::borrar($row->id);
        }
    }
}
