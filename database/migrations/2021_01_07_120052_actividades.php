<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Actividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->timestamps();
            $table->softDeletes();
        });
        
        DB::table('actividades')->insert(['nombre' => 'Avícola'            ]);
        DB::table('actividades')->insert(['nombre' => 'Porcino'            ]);
        DB::table('actividades')->insert(['nombre' => 'Ganadero'           ]);
        DB::table('actividades')->insert(['nombre' => 'Alimento Balanceado']);
        DB::table('actividades')->insert(['nombre' => 'Industrial'         ]);
        DB::table('actividades')->insert(['nombre' => 'Agrícola'           ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('actividades');
    }
}
