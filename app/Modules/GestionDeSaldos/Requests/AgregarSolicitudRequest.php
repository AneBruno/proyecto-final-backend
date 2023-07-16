<?php

/*namespace App\Modules\GestionDeSaldos\Requests;

use App\Modules\GestionDeSaldos\SolicitudFormaPago;
use App\Http\FormRequest;

class AgregarSolicitudRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     *
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
    public function rules()
    {
    	$request = $this->request;

        return  [
            'token' => 'required|string',
            'cuit' => 'required|string',
            'tipo' => 'required|string|in:Disponible,Cobranza del día,Anticipo',
            'formas_pago' => ['required', 'array'],
			'formas_pago.*.forma_pago' => 'required|string',
			'formas_pago.*.monto'      => 'required|numeric',
			'formas_pago.*.fecha'      => 'required|date_format:Y-m-d'
        ];
    }
    
     public function customValidations() {
        $value = $this->post('formas_pago');
        
        if (empty($value)) {
            $fail('Debe indicar formas de pago');
        }
        
        foreach($value as $i => $row) {
            if (!array_key_exists('fecha', $row)) {
                $this->fail("formas_pago.{$i}.fecha", 'Debe indicar la fecha');
            }

            if (!array_key_exists('forma_pago', $row)) {
                $this->fail("formas_pago.{$i}.forma_pago", 'Debe indicar la forma de pago');
            }

            if (!array_key_exists('monto', $row)) {
                $this->fail("formas_pago.{$i}.monto", 'Debe indicar el monto');
            }

            if (!is_numeric($row['monto'])) {
                $this->fail("formas_pago.{$i}.monto", 'El monto debe ser un número');
            }

            if (!($row['monto'] > 0)) {
                $this->fail("formas_pago.{$i}.monto", 'El monto debe ser mayor que cero');
            }
            
            if ($this->errors()->count()) {
                return;
            }

            if ($row['forma_pago'] === SolicitudFormaPago::FORMA_PAGO_TRANSFERENCIA) {
                if (empty($row['cbu'])) {
                    $this->fail("formas_pago.{$i}.cbu", 'Debe indicar el cbu');
                }

                if (strlen($row['cbu'])!='22') {
                    $this->fail("formas_pago.{$i}.cbu", 'El cbu debe tener 22 dígitos');
                }

                if (!is_numeric($row['cbu'])) {
                    $this->fail("formas_pago.{$i}.cbu", 'El cbu debe ser numérico');
                }
            }
        }
        
    }
}

*/