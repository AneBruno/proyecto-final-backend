<?php

namespace App\Modules\Mercado\CondicionesPago;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class CondicionesPagoService
{

    /**
     * @param int $offset
     * @param int $limit
     * @param array $filtros
     * @return LengthAwarePaginator
     */
    static public function listar(int $offset = 0, int $limit = 0, array $filtros = [])
    {
        return CondicionPago::listar($offset, $limit, $filtros);
    }

    /**
     * @param int $id
     * @return CondicionPago
     * @throws RepositoryException
     */
    static public function getById(int $id): CondicionPago
    {
        return CondicionPago::getById($id);
    }

    /**
     * @param string $descripcion
     * @return CondicionPago
     */
    static public function crear(
        string $descripcion
    ): CondicionPago {

        $row = CondicionPago::crear($descripcion);
        return $row;
    }

    /**
     * @param int $id
     * @param string $descripcion
     * @return CondicionPago
     * @throws RepositoryException
     */
    static public function actualizar(
        int     $id,
        string  $descripcion
    ): CondicionPago {
        $row = CondicionPago::getById($id);
        $row->actualizar($descripcion);

        return $row;
    }

    /**
     *
     * @param int $id
     * @return void
     */
    static public function borrar(int $id): void
    {
        CondicionPago::getById($id)->borrar();
    }


}
