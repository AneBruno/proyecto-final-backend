<?php

namespace App\Modules\Usuarios\Usuarios;

use App\Modules\Auth\AuthService;
use App\Modules\Usuarios\Roles\RolResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $urlImagen = UserService::getUrlImagen($this->id);

        return [
            'id'             => $this->id,
            'email'          => $this->email,
            'nombre'         => $this->nombre,
            'nombreCompleto' => $this->nombreCompleto,
            'apellido'       => $this->apellido,
            'telefono'       => $this->telefono,
            'rol'            => new RolResource($this->rol),
            //'oficina'        => $this->oficina,
            //'oficina_id'     => $this->oficina_id,
            'habilitado'     => (bool) $this->habilitado,
            'urlImagen'      => $urlImagen,
			/*'aprobacion_cbu' => $this->aprobacion_cbu,
			'aprobacion_gerencia_comercial' => $this->aprobacion_gerencia_comercial,
			'aprobacion_dpto_creditos' => $this->aprobacion_dpto_creditos,
			'aprobacion_dpto_finanzas' => $this->aprobacion_dpto_finanzas,
			'confirmacion_pagos' => $this->confirmacion_pagos,*/
			'suscripto_notificaciones' => $this->suscripto_notificaciones,
            'accesos'        => AuthService::obtenerAccesos($this->resource),
        ];
    }
}
