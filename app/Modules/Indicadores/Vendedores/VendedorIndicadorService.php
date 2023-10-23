<?php

namespace App\Modules\Indicadores\Vendedores;

use App\Modules\Clientes\Empresas;
use App\Modules\Clientes\Empresas\EmpresasService;
use App\Modules\Mercado\Posiciones\PosicionesService;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VendedorIndicadorService
{
    protected EmpresasService $clienteService;

    /**
     * OrdenesService constructor.
     * @param PosicionesService $posicionesService
     */
    public function __construct(EmpresasService $clienteService)
    {
        $this->clienteService = $clienteService;
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
        return VendedorIndicador::listar(
            $page,
            $limit,
            $filtros,
            $ordenes,
            $opciones
        );
    }

}
