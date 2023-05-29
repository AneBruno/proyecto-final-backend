<?php

namespace App\Modules\Clientes\Empresas\Archivos;

use App\Modules\Clientes\Empresas\TiposArchivos\TipoArchivo;
use App\Modules\Clientes\Empresas\Empresa;
use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class Archivo extends ModelRepository
{
    use SoftDeletes;

    protected $table = 'empresas_archivos';

    public $timestamps = true;

    public $path = '';

    public $fillable = [
        'empresa_id',
        'tipo_archivo',
        'fecha_vencimiento'
    ];

    /**
     * @param int $empresaId
     * @param $fechaVencimiento
     * @param int $tipoArchivoId
     * @return static
     * @throws RepositoryException
     */
    static public function crear(int $empresaId, $fechaVencimiento, int $tipoArchivoId): self {
        $row = new static;

        $row->empresa_id = $empresaId;
        $row->fecha_vencimiento = $fechaVencimiento;
        $row->tipo_archivo_id = $tipoArchivoId;

        return $row->insertar();
    }

    /**
     * @param string $fechaVencimiento
     * @param int $tipoArchivoId
     * @return $this
     * @throws RepositoryException
     */
    public function actualizar(string $fechaVencimiento, int $tipoArchivoId): self {
        $this->tipo_archivo_id = $tipoArchivoId;
        $this->fecha_vencimiento = $fechaVencimiento;

        return $this->guardar();
    }

    /**
     * @return BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function tipoArchivo()
    {
        return $this->hasOne(TipoArchivo::class, 'id', 'tipo_archivo_id');
    }
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        
        parent::aplicarFiltros($query, $filtros);
        
        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'busqueda') {
                $query->joinRelation('tipoArchivo', function($join) use ($valor) {
                    $join->where('empresas_tipos_archivos.descripcion', 'like', "%{$valor}%");
                });
            }
            if ($nombre === 'empresa_id') {
                $query->where($nombre, $valor);
            }
        }
    }
}
