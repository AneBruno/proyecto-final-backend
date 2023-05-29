<?php

namespace App\Console\Commands;

use App\Modules\Clientes\Eventos\EventosService;
use Illuminate\Console\Command;

class EventosNotificar extends Command {
    protected $signature = 'eventos:notificar';

    protected $description = 'Notificar eventos';

    public function handle(): int {
        EventosService::notificar();
        return 0;
    }
}
