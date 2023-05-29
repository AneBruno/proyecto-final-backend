<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\Mail;

use Illuminate\Bus\Queueable;
use App\Modules\Base\Emails\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Description of MailEventoAsignado
 *
 * @author kodear
 */
class Base extends Mailable {
    
    use Queueable;
    use SerializesModels;    
    
    static public function getMailTemplatePath(string $absolutePath) {
        $appPath = app_path();
        if (substr($absolutePath, 0, strlen($appPath)) !== $appPath) {
            throw new \Exception('Las rutas no coinciden');
        }
        
        return substr($absolutePath, strlen($appPath));
    }
}
