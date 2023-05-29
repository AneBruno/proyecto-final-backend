<?php

namespace App\Modules\GestionDeSaldos\Cbus;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Solicitud
 *
 * @author kodear
 */
class Cbu extends ModelRepository {
    
    protected $table = 'cbu_clientes';
    
    const ESTADO_PENDIENTE = 'Pendiente';
    const ESTADO_PROCESADO = 'Procesado';

    protected $fillable = [
        'estado',
    ];

    static public function agregar(
        $cuit,
        $razon_social,
        $mail,
        $banco,
        $cbu,
		$usuario_solicitante
    ): self {
        $row = new static;
        $row->cuit = $cuit;
        $row->razon_social = $razon_social;
        $row->mail = $mail;
        $row->banco = $banco;
        $row->cbu = $cbu;
        $row->usuario_solicitante = $usuario_solicitante;
        $row->estado = self::ESTADO_PENDIENTE;
        $row->guardar();
        
        return $row;
    }

    public function actualizar(array $data): self {
        $this->fill($data);
        return $this->guardar();
    }
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $columna => $valor) {
            if (in_array($columna, [
                'cuit',
            ])) {
                if (is_array($valor)) {
                    $query->wherein("cbu_clientes.{$columna}", array_filter($valor));
                } else {
                    $query->where("cbu_clientes.$columna", $valor);
                }
            }

            if ($columna === 'fecha_desde') {
                $query->whereDate('cbu_clientes.created_at', '>=', $valor);
            }

            if ($columna === 'fecha_hasta') {
                $query->whereDate('cbu_clientes.created_at', '<=', $valor);
            } 

            if ($columna == 'razon_social') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('cbu_clientes.razon_social', $valor);
            }

            if ($columna == 'cuits') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('cbu_clientes.cuit', $valor);
            }

            if ($columna === 'estado') {
                $query->where('cbu_clientes.estado', $valor);
            }
        }
    }

    static public function aplicarOrdenes(Builder $query, array $ordenes) {
        parent::aplicarOrdenes($query, $ordenes);

        foreach($ordenes as $columna => $valor) {
            if ($columna == 'created_at') {
                $query->orderByRaw("DATE(cbu_clientes.created_at) {$valor}");
            }

            if ($columna == 'estado') {
                $query->orderBy('estado', $valor);
            }
        }
    }
}
