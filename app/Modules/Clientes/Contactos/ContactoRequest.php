<?php

namespace  App\Modules\Clientes\Contactos;

use App\Modules\Clientes\Cargos\Cargo;
use Illuminate\Foundation\Http\FormRequest;

class ContactoRequest extends FormRequest
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
        $cargoClass = Cargo::class;
        $rules = [
            'nombre'           => 'required|string',
            'telefono_celular' => ['required','integer', ContactosService::validadorTelefono()],
            'telefono_fijo'    => ['nullable','integer', ContactosService::validadorTelefono()],
            'email'            => 'nullable|email',
            'empresa_id'       => 'required|integer',
            'fecha_nacimiento' => 'sometimes|nullable|date_format:Y-m-d',
            'cargo_id'         => ['required','integer', "exists:{$cargoClass},id"],
            'nivel_jerarquia'  => 'required|digits_between:1,5',
        ];

        return $rules;
    }    
}
