<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaCondicionesPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condiciones_pago', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');

            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('condiciones_pago')->insert([
            [
                'id' => 1,
                'descripcion' => 'Contado',
            ],
            [
                'id' => 2,
                'descripcion' => 'Anticipo'
            ],
            [
                'id' => 3,
                'descripcion' => 'Días corridos'
            ],
            [
                'id' => 4,
                'descripcion' => 'Días hábiles'
            ],
            [
                'id' => 5,
                'descripcion' => 'Fecha cierta'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condiciones_pago');
    }
}
