<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Modules\Mercado\Panel\PanelService;

class PanelListar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'panel:listar';

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
        $rs = PanelService::listar();
        
        $newRs = [];
        
        foreach($rs as $row) {
            $newRs[] = [
                'posicion_id'     => $row['posicion_id'    ],
                'empresa'         => $row['empresa'        ]['razon_social'],
                'producto'        => $row['producto'       ]['nombre'      ],
                'calidad'         => $row['calidad'        ]['nombre'      ],
                'establecimiento' => $row['establecimiento']['nombre'      ],
                'puerto'          => $row['puerto'         ]['nombre'      ],
                'condicion_pago'  => $row['condicion_pago' ]['descripcion' ],
                'periodo'         => $row['periodo'        ],
                'precio'          => $row['precio'         ],
                'moneda'          => $row['moneda'         ],
            ];
        }
        $this->table(array_keys($newRs[0] ?? []), $newRs);
        
        return 0;
    }
}
