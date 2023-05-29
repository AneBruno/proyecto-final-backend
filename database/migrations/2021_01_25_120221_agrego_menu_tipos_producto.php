<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AgregoMenuTiposProducto extends Migration
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
                'nombre' => 'Tipos de producto',
                'grupo'  => 'Mercado',
                'uri'    => 'productos/tipo',
            ],
        ]);
        $id = DB::getPDO()->lastInsertId();
        DB::table('accesos_roles')->insert([[
            'acceso_id' => $id,
            'rol_id'    => 1,
        ]]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $acceso = DB::table('accesos')->where('nombre', 'Tipos de producto')->first();
        $acceso_id = $acceso->id;
        DB::table('accesos')->delete($acceso->id);
        DB::table('accesos_roles')->where('acceso_id', $acceso_id)->delete();
    }
}
