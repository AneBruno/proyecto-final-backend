<?php

namespace App\Modules\Clientes\Empresas\Archivos;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ArchivoRequest extends FormRequest
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
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'fecha_vencimiento' => 'required|date',
            'tipo_archivo_id' => 'required|integer|exists:empresas_tipos_archivos,id',
            'archivo_adjunto' => 'required|file'
        ];

        if ($this->method() === self::METHOD_PUT) {
            $rules['archivo_adjunto'] = 'nullable|file';
        }

        return $rules;
    }
}
