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
            //'descripcion_ubicacion'=> 'nullable|string',
            //abreviacion'          => 'nullable|string|max:14',
            'usuario_comercial_id' => 'nullable|int'
        ];

        if($usuario->isAdministradorPlataforma()) {
            $rules = array_merge($rules, [
                'telefono'             => 'nullable|integer',
                'email'                => 'nullable|email',
                'perfil'               => 'nullable|string|in:COMPRADOR,VENDEDOR,COMPRADOR_VENDEDOR',
                /*'comision_comprador'   => 'exclude_if:perfil,VENDEDOR|exclude_if:perfil,null|nullable|min:0|max:5',
                'comision_vendedor'    => 'exclude_if:perfil,COMPRADOR|exclude_if:perfil,null|nullable|min:0|max:5',
                'categoria_crediticia' => 'nullable|string|in:OPERAR,CONSULTAR,NO_OPERAR',
                'afinidad'             => 'nullable|string|in:FIDELIZADO,NO_FIDELIZADO',
                'actividades_id'       => 'nullable|array',
                'categorias_id'        => 'nullable|array',
                'actividades_id.*'     => 'integer|gt:0',
                'categorias_id.*'      => 'integer|gt:0',*/
                'direccion'            => 'nullable|string',
                'localidad'            => 'nullable|string',
                'provincia'            => 'nullable|string'

            ]);

            if ($this->getMethod() === 'POST') {
               // $rules['placeId'     ] = 'nullable|string';
                $rules['cuit'        ] = ['required','integer', new CuitRule, EmpresasService::validadorCuitUnico()];
            }

            if ($this->getMethod() === 'PUT') {

                $id = array_reverse($this->segments())[0];

                //$rules['placeId'] = 'nullable|string';
                $rules['cuit'   ] = ['required','integer', new CuitRule, EmpresasService::validadorCuitUnico($id)];
            }
        } else {
            $rules = array_merge($rules, [
                'telefono'             => 'required|integer',
                'email'                => 'required|email',
                'perfil'               => 'required|string|in:COMPRADOR,VENDEDOR,COMPRADOR_VENDEDOR',
                /*'comision_comprador'   => 'exclude_if:perfil,VENDEDOR|required|min:0|max:5',
                'comision_vendedor'    => 'exclude_if:perfil,COMPRADOR|required|min:0|max:5',
                'categoria_crediticia' => 'required|string|in:OPERAR,CONSULTAR,NO_OPERAR',
                'afinidad'             => 'required|string|in:FIDELIZADO,NO_FIDELIZADO',
                'actividades_id'       => 'required|array',
                'categorias_id'        => 'required|array',
                'actividades_id.*'     => 'integer|gt:0',
                'categorias_id.*'      => 'integer|gt:0',*/
                'direccion'            => 'nullable|string',
                'localidad'            => 'nullable|string',
                'provincia'            => 'nullable|string'
            ]);

            if ($this->getMethod() === 'POST') {
                //$rules['placeId'     ] = 'required|string';
                $rules['cuit'        ] = ['required','integer', new CuitRule, EmpresasService::validadorCuitUnico()];
            }

            if ($this->getMethod() === 'PUT') {

                $id = array_reverse($this->segments())[0];

               // $rules['placeId'] = 'nullable|string';
                $rules['cuit'   ] = ['required','integer', new CuitRule, EmpresasService::validadorCuitUnico($id)];
            }
        }
        return $rules;
    }
}
