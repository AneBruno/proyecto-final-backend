<?php
/*
namespace App\Modules\Clientes\Establecimientos;

use Illuminate\Foundation\Http\FormRequest;

class EstablecimientoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     *
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
    public function rules()
    {
        $rules = [
            'puerto_id'           => ['required', 'integer', EstablecimientosService::validadorPuertoExistente()],
            'nombre'              => ['required', 'string'],
            'tipo'                => ['required', 'in:CAMPO,PLANTA_ACOPIO'],
            'propio'              => ['required', 'in:SI,NO'],
            'hectareas_agricolas' => ['exclude_if:tipo,PLANTA_ACOPIO', 'required', 'integer'],
            'hectareas_ganaderas' => ['exclude_if:tipo,PLANTA_ACOPIO', 'required', 'integer'],
            'capacidad_acopio'    => ['exclude_if:tipo,CAMPO', 'required', 'integer'],
        ];

        if ($this->getMethod() === 'POST') {
            $rules['empresa_id'] = ['required', 'integer', EstablecimientosService::validadorEmpresaExistente()];
            $rules['placeId'   ] = ['required', 'string'];
        }

        if ($this->getMethod() === 'PUT') {
            $rules['placeId'] = 'nullable|string';
            $rules['descripcionUbicacion'] = 'nullable|string';
        }

        return $rules;
    }
}
*/