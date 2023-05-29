<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\Clientes\Eventos;

use App\Modules\Mail\Base;

/**
 * Description of MailEventoAsignado
 *
 * @author kodear
 */
class MailEventoCerrado extends Base {
    
    public $subject = 'Evento Resuelto - Evento';

    protected $datos = [];

    public function __construct(Evento $evento) {
        $this->datos['usuario_cierre_nombre'] = $evento->usuarioCierre->getNombreCompletoAttribute();
        $this->datos['titulo'               ] = $evento->titulo;
        $this->datos['resolucion'           ] = $evento->resolucion;
        $this->datos['link'                 ] = EventosService::obtenerLinkSpa($evento);
        $this->subject = "Evento Resuelto - {$evento['titulo']}";
    }

    public function build(): self {
        return $this->markdown(static::getMailTemplatePath(__DIR__ . '/mail-evento-cerrado'), $this->datos);
    }
}