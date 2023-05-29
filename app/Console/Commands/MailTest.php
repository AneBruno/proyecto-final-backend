<?php

namespace App\Console\Commands;

use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MailTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un e-mail de prueba, para corroborar el funcionamiento del servicio.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $email = $this->ask('Ingrese e-mail destino:');

            Validator::make(['email' => $email], [
                'email' => 'required|email'
            ])->validate();

            $user = new User();
            $user->email = $email;

            Mail::to($user)->send(new \App\Mail\MailTest());

            $this->info("E-mail enviado.");
        } catch (ValidationException $e) {
            $this->error($e->getMessage());
        } catch (\Throwable $e) {
            $this->error('Ocurrio un error:' . $e->getMessage());
        }

        return false;
    }
}
