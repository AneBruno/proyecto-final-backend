<?php

/*namespace App\Modules\GestionDeSaldos;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *

/**
 * Description of Solicitud
 *
 * @author kodear
 *
class Solicitud extends ModelRepository {
    
    protected $table = 'solicitudes';
    
    const TIPO_DISPONIBLE       = 'Disponible';
    const TIPO_COBRANZA_DEL_DIA = 'Cobranza del día';
    const TIPO_ANTICIPO         = 'Anticipo';

    protected $fillable = [
        'estado_id',
    ];

    static public function agregar(
        $cuit,
        $razon_social,
        $cliente_email,
        $nombre_usuario,
        $usuario_email,
        $usuario_rol_id,
        $tipo,
        $estado_id,
        $observaciones
    ): self {
        $row = new static;
        $row->cuit               = $cuit;
        $row->razon_social       = $razon_social;
        $row->mail_cliente		 = $cliente_email;
        $row->nombre_usuario     = $nombre_usuario;
        $row->mail_usuario		 = $usuario_email;
        $row->usuario_rol_id     = $usuario_rol_id;
        $row->tipo               = $tipo;
        $row->estado_id          = $estado_id;
        $row->observaciones      = $observaciones;
        $row->guardar();
        
        return $row;
    }
    
    public function actualizar(array $data): self {
        $this->fill($data);
        return $this->guardar();
    }

    public function actualizarTotal($valor): self {
        $this->monto_total = $valor;
        $this->guardar();
        
        return $this;
    }

    public function formasPago(): HasMany {
        return $this->hasMany(SolicitudFormaPago::class, 'solicitud_id', 'id');
    }

    public function estadoSolicitud() {
        return $this->hasOne(EstadoSolicitud::class, 'id', 'estado_id');
    }
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $nombre => $valor) {
            
            if (in_array($nombre, [
                'cuit',
                'nombre_usuario',
                'estado_id',
            ])) {
                
                if (is_array($valor)) {
                    $valor = array_filter($valor);
                    $query->whereIn("solicitudes.$nombre", array_filter($valor));
                } else {
                    $query->where("solicitudes.$nombre", $valor);
                }
            }

            if ($nombre === 'fecha_desde') {
                $query->whereDate('solicitudes.created_at', '>=', $valor);
            }

            if ($nombre === 'fecha_hasta') {
                $query->whereDate('solicitudes.created_at', '<=', $valor);
            }

            if ($nombre == 'razon_social') {
                $valor = is_array($valor) ? $valor : explode($valor, ',');
                $query->whereIn('solicitudes.razon_social', $valor);
            }

            if ($nombre == 'cuits') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('solicitudes.cuit', $valor);
            }
            
            if ($nombre === 'condiciones_rol_7') {
                $query->whereRaw("(
                    tipo IN ('Disponible', 'Cobranza del día')
                    OR
                    (tipo = 'Anticipo' AND estado_id = '7')
                )");
            }
        }
    }

    static public function aplicarOrdenes(Builder $query, array $ordenes) {
        parent::aplicarOrdenes($query, $ordenes);

        foreach($ordenes as $columna => $valor) {
            if ($columna == 'created_at') {
                $query->orderBy('created_at', $valor);
            }
        }
    }
}
*/