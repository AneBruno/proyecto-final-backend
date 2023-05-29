<?php

namespace App\Modules\GestionDeSaldos;

use App\Tools\ModelRepository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Solicitud
 *
 * @author kodear
 */
class EstadoSolicitud extends ModelRepository {
    
    protected $table = 'estados_solicitudes';
    public $timestamps = false;
    
    const ID_PENDIENTE = 1;
    const ID_CANCELADO = 9;
    const ID_SOLICITADO = 10;
    
    public $fillable = [
        'id',
        'descripcion',
    ];
}
