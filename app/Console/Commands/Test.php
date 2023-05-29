<?php

namespace App\Console\Commands;

use App\Modules\Clientes\Eventos\Evento;
use App\Modules\Clientes\Eventos\EventosService;
use App\Modules\Google\Places\PlacesService;
use Illuminate\Console\Command;

class Test extends Command {
    protected $signature = 'test';
    protected $description = 'Pruebas';

    public function handle() {
        
        $url = EventosService::obtenerLinkSpa(Evento::getById(4));
        die($url);
        EventosService::notificarUsuariosPorEmail(Evento::getById(4), Evento::getById(3));
        
        die();
        //$ret = PlacesService::buscar('-33.4488897,-70.6692655');
        $ret = PlacesService::buscar("41°24'12.2\"N 2°10'26.5\"E");
        // $ret = PlacesService::buscar('San Luis 655');
        print_r($ret);
        die();

        $ret = PlacesService::obtenerDetalles('ChIJ_cLo7Byrt5UR1YyNdBEkFio');
        print_r($ret);
    }
}