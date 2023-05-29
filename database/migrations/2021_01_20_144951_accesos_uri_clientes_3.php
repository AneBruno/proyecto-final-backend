<?php

use Illuminate\Database\Migrations\Migration;

class AccesosUriClientes3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('accesos')->where('id', 11)->update(['uri' => 'clientes/cargos']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('accesos')->where('id', 11)->update(['uri' => 'cargos']);
    }
}
