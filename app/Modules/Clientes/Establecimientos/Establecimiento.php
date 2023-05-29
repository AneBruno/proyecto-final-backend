<?php

namespace App\Modules\Clientes\Establecimientos;

use App\Modules\Clientes\Empresas\Empresa;
use App\Modules\Direcciones\ModeloConLocalizacion;
use App\Modules\Puertos\Puerto;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Establecimiento extends ModeloConLocalizacion
{
    use SoftDeletes;

    protected $table = 'establecimientos_empresa';

    protected $appends = [
        'urlImagenMapa',
        'direccionCompleta',
    ];

    public $timestamps = true;

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    static public function crear(
        int    $empresa_id,
        int    $puerto_id,
        string $nombre,
        string $tipo,
        string $propio,
        ?int   $hectareas_agricolas,
        ?int   $hectareas_ganaderas,
        ?int   $capacidad_acopio
    ): self {

        $row                      = new static;
        $row->empresa_id          = $empresa_id;
        $row->puerto_id           = $puerto_id;
        $row->nombre              = $nombre;
        $row->tipo                = $tipo;
        $row->propio              = $propio;
        $row->hectareas_agricolas = $hectareas_agricolas ?? 0;
        $row->hectareas_ganaderas = $hectareas_ganaderas ?? 0;
        $row->capacidad_acopio    = $capacidad_acopio    ?? 0;

        return $row->insertar();
    }

    public function actualizar(
        int    $puerto_id,
        string $nombre,
        string $tipo,
        string $propio,
        ?int   $hectareas_agricolas,
        ?int   $hectareas_ganaderas,
        ?int   $capacidad_acopio
    ): self {

        $this->puerto_id           = $puerto_id;
        $this->nombre              = $nombre;
        $this->tipo                = $tipo;
        $this->propio              = $propio;
        $this->hectareas_agricolas = $hectareas_agricolas ?? 0;
        $this->hectareas_ganaderas = $hectareas_ganaderas ?? 0;
        $this->capacidad_acopio    = $capacidad_acopio    ?? 0;

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
                $query->where(function($query) use($valor) {
                    $query
                        ->orWhere('nombre',    'like', "%{$valor}%")
                        ->orWhere('direccion', 'like', "%{$valor}%");
                });
            }

            if (in_array($nombre,  ['empresa_id','puerto_id','tipo','propio'])) {
                $query->where($nombre, $valor);
            }
        }
    }

    /**
     * @return BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function puerto()
    {
        return $this->belongsTo(Puerto::class, 'puerto_id', 'id');
    }

    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function getLatitud()
    {
        return $this->latitud;
    }

    public function getLongitud()
    {
        return $this->longitud;
    }

}
