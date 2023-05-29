<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Modules\Usuarios\Accesos\Acceso;
use App\Modules\Usuarios\Accesos\AccesoRol;

class AccesoHabilitarDeshabilitarEmpresas2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Acceso::listarTodos(['nombre'=>'empresa_habilitar_deshabilitar'])->each(function($row) {
            $acceso_id = $row->id;
            AccesoRol::listarTodos(['acceso_id'=>$acceso_id])->each(function($row) {
                $row->borrar();
            });
            $row->borrar();
        });
        
        $acceso = Acceso::crearAccion('empresas_habilitar', 'Clientes');
        AccesoRol::crear($acceso->id, 5);
        
        $acceso = Acceso::crearAccion('empresas_deshabilitar', 'Clientes');
        AccesoRol::crear($acceso->id, 1);
        AccesoRol::crear($acceso->id, 2);
        AccesoRol::crear($acceso->id, 3);
        AccesoRol::crear($acceso->id, 4);
        AccesoRol::crear($acceso->id, 5);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Acceso::listarTodos(['nombre'=>['empresas_habilitar', 'empresas_deshabilitar']])->each(function($row) {
            $acceso_id = $row->id;
            AccesoRol::listarTodos(['acceso_id'=>$acceso_id])->each(function($row) {
                $row->borrar();
            });
            $row->borrar();
        });
    }
}
