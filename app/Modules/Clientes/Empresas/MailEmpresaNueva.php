<?php

namespace App\Modules\Clientes\Empresas;

use Illuminate\Bus\Queueable;
use App\Modules\Base\Emails\Mailable;
use Illuminate\Queue\SerializesModels;

class MailEmpresaNueva extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($empresa)
    {
        $this->subject = 'Alta de nueva empresa';
        $this->empresa = $empresa;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.empresa-nueva', [
            'empresa' => $this->empresa,
        ]);
    }
}
