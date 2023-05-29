<?php

namespace App\Modules\Clientes\TiposEvento;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarTipoEventoRequest extends FormRequest
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
        return  [
            'nombre'                 => 'required|string',
            'cantidad_dias_alerta_1' => 'nullable|integer',
            'cantidad_dias_alerta_2' => 'nullable|integer',
        ];
    }
}

