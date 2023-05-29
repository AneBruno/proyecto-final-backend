<?php

namespace App\Modules\Mercado\Ordenes\Estado;

use App\Tools\ModelRepository;

class OrdenEstado extends ModelRepository
{
    public const OFERTA_TRABAJAR = 1;
    public const ORDEN_FIRME = 2;
    public const CONFIRMADA = 3;
    public const BAJA = 4;
    public const ELIMINADA = 5;

    public const ESTADOS = [
        self::OFERTA_TRABAJAR,
        self::ORDEN_FIRME,
        self::CONFIRMADA,
        self::BAJA,
        self::ELIMINADA
    ];

    protected $table = 'mercado_ordenes_estados';
}
