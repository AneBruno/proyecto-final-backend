<?php

namespace App\Modules\Clientes\Cargos;

use Illuminate\Foundation\Http\FormRequest;

class CargoRequest extends FormRequest
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
            'nombre' => ['required','string', $this->validarNombreUnico()],
        ];
    }
    
    public function validarNombreUnico() {
        
        return function($attribute, $value, $fail) {
            $nombre = $this->request->get('nombre');
            $id     = $this->getId();
            
            if (!CargoService::esNombreUnico($nombre, $id)) {
                $fail("El cargo ya existe");
            }
        };
    }
    
    public function getId() {
        return $this->getMethod() === 'PUT' ? array_reverse($this->segments())[0] : null;
    }
}
