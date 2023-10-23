<?php

namespace App\Modules\Indicadores\Posiciones;

use App\Modules\Mercado\Posiciones\PosicionesService;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PosicionesIndicadorService
{
    protected PosicionesService $posicionesService;

    /**
     * OrdenesService constructor.
     * @param PosicionesService $posicionesService
     */
    public function __construct(PosicionesService $posicionesService)
    {
        $this->posicionesService = $posicionesService;
    }

    /**
     * @param User $user
     * @param int $page
     * @param int $limit
     * @param array $filtros
     * @param array $ordenes
     * @param array $opciones
     * @return LengthAwarePaginator
     */
    public function listar(User $user, int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = [], array $opciones = [])
    {
        /*if ($user->hasAnyRol(RolHelper::REPRESENTATE)) {
            $filtros['usuario_carga_id'] = $user->getKey();
        }*/

        return PosicionIndicador::listar(
            $page,
            $limit,
            $filtros,
            $ordenes,
            $opciones
        );
    }

}
