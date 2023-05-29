<?php

namespace App\Modules\Mercado\Ordenes\FormRequests;

use App\Modules\Clientes\Establecimientos\Establecimiento;
use App\Modules\Mercado\Ordenes\Orden;
use App\Modules\Mercado\Ordenes\OrdenesHelper;
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
            'calidad_id'           => 'required|integer|exists:calidades,id',
            'puerto_id'            => 'required_if:opcion_destino,=,exportacion|integer|exists:puertos,id|nullable',
            'establecimiento_id'   => 'nullable|exists:establecimientos_empresa,id',
            'condicion_pago_id'    => 'required|integer|exists:condiciones_pago,id',
            'moneda'               => 'nullable|string|in:USD,AR$',
            'precio'               => ['nullable', new PrecioRule(), 'numeric', 'max:999999'],
            'volumen'              => 'required|integer',
            'estado_id'            => 'required|integer|exists:mercado_ordenes_estados,id',
            'fecha_entrega_inicio' => ['nullable','date',"after_or_equal:$hoy"],
            'fecha_entrega_fin'    => 'nullable|date|after_or_equal:fecha_entrega_inicio',
            'observaciones'        => 'nullable|string',
            'entrega'              => 'required|string|in:DISPONIBLE,LIMIT,CONTRACTUAL,FORWARD',
            'placeIdProcedencia'   => [$this->validarPlaceIdProcedencia()],
            'placeIdDestino'       => [$this->validarPlaceIdDestino()],
            'opcion_destino'       => ['required', 'in:consumo,exportacion'],

        ];

        return $rules;
    }

    private function validarPlaceIdProcedencia()
    {
        return function($attribute, $value, $fail) {
            $placeIdProcedencia = $this->get('placeIdProcedencia');
            $establecimientoId = $this->get('establecimiento_id');
            $idOrdenCopia = $this->get('id');

            //Si existe $idOrdenCopia es porque se está copiando, entonces si no se llega a pasar ni establecimientoId de placeIdProcedencia
            //se va a copiar la geolocalización de procedencia de la orden copiada.
            if (is_null($placeIdProcedencia) && is_null($establecimientoId) && is_null($idOrdenCopia)) {
                $fail('Obligatorio');
            }
        };
    }

    private function validarPlaceIdDestino()
    {
        return function($attribute, $value, $fail) {
            $placeIdDestino = $this->get('placeIdDestino');
            $opcionDestino = $this->get('opcion_destino');

            /** @var Orden $orden */
            $ordenCopiada = OrdenesHelper::getById($this->get('id'));

            if ($opcionDestino === 'consumo' && (is_null($ordenCopiada) || !$ordenCopiada->isConsumo())) {
                if (is_null($placeIdDestino)) {
                    $fail('Obligatorio');
                }
            }
        };
    }
}
