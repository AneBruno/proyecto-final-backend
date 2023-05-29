<?php

namespace App\Console\Commands;

use App\Modules\Auth\AuthService;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Console\Command;
use App\Modules\Usuarios\Usuarios\UserService;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;
use Laravel\Passport\PersonalAccessTokenResult;

class LoginUsuario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login:usuario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtiene el token del login del usuario.';

    protected $authService;

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
     * @return int
     */
    public function handle()
    {
        $email = $this->ask('Ingrese el mail del usuario: ');

        /** @var User $user */
        try {
            $user = UserService::getByEmail($email);
        } catch (\Exception $e) {
            $this->error('Usuario no encontrado');
            return 1;
        }

        $tokenResult = AuthService::createToken($user, true);

        $this->info($tokenResult->accessToken);
    }
}

