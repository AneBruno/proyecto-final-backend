<?php

namespace App\Modules\Mercado\Posiciones;

use App\Rules\LatitudLongitudRule;
use App\Rules\PrecioRule;
use Illuminate\Foundation\Http\FormRequest;

class PosicionesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'id' => 'nullable',
            'producto_id' => 'required|integer|exists:productos,id',
            'calidad_id' => 'nullable|integer|exists:calidades,id',
            'calidad_observaciones' => 'nullable|string',
            'fecha_entrega_inicio' => 'nullable|date',
            'fecha_entrega_fin' => 'nullable|date|after_or_equal:fecha_entrega_inicio',
            'empresa_id' => 'required|integer|exists:empresas,id',
            'opcion_destino' => ['nullable', 'in:consumo,exportacion'],
            'puerto_id' => 'required|integer|exists:puertos,id',
            'establecimiento_id' => 'nullable|exists:establecimientos_empresa,id',
            'a_fijar' => 'nullable|bool',
            'moneda' => ['required', 'string', 'in:USD,AR$'/*, 'required_if:a_fijar,==,0'*/],
            'precio' => ['required', new PrecioRule(), 'numeric', 'max:999999'/*, 'required_if:a_fijar,==,0'*/],
            'condicion_pago_id' => 'required|integer|exists:condiciones_pago,id',
            'posicion_excepcional' => 'nullable',
            'volumen_limitado' => 'nullable',
            'a_trabajar' => 'nullable',
            'cosecha_id' => 'required|integer|exists:mercado_cosechas,id',
            'observaciones' => 'nullable|string',
            'entrega' => 'nullable|string|in:DISPONIBLE,LIMIT,CONTRACTUAL,FORWARD',
            //'placeId' => [$this->validarPlaceId()],
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'moneda.required_if' => 'Obligatorio',
            'precio.required_if' => 'Obligatorio',
            'puerto_id.required_if' => 'Obligatorio',
            //'opcion_destino.required' => 'Seleccione una opción'
        ];
    }

    /*private function validarPlaceId()
    {
        return function($attribute, $value, $fail) {
            //$placeId = $this->get('placeId');
            //$opcionDestino = $this->get('opcion_destino');
            //$establecimientoId = $this->get('establecimiento_id');
            $id = $this->get('id');

            if ($opcionDestino === 'consumo' && is_null($placeId) && is_null($establecimientoId) && is_null($id)) {
                $fail('Obligatorio');
            }

        };
    }*/
}