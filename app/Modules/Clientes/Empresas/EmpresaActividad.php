<?php
/*
namespace App\Modules\Clientes\Empresas;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaActividad extends ModelRepository
{
    use SoftDeletes;
    
    protected $table = 'empresas_actividades';
    
    public $timestamps = false;
    
    protected $fillable = [
        'empresa_id',
        'actividad_id'
        //'deleted_at',
    ];
    
    static public function filtrosEq(): array {
        return ['id', 'empresa_id'];
    }
    
    static public function crear(int $empresa_id, int $actividad_id): self {
        $row               = new static;
        $row->empresa_id   = $empresa_id;
        $row->actividad_id = $actividad_id;
        return $row->insertar();
    }
}*/
