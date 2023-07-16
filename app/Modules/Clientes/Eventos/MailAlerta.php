<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
namespace App\Modules\Clientes\Eventos;

use App\Modules\Mail\Base;

/**
 * Description of MailEventoAsignado
 *
 * @author kodear
 *
class MailAlerta extends Base {
    
    public $subject = 'Vencimiento - Evento';

    protected $datos = [];

    public function __construct(Evento $evento) {
        $this->datos['titulo'] = $evento->titulo;
        $this->datos['link'  ] = EventosService::obtenerLinkSpa($evento);
        $this->subject = "Vencimiento - {$evento['titulo']}";
    }

    public function build(): self {
        return $this->markdown(static::getMailTemplatePath(__DIR__ . '/mail-alerta'), $this->datos);
    }
}*/