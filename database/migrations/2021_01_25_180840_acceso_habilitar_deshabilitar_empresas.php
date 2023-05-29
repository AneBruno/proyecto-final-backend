<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AccesoHabilitarDeshabilitarEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::table('accesos')->insert([
            [
                'nombre' => 'empresa_habilitar_deshabilitar',
                'grupo'  => 'Clientes',
                'tipo'   => 'accion',
            ],
        ]);
        $id = DB::getPDO()->lastInsertId();
        DB::table('accesos_roles')->insert([[
            'acceso_id' => $id,
            'rol_id'    => 5,
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $acceso = DB::table('accesos')->where('nombre', 'empresa_habilitar_deshabilitar')->first();
        $acceso_id = $acceso->id;
        DB::table('accesos')->delete($acceso->id);
        DB::table('accesos_roles')->where('acceso_id', $acceso_id)->delete();
    }
}
