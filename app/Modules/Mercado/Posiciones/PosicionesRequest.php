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
            'producto_id'           => 'required|integer|exists:productos,id',
            'empresa_id'            => 'required|integer|exists:empresas,id',
            'puerto_id'             => 'required|integer|exists:puertos,id',
            'moneda'                => ['required', 'string', 'in:USD,AR$'],
            'precio'                => ['required', new PrecioRule(), 'numeric', 'max:999999'],
            'condicion_pago_id'     => 'required|integer|exists:condiciones_pago,id',
            'cosecha_id'            => 'required|integer|exists:mercado_cosechas,id',
            'observaciones'         => 'nullable|string',
            'volumen'               => 'required|numeric|gt:0',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'moneda.required_if' => 'Obligatorio',
            'precio.required_if' => 'Obligatorio',
            'puerto_id.required_if' => 'Obligatorio',
            'volumen.required_if' => 'Obligatorio',
        ];
    }

}