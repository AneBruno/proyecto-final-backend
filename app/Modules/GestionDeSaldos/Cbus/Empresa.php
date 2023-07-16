<?php

/*namespace App\Modules\GestionDeSaldos\Cbus;

use App\Tools\ModelRepository;
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
class Empresa extends ModelRepository {
    
    protected $table = 'cbu_clientes';
    
    static public function generarConsulta(array $filtros = [], array $ordenes = [], array $opciones = []): Builder {
        $query = parent::generarConsulta($filtros, $ordenes, $opciones);
        $query->select([
            'cuit',
            'razon_social',
        ]);
        $query->groupBy(['cuit', 'razon_social']);
        $query->orderBy('razon_social', 'asc');
        return $query;
    }
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $columna => $valor) {
            if ($columna == 'razon_social') {
                $query->where('razon_social', 'like', "%{$valor}%");
            }
            if ($columna == 'busqueda') {
                $query->where('razon_social', 'like', "%{$valor}%");
            }
        }
    }
}
*/