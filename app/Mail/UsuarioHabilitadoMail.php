<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Modules\Usuarios\Usuarios\User;

class UsuarioHabilitadoMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->subject = 'Cuenta habilitada para operar';
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.usuario-estado', [
            'nombre' => $this->user->nombre,
        ]);
    }
}
