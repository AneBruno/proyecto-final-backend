<?php

namespace App\Mail;

use App\Modules\Base\Emails\Mailable;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class UsuarioNuevoMail extends Mailable
{
    use Queueable;
    use SerializesModels;
    
    public $subject = 'Asignación de Rol y Oficina a nuevo usuario';
    
    /**
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->subject = 'Nueva usuario registrado';
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.usuario-nuevo', [
            'nombre' => $this->user->nombre . ' ' . $this->user->apellido,
        ]);
    }
}
