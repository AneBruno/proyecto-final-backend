<?php

namespace App\Modules\Usuarios\Usuarios;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActualizarDatosPorAdministradorRequest extends FormRequest
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
            'rol_id'     => 'required|integer',
            //'oficina_id' => 'nullable|integer'
			/*'aprobacion_cbu' => ['required', Rule::in([0, 1])],
			'aprobacion_gerencia_comercial' => ['required', Rule::in([0, 1])],
			'aprobacion_dpto_creditos' => ['required', Rule::in([0, 1])],
			'aprobacion_dpto_finanzas' => ['required', Rule::in([0, 1])],
			'confirmacion_pagos' => ['required', Rule::in([0, 1])]*/
        ];
    }
}
