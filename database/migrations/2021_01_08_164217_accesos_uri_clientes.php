<?php

use Illuminate\Database\Migrations\Migration;

class AccesosUriClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('accesos')->where('id',  5)->update(['uri' => 'clientes-empresas'  ]);
        DB::table('accesos')->where('id',  6)->update(['uri' => 'clientes-contactos' ]);
        DB::table('accesos')->where('id',  7)->update(['uri' => 'clientes-eventos'   ]);
        DB::table('accesos')->where('id',  8)->update(['uri' => 'clientes-volumenes' ]);
        DB::table('accesos')->where('id',  9)->update(['uri' => 'clientes-categorias']);
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
