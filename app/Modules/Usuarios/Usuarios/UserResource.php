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
        //$urlImagen = UserService::getUrlImagen($this->id);

        return [
            'id'             => $this->id,
            'email'          => $this->email,
            'nombre'         => $this->resource->nombre,
            'nombreCompleto' => $this->nombreCompleto,
            'apellido'       => $this->apellido,
            'telefono'       => $this->telefono,
            'rol'            => new RolResource($this->rol),
            'habilitado'     => (bool) $this->habilitado,
            //'urlImagen'      => $urlImagen,
			'suscripto_notificaciones' => $this->suscripto_notificaciones,
            'accesos'        => AuthService::obtenerAccesos($this->resource),
        ];
    }
}
