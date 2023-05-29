<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Modules\Clientes\Empresas\EmpresasService;

class EmpresaNotificarNueva extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'empresa:notificar-nueva';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notificar nueva emprsa';

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
        $empresa_id = $this->ask('Ingrese el id de empresa');
        $empresa = EmpresasService::getById($empresa_id);
        EmpresasService::notificarNuevaEmpresa($empresa);
        
        return 0;
    }
}
