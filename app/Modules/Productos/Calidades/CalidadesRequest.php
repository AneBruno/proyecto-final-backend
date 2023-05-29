<?php

namespace App\Modules\Productos\Calidades;  

use Illuminate\Foundation\Http\FormRequest;

class CalidadesRequest extends FormRequest
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
        return [
            'nombre' => 'required|string',
            'orden'  => 'required|integer|min:0',
        ];
    }
}
