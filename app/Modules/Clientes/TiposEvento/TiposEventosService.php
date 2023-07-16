<?php

/*
namespace App\Modules\Clientes\TiposEvento;


use App\Tools\ModelRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class TiposEventosService
{
    /**
     * @param int $page
     * @param int $limit
     * @param array $filtros
     * @param array $ordenes
     * @param array $opciones
     * @return LengthAwarePaginator|Builder[]|Collection
     *
    public function listar(int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = [], array $opciones = [])
    {
        return TipoEvento::listar(
            $page,
            $limit,
            $filtros,
            $ordenes,
            $opciones
        );
    }

    /**
     * @param int $id
     * @return TipoEvento|ModelRepository
     * @throws RepositoryException
     *
    public function getOne(int $id)
    {
        return TipoEvento::getById($id);
    }

    /**
     * @param string $nombre
     * @return TipoEvento
     * @throws RepositoryException
     *
    public function crear(string $nombre, ?int $cantidad_dias_alerta_1, ?int $cantidad_dias_alerta_2): TipoEvento
    {
        return TipoEvento::crear($nombre, $cantidad_dias_alerta_1, $cantidad_dias_alerta_2);
    }

    /**
     * @param TipoEvento $tipoEvento
     * @param string $nombre
     * @return TipoEvento
     * @throws RepositoryException
     *
    public function actualizar($id, string $nombre, ?int $cantidad_dias_alerta_1, ?int $cantidad_dias_alerta_2): TipoEvento
    {
        $tipoEvento = TipoEvento::getById($id);
        return $tipoEvento->actualizar($nombre, $cantidad_dias_alerta_1, $cantidad_dias_alerta_2);
    }

    /**
     * @param TipoEvento $tipoEvento
     * @return TipoEvento
     * @throws RepositoryException
     *
    public function habilitar(TipoEvento $tipoEvento): TipoEvento
    {
        return $tipoEvento->habilitar();
    }

    /**
     * @param TipoEvento $tipoEvento
     * @return TipoEvento
     * @throws RepositoryException
     *
    public function deshabilitar(TipoEvento $tipoEvento): TipoEvento
    {
        return $tipoEvento->deshabilitar();
    }
}*/
