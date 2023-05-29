<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Modules\Usuarios\Roles\Rol;
use App\Modules\Usuarios\Usuarios\User;
use App\Modules\Usuarios\Usuarios\UserService;

class UserRoleAssign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:role-asign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set role to an user';

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
        $rs = User::all(['id', 'nombre', 'email']);
        if (!$rs->count()) {
            $this->error('No hay usuarios en el sistema');
            return 1;
        }
        
        $this->table(['Id', 'Nombre'], $rs);
        $userId = $this->ask('Por favor, indique ID de usuario para modificar el rol');
        
        
        $user = User::getById($userId);
        $this->line("Id  de usuario elegido: {$user->nombre} ({$user->email})");
        
        $rs = Rol::all(['id', 'nombre']);
        $this->table(['Id', 'Nombre'], $rs);
        $rolId = $this->ask('Elija un rol');
        
        
        $rol = $rs->firstWhere('id', $rolId);
        
        $confirm = $this->confirm("Asignará el rol {$rol->nombre} a {$user->email}. Continuar?");
        if (!$confirm) {
            return 1;
        }
        
        UserService::setRole($user, $rol);
        return 0;
    }
}
