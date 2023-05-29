<?php

namespace App\Modules\Mercado\Cosechas;

use Illuminate\Foundation\Http\FormRequest;

class CosechaRequest extends FormRequest
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
            'descripcion' => 'required|string',
            'habilitado' => 'sometimes|boolean'
        ];

        return $rules;
    }
}
