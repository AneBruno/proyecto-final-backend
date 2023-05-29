<?php

namespace App\Modules\Mercado\Cosechas;

use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class CosechasService
{
    /**
     * @param User $user
     * @param int $page
     * @param int $limit
     * @param array $filtros
     * @param array $ordenes
     * @param array $opciones
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function listar(User $user, int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = [], array $opciones = [])
    {
        return Cosecha::listar(
            $page,
            $limit,
            $filtros,
            $ordenes,
            $opciones
        );
    }

    /**
     * @param Cosecha $cosecha
     * @param $opciones
     * @return Cosecha
     * @throws RepositoryException
     */
    public function getOne(Cosecha $cosecha, $opciones): Cosecha
    {
        return Cosecha::getById($cosecha->getKey(), [], $opciones);
    }

    /**
     * @param User $user
     * @param array $data
     * @return Cosecha
     * @throws RepositoryException
     */
    public function crear(User $user, array $data): Cosecha
    {
        $data['habilitado'] = 1;

        $cosecha = new Cosecha($data);
        $cosecha->insertar();

        return $cosecha;
    }

    /**
     * @param Cosecha $cosecha
     * @param array $data
     * @return Cosecha
     * @throws RepositoryException
     */
    public function actualizar(Cosecha $cosecha, array $data): Cosecha {
        return $cosecha->actualizar($data);
    }
}
