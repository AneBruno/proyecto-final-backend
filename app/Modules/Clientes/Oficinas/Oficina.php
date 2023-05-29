<?php

namespace App\Modules\Clientes\Oficinas;

use App\Modules\Direcciones\ModeloConLocalizacion;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Oficina extends ModeloConLocalizacion
{
    use SoftDeletes;
    
    protected $table = 'oficinas_empresa';
    
    protected $appends = [
        'urlImagenMapa',
        'direccionCompleta',
    ];
    
    public $timestamps = true;
    
    static public function crear(
        int    $empresa_id,
        string $nombre, 
        string $telefono,
        string $email
    ): self {
        $row = new static;
        $row->empresa_id = $empresa_id;
        $row->nombre     = $nombre;
        $row->telefono   = $telefono;
        $row->email      = $email;
        return $row->insertar();
    }
    
    public function actualizar(string $nombre, string $telefono, string $email): self {
        $this->nombre   = $nombre;
        $this->telefono = $telefono;
        $this->email    = $email;
        return $this->guardar();
    }
    
    public function habilitar(): self {
        $this->deleted_at = null;
        return $this->guardar();
    }
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        
        parent::aplicarFiltros($query, $filtros);
        
        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'busqueda') {
                $query->where(function($query) use ($valor) {
                   $query
                        ->orWhere('nombre',    'like', "%{$valor}%")
                        ->orWhere('telefono',  'like', "%{$valor}%")
                        ->orWhere('email',     'like', "%{$valor}%")
                        ->orWhere('direccion', 'like', "%{$valor}%");
                });
            }
            if ($nombre === 'empresa_id') {
                $query->where($nombre, $valor);
            }
        }
    }
}
