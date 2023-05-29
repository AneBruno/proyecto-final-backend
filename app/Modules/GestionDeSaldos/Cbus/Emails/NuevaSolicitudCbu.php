<?php

namespace App\Modules\GestionDeSaldos\Cbus\Emails;

use App\Modules\GestionDeSaldos\Cbus\Cbu;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Modules\Base\Emails\Mailable;


class NuevaSolicitudCbu extends Mailable
{
    use Queueable, SerializesModels;

    private Cbu $cbu;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cbu $cbu)
    {
        $this->cbu = $cbu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nueva Solicitud de CBU')
			->markdown('emails.gestionDeSaldos.Cbu.NuevaSolicitudCbu')
			->with([
				'usuario_solicitante' => $this->cbu->usuario_solicitante,
				'razon_social' => $this->cbu->razon_social
			]);
    }
}
