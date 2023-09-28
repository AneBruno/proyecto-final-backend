<?php

namespace App\Modules\Mercado\Ordenes\FormRequests;

use App\Rules\PrecioRule;
use Illuminate\Foundation\Http\FormRequest;

class CerrarSlipRequest extends FormRequest
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
            //'precio'               => ['nullable', new PrecioRule(), 'numeric', 'max:999999'],
           // 'volumen'              => 'required|integer',
            'posicion_id'          => 'required|integer|exists:mercado_posiciones,id',
            'precio_cierre_slip'   => ['required', new PrecioRule(), 'numeric','max:999999'],
            'toneladas_cierre'     => 'required|numeric',
            'comision_comprador_cierre' =>'required|numeric',
            'comision_vendedor_cierre' =>'required|numeric',
        ];

        return $rules;
    }
}
