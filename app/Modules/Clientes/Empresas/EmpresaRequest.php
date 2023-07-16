<?php

namespace App\Modules\Clientes\Empresas;

use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Afip\CuitRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaRequest extends FormRequest
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
        /** @var User $usuario */
        $usuario = Auth::user();

        $rules = [
            'razon_social'         => 'required|string|max:50',
            'usuario_comercial_id' => 'nullable|int'
        ];

        if($usuario->isAdministradorPlataforma()) {
            $rules = array_merge($rules, [
                'telefono'             => 'nullable|integer',
                'email'                => 'nullable|email',
                'perfil'               => 'nullable|string|in:COMPRADOR,VENDEDOR,COMPRADOR_VENDEDOR',
                'direccion'            => 'nullable|string',
                'localidad'            => 'nullable|string',
                'provincia'            => 'nullable|string'

            ]);

            if ($this->getMethod() === 'POST') {
                $rules['cuit'        ] = ['required','integer', new CuitRule, EmpresasService::validadorCuitUnico()];
            }

            if ($this->getMethod() === 'PUT') {

                $id = array_reverse($this->segments())[0];
                $rules['cuit'   ] = ['required','integer', new CuitRule, EmpresasService::validadorCuitUnico($id)];
            }
        } else {
            $rules = array_merge($rules, [
                'telefono'             => 'required|integer',
                'email'                => 'required|email',
                'perfil'               => 'required|string|in:COMPRADOR,VENDEDOR,COMPRADOR_VENDEDOR',
                'direccion'            => 'nullable|string',
                'localidad'            => 'nullable|string',
                'provincia'            => 'nullable|string'
            ]);

            if ($this->getMethod() === 'POST') {
                $rules['cuit'        ] = ['required','integer', new CuitRule, EmpresasService::validadorCuitUnico()];
            }

            if ($this->getMethod() === 'PUT') {

                $id = array_reverse($this->segments())[0];
                $rules['cuit'   ] = ['required','integer', new CuitRule, EmpresasService::validadorCuitUnico($id)];
            }
        }
        return $rules;
    }
}
