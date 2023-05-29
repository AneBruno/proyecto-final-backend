<?php

namespace App\Modules\Clientes\Eventos\Dtos;

use App\Modules\Clientes\Eventos\FormRequests\CrearEventoRequest;
use App\Tools\DataTransferObject;
use Illuminate\Http\UploadedFile;

class CrearEventoDto extends DataTransferObject {
    
    
    public ?int    $usuarioId  = null;
    public  int    $tipo_evento_id;
    public  string $titulo;
    public ?string $descripcion;
    public  string $fecha_vencimiento;
    public ?string $fecha_alerta_1;
    public ?string $fecha_alerta_2;
    public  array  $empresas = [];
    public  array  $contactos = [];
    public  array  $responsables;
    public  array  $ordenes = [];
    public  array  $archivos = [];

    public static function fromRequest(CrearEventoRequest $request) {
        return new self($request->validated());
    }
    
    public function getIds(array $objects): array {
        return array_map(function($object) {
            return $object['id'];
        }, $objects);
    }
    
    public function obtenerArchivosExistentes(): array {
        return array_filter($this->archivos, function($archivo) {
            return is_array($archivo);
        });
    }
    
    public function obtenerArchivosNuevos(): array {
        return array_filter($this->archivos, function($archivo) {
            return $archivo instanceof UploadedFile;
        });
    }
}
