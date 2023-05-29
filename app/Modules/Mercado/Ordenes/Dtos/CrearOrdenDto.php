<?php

namespace App\Modules\Mercado\Ordenes\Dtos;

use App\Modules\Mercado\Ordenes\FormRequests\OrdenesRequest;
use App\Tools\DataTransferObject;

class CrearOrdenDto extends DataTransferObject
{
    public ?string $id = null;
    public int $empresa_id;
    public int $producto_id;
    public int $calidad_id;
    public ?int $puerto_id = null;
    public ?int $establecimiento_id = null;
    public int $condicion_pago_id;
    public string $moneda;
    public float $precio;
    public int $volumen;
    public int $estado_id;
    public string $fecha_entrega_inicio;
    public string $fecha_entrega_fin;
    public ?string $observaciones = null;
    public string $entrega;
    public ?string $placeIdProcedencia = null;
    public ?string $placeIdDestino = null;
    public string $opcion_destino;

    public static function fromRequest(OrdenesRequest $request) {
        return new self($request->validated());
    }
}
