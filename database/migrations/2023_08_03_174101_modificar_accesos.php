<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificarAccesos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('accesos')->where('id', 2)->update(['uri' => 'panel-mercado']);
        DB::table('accesos')->where('id', 3)->update(['uri' => 'usuarios']);
        DB::table('accesos')->where('id', 5)->update(['uri' => 'clientes/empresas']);
        DB::table('accesos')->where('id', 10)->update(['uri' => 'puertos']);
        DB::table('accesos')->where('id', 14)->update(['uri' => 'productos']);
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
