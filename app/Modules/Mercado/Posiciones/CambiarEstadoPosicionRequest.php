<?php

namespace App\Modules\Mercado\Posiciones;

use Illuminate\Foundation\Http\FormRequest;

class CambiarEstadoPosicionRequest extends FormRequest
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
            'estado' => 'required|string|in:ACTIVA,ELIMINADA',
        ];

        return $rules;
    }
}
