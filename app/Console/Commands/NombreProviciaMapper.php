<?php

namespace App\Console\Commands;

use App\Modules\Direcciones\Direcciones;
use Illuminate\Console\Command;

class NombreProviciaMapper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'provincia:mapper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mapea el nombre de la provincia con uno genérico.';

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
        $valor = $this->ask('Ingrese nombre: ');

        $resultado = Direcciones::corregirNombreProvincia($valor);
        $this->info($resultado);

        return 0;
    }
}
