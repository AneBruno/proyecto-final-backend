<?php

use App\Modules\GestionDeSaldos\EstadoSolicitud;
use Illuminate\Database\Migrations\Migration;

class SeedTablaEstadosSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $descripciones = [
            'Pendiente',
            'Aprobado gerencia comercial',
            'Aprobado crediticio',
            'Aprobado financiero',
            'Corrección de montos',
            'Aprobado comercial',
            'Confirmado',
            'No aprobado',
            'Cancelado',
        ];
        
        foreach($descripciones as $descripcion) {
            $solicitud = new EstadoSolicitud();
            $solicitud->descripcion = $descripcion;
            $solicitud->guardar();
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("TRUNCATE TABLE estados_solicitudes");
    }
}
