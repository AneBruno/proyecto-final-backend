<?php

namespace App\Modules\Direcciones;
use App\Tools\ModelRepository;

class ModeloConLocalizacion extends ModelRepository {

    public function actualizarUbicacion(
        float  $latitud,
        float  $longitud,
        string $codigo_postal,
        string $direccion,
        string $localidad,
        string $departamento,
        string $provincia
    ): self {

        $this->direccion     = $direccion;
        $this->latitud       = $latitud;
        $this->longitud      = $longitud;
        $this->codigo_postal = $codigo_postal;
        $this->localidad     = $localidad;
        $this->departamento  = $departamento;
        $this->provincia     = $provincia;

        return $this->guardar();
    }

    public function actualizarDescripcionUbicacion(?string $descripcion_ubicacion = null): self {
        $this->descripcion_ubicacion = $descripcion_ubicacion;
        return $this->guardar();
    }

    public function getUrlImagenMapaAttribute(): string {
        return Direcciones::getUrlImagen($this);
    }

    public function getDireccionCompletaAttribute(): string {
        return implode(', ', array_filter([
            $this->direccion,
            $this->codigo_postal,
            $this->localidad,
            $this->departamento,
            $this->provincia,
            $this->descripcion_ubicacion
        ]));
    }
}
