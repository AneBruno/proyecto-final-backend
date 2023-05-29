<?php

use App\Modules\GestionDeSaldos\EstadoSolicitud;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDescripcionAnticipoSolcitadoOnEstadosSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        EstadoSolicitud::where('descripcion', 'Anticipo Solicitado')
			->update(['descripcion' => 'Solicitado']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		EstadoSolicitud::where('descripcion', 'Solicitado')
			->update(['descripcion' => 'Anticipo Solicitado']);
    }
}
