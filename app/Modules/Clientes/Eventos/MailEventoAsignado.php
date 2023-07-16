<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
namespace App\Modules\Clientes\Eventos;

use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Bus\Queueable;
use App\Modules\Base\Emails\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Description of MailEventoAsignado
 *
 * @athor kodear
 *
class MailEventoAsignado extends Mailable {
    
    use Queueable;
    use SerializesModels;
    
    
    public $subject = 'Asignación - Evento';


    protected $datos = [];

    public function __construct(User $usuario, Evento $evento) {
        $this->datos['usuario_creador_nombre'] = $usuario->getNombreCompletoAttribute();
        $this->datos['link'] = EventosService::obtenerLinkSpa($evento);
        $this->subject = "Asignación - {$evento['titulo']}";
    }

    public function build(): self {
        
        
        
        return $this->markdown(static::getMailTemplatePath(__DIR__ . '/mail-evento-asignado'), [
            'datos' => $this->datos,
        ]);
    }
    
    static public function getMailTemplatePath(string $absolutePath) {
        $appPath = app_path();
        if (substr($absolutePath, 0, strlen($appPath)) !== $appPath) {
            throw new \Exception('Las rutas no coinciden');
        }
        
        return substr($absolutePath, strlen($appPath));
    }
}
*/