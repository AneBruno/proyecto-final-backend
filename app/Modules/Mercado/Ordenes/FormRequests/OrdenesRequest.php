<?php

namespace App\Modules\Mercado\Ordenes\FormRequests;

use App\Modules\Clientes\Establecimientos\Establecimiento;
use App\Modules\Mercado\Ordenes\Orden;
use App\Modules\Mercado\Ordenes\OrdenesHelper;
use App\Modules\Mercado\Cosechas\CosechaResource;
use App\Rules\EstablecimientosRule;
use App\Rules\PrecioRule;
use Illuminate\Foundation\Http\FormRequest;

class OrdenesRequest extends FormRequest
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
        $hoy = date("Y-m-d");
        $rules = [
            'id'                   => 'nullable', //Id que se manda cuando se copia una orden.
            'empresa_id'           => 'required|integer|exists:empresas,id',
            'producto_id'          => 'required|integer|exists:productos,id',
            'puerto_id'            => 'required|integer|exists:puertos,id|nullable',
            'cosecha_id'           => 'required|integer|exists:mercado_cosechas,id',
            'condicion_pago_id'    => 'required|integer|exists:condiciones_pago,id',
            'moneda'               => 'required|string|in:USD,AR$',
            'precio'               => ['required', new PrecioRule(), 'numeric', 'max:999999'],
            'volumen'              => 'required|numeric|gt:0',
            'estado_id'            => 'nullable|integer|exists:mercado_ordenes_estados,id',
            'observaciones'        => 'nullable|string',
            'toneladas_cierre'     => 'nullable|numeric|gt:0',
            

        ];

        return $rules;
    }

    
}
