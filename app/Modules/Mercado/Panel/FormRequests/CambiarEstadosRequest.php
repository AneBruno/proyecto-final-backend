<?php

namespace App\Modules\Mercado\Panel\FormRequests;

use App\Modules\Mercado\Ordenes\Estado\OrdenEstado;
use Illuminate\Foundation\Http\FormRequest;

class CambiarEstadosRequest extends FormRequest
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
            'estado' => 'required|string|in:CREADA,DENUNCIADA,RETIRADA',
            'posiciones_ids' => 'array',
            'posiciones_ids.*' => 'integer|exists:mercado_posiciones,id'
        ];

        return $rules;
    }
}
