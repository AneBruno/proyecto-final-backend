<?php
/*
namespace App\Modules\Clientes\Eventos\FormRequests;

use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\BusinessException;

class CrearEventoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'tipo_evento_id'    => ['required', 'exists:tipos_evento,id'   ],
            'titulo'            => ['required', 'string'                   ],
            'descripcion'       => ['nullable', 'string'                   ],
            'fecha_vencimiento' => ['required', 'date'                     ],
            'fecha_alerta_1'    => ['nullable', 'date'                     ],
            'fecha_alerta_2'    => ['nullable', 'date'                     ],
            'responsables'      => ['required', 'array'                    ],
            'empresas'          => ['nullable', 'array'                    ],
            'contactos'         => ['nullable', 'array'                    ],
            'ordenes'           => ['nullable', 'array'                    ],
            'archivos'          => ['array',    'nullable'                 ],
            
            'empresas.*.id'     => ['integer',  'exists:empresas,id'       ],
            'contactos.*.id'    => ['integer',  'exists:contactos,id'      ],
            'ordenes.*.id'      => ['integer',  'exists:mercado_ordenes,id'],
            'responsables.*.id' => ['integer',  'exists:usuarios,id'       ],
            'archivos.*'        => ['nullable'                             ],
        ];
    }
    
    public function validated(): array {
        $valores = parent::validated();
        //print_r($valores);die();
        
        if ($valores['fecha_alerta_1']) {
            $this->validarContraFechaVencimiento('fecha_alerta_1');
        }
        
        if ($valores['fecha_alerta_2']) {
                
            $this->validarContraFechaVencimiento('fecha_alerta_2'); 
            
            if (!$valores['fecha_alerta_1']) {
                throw new BusinessException('Valores inválidos', [
                    'fecha_alerta_1' => ['Complete este campo'],
                ]);   
            }
            
            if (!($valores['fecha_alerta_2'] > $valores['fecha_alerta_1'])) {
                throw new BusinessException('Valores inválidos', [
                    'fecha_alerta_2' => ['Debe ser posterior a la primer alerta'],
                ]);
            }
        }
        
        return $valores;
    }
    
    private function validarContraFechaVencimiento($campo) {
        $valores = parent::validated();
        if (substr($valores[$campo], 0, 10) > $valores['fecha_vencimiento']) {
            throw new BusinessException('Valores inválidos', [
                $campo => ['No puede ser posterior al vencimiento'],
            ]);
        }
        
    }
}
*/