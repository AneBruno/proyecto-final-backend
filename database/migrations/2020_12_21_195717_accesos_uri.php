<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AccesosUri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::table('accesos', function(Blueprint $table) {
            $table->string('uri', 64)->nullable()->default(null);
        });
        
        DB::table('accesos')->where('id',  2)->update(['uri' => 'panel-mercado'      ]);
        DB::table('accesos')->where('id',  3)->update(['uri' => 'usuarios'           ]);
        DB::table('accesos')->where('id',  4)->update(['uri' => 'oficinas'           ]);
        DB::table('accesos')->where('id',  5)->update(['uri' => 'clientes'           ]);
        DB::table('accesos')->where('id',  6)->update(['uri' => 'contactos'          ]);
        DB::table('accesos')->where('id',  7)->update(['uri' => 'eventos'            ]);
        DB::table('accesos')->where('id',  8)->update(['uri' => 'volumenes'          ]);
        DB::table('accesos')->where('id',  9)->update(['uri' => 'clientes-categorias']);
        DB::table('accesos')->where('id', 10)->update(['uri' => 'puertos'            ]);
        DB::table('accesos')->where('id', 11)->update(['uri' => 'cargos'             ]);
        DB::table('accesos')->where('id', 12)->update(['uri' => 'mercado-posiciones' ]);
        DB::table('accesos')->where('id', 13)->update(['uri' => 'mercado-ordenes'    ]);
        DB::table('accesos')->where('id', 14)->update(['uri' => 'productos'          ]);
        DB::table('accesos')->where('id', 15)->update(['uri' => 'productos-calidades']);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accesos', function(Blueprint $table) {
            $table->removeColumn('uri');
        });
    }
}
