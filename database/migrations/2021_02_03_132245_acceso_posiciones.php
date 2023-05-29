<?php

use Illuminate\Database\Migrations\Migration;

class AccesoPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('accesos')->where('id', 12)->update(['uri' => 'mercado/posiciones']);
        DB::table('accesos_roles')->insert([[
            'acceso_id' => 12,
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
        DB::table('accesos_roles')->where(['acceso_id'=>12,'rol_id'=>1])->delete();
    }
}
