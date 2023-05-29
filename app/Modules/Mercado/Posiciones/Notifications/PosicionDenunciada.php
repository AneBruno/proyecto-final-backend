<?php

namespace App\Modules\Mercado\Posiciones\Notifications;

use App\Modules\Mercado\Posiciones\Posicion;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PosicionDenunciada extends Notification
{
    use Queueable;

    protected Posicion $posicion;
    protected User $usuarioDenunciante;

    /**
     * PosicionDenunciada constructor.
     * @param Posicion $posicion
     * @param User $usuarioDenunciante
     */
    public function __construct(Posicion $posicion, User $usuarioDenunciante)
    {
        $this->posicion = $posicion;
        $this->usuarioDenunciante = $usuarioDenunciante;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $urlBase = config('app.dashboard_url');

        return (new MailMessage)
            ->from(config('app.from_email'))
            ->subject('Tu posición ha sido denunciada')
            ->markdown('emails.posicion-denunciada', [
                'usuarioDenunciante' => $this->usuarioDenunciante->getFullname(),
                'producto' => $this->posicion->producto->getNombre(),
                'calidad' => $this->posicion->calidad->getNombre(),
                'entrega' => $this->posicion->getEntrega(),
                'destino' => $this->posicion->getDestino()->getNombre(),
                'moneda' => $this->posicion->getMoneda(),
                'precio' => $this->posicion->getPrecio(),
                'link' => "{$urlBase}/app/mercado/posiciones/consulta/{$this->posicion->getKey()}"
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
