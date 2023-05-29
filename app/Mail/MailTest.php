<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class MailTest extends \App\Modules\Base\Emails\Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from'), config('app.name') . '[' . app()->environment() . ']')
            ->subject('E-mail test from ' . config('app.name'))
            ->markdown('emails.test', [
                'environment' => app()->environment(),
                'datetime' => now()->format('d/m/Y H:i:s'),
                'timezone' => config('app.timezone'),
                'mailer' => config('mail.default')
            ]);
    }
}
