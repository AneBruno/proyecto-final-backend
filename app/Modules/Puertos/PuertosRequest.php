<?php

namespace App\Modules\Puertos;

use Illuminate\Foundation\Http\FormRequest;

class PuertosRequest extends FormRequest
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
            'nombre'   => 'required|string',
            'localidad'=> 'required|string',
            'provincia' => 'required|string'
        ];
        
        if ($this->getMethod() == 'POST') {
            
        }
        
        return $rules;
    }
}
