<?php
/*
namespace App\Modules\Clientes\RedesSociales;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class RedesSocialesService
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
        return RedSocial::listar($page, $limit, $filtros, $ordenes);
    }
    
    static public function getById(int $id): RedSocial {
        return RedSocial::getById($id);
    }

    /**
     * @param int $contacto_id
     * @param string $red
     * @param string|null $url
     * @return RedSocial
     * @throws RepositoryException
     *
    static public function crear(
        int  $contacto_id,
        string  $red,
        ?string $url
    ): RedSocial
    {

        DB::beginTransaction();

        $redSocial = RedSocial::crear(
            $contacto_id,
            $red,
            $url
        );

        DB::commit();

        return $redSocial;
    }

    /**
     * @param int $id
     * @param string $red
     * @param string|null $url
     * @return RedSocial
     * @throws RepositoryException
     *
    static public function actualizar(
        int $id,
        string  $red,
        ?string $url
    ): RedSocial {

        DB::beginTransaction();

        $redSocial = RedSocial::getById($id);
        $redSocial->actualizar(
            $red,
            $url
        );

        DB::commit();

        return $redSocial;
    }

    /**
     * @param int $id
     * @throws RepositoryException
     *
    static public function borrar(int $id): void
    {
        RedSocial::getById($id)->borrar();
    }
}*/
