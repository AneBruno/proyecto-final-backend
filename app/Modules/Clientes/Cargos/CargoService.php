<?php

/*namespace  App\Modules\Clientes\Cargos;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CargoService
{

    /**
     * @param int $page
     * @param int $limit
     * @param array $filtros
     * @param array $ordenes
     * @return LengthAwarePaginator
     *
    static public function listar(int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = [])
    {
        return Cargo::listar($page, $limit, $filtros, $ordenes);
    }
    
    static public function esNombreUnico(string $nombre, ?int $id = null) {
        return Cargo::contar([
            'nombre' => $nombre,
            'id_not' => $id,
        ]) === 0;
    }
}
*/