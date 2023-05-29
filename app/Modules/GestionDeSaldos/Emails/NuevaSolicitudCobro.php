<?php

namespace App\Modules\GestionDeSaldos\Emails;

use App\Modules\GestionDeSaldos\Solicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class NuevaSolicitudCobro extends \App\Modules\Base\Emails\Mailable
{
    use Queueable, SerializesModels;

    protected Solicitud $solicitud;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Solicitud $solicitud)
    {
        $this->solicitud = $solicitud;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nueva solicitud de cobro')
			->markdown('emails.gestionDeSaldos.NuevaSolicitudCobro')
			->with([
				'nombre_usuario' => $this->solicitud->nombre_usuario,
				'razon_social' => $this->solicitud->razon_social,
			]);
    }
}
