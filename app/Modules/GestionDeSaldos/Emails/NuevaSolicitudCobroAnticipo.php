<?php

namespace App\Modules\GestionDeSaldos\Emails;

class NuevaSolicitudCobroAnticipo extends NuevaSolicitudCobro
{
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject('Nueva solicitud de cobro')
			->markdown('emails.gestionDeSaldos.NuevaSolicitudCobroAnticipo')
			->with([
				'solicitud' => $this->solicitud,
			]);
	}
}