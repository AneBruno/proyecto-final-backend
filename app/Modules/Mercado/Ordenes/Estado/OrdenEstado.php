<?php

namespace App\Modules\Mercado\Ordenes\Estado;

use App\Tools\ModelRepository;

class OrdenEstado extends ModelRepository
{
    public const OFERTA_ACTIVA = 1;
    public const CONFIRMADA = 3;
    public const ELIMINADA = 5;

    public const ESTADOS = [
        self::OFERTA_ACTIVA,
        self::CONFIRMADA,
        self::ELIMINADA
    ];

    protected $table = 'mercado_ordenes_estados';
}
