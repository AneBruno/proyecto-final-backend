<?php

namespace App\Modules\Mercado\Ordenes\Dtos;

use App\Modules\Mercado\Ordenes\FormRequests\OrdenesRequest;
use App\Tools\DataTransferObject;

class CrearOrdenDto extends DataTransferObject
{
    public ?string $id = null;
    public int $empresa_id;
    public int $producto_id;
    public int $puerto_id;
    public int $condicion_pago_id;
    public string $moneda;
    public float $precio;
    public int $volumen;
    public ?int $estado_id;
    public ?string $observaciones = null;

    public static function fromRequest(OrdenesRequest $request) {
        return new self($request->validated());
    }
}
