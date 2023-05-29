<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Modules\Usuarios\Usuarios\UserService;

class UserCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un usuario';

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
        
        UserService::create($this->ask('Email'), $this->ask('Nombre'), $this->ask('Apellido'));
        return 0;
    }
}
