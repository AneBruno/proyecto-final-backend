<?php
/*
namespace App\Modules\Clientes\Empresas;

use App\Tools\ModelRepository;
use App\Modules\Clientes\Categorias\CategoriaCliente;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaCategoria extends ModelRepository
{
    use SoftDeletes;
    
    protected $table = 'empresas_categorias';
    
    public $timestamps = false;
    
    static public function filtrosEq(): array {
        return ['id', 'empresa_id'];
    }
    
    static public function crear(int $empresa_id, int $categoria_id): self {
        CategoriaCliente::getById($categoria_id); // sólo para validar;
        $row               = new static;
        $row->empresa_id   = $empresa_id;
        $row->categoria_id = $categoria_id;
        return $row->insertar();
    }
}*/
