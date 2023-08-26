<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearAccesoIndicadoresRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('accesos_roles')->insert([
            'rol_id' => '1',
            'acceso_id' => '36'
        ]);
        DB::table('accesos_roles')->insert([
            'rol_id' => '3',
            'acceso_id' => '36'
        ]);
        DB::table('accesos_roles')->insert([
            'rol_id' => '4',
            'acceso_id' => '36'
        ]);
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
