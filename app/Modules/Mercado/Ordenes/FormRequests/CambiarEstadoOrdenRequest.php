<?php

namespace App\Modules\Mercado\Ordenes\FormRequests;

use App\Modules\Clientes\Establecimientos\Establecimiento;
use App\Rules\EstablecimientosRule;
use Illuminate\Foundation\Http\FormRequest;

class CambiarEstadoOrdenRequest extends FormRequest
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
            'estado_id'            => 'required|integer|exists:mercado_ordenes_estados,id'
        ];

        return $rules;
    }
}
