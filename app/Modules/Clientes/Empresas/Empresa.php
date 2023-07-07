<?php

namespace App\Modules\Clientes\Empresas;

use App\Modules\Clientes\Empresas\Archivos\Archivo;
use App\Modules\Direcciones\ModeloConLocalizacion;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class Empresa extends ModeloConLocalizacion
{
    use SoftDeletes;

    protected $table = 'empresas';

    public $timestamps = true;

    /**
     * @param int $cuit
     * @param string $razon_social
     * @param int $telefono
     * @param string $email
     * @param string $perfil
     * @param int|null $usuario_comercial_id
     * @param string|null $direccion
     * @param string|null $localidad
     * @param string|null $provincia
     * @return static
     * @throws RepositoryException
     */
    static public function crear(
        int    $cuit,
        string $razon_social,
        ?int    $telefono,
        ?string $email,
        ?string $perfil,
        //?float $comision_comprador,
        //?float $comision_vendedor,
        //?string $categoria_crediticia,
        //?string $afinidad,
        ?int   $usuario_comercial_id,
        ?string $direccion,
        ?string $localidad,
        ?string $provincia
        //?string $abreviacion
    ): self {

        $row = new static;
        $row->cuit                 = $cuit;
        $row->razon_social         = $razon_social;
        $row->telefono             = $telefono;
        $row->email                = $email;
        $row->perfil               = $perfil;
        /*$row->comision_comprador   = $comision_comprador;
        $row->comision_vendedor    = $comision_vendedor;
        $row->categoria_crediticia = $categoria_crediticia;
        $row->afinidad             = $afinidad;*/
        $row->usuario_comercial_id = $usuario_comercial_id;
        $row->habilitada           = false;
        $row->direccion               = $direccion;
        $row->localidad               = $localidad;
        $row->provincia               = $provincia;

        //$row->abreviacion          = $abreviacion;

        return $row->insertar();
    }

    /**
     *
     * @param string $nombre
     * @param int|null $perfil
     * @return CategoriaCliente
     */
    public function actualizar(
        int    $cuit,
        string $razon_social,
        ?int    $telefono,
        ?string $email,
        ?string $perfil,
        /*?float $comision_comprador,
        ?float $comision_vendedor,
        ?string $categoria_crediticia,
        ?string $afinidad,*/
        ?int   $usuario_comercial_id,
        ?string $direccion,
        ?string $localidad,
        ?string $provincia
        
        //?string $abreviacion
    ): self {

        $this->cuit                 = $cuit;
        $this->razon_social         = $razon_social;
        $this->telefono             = $telefono;
        $this->email                = $email;
        $this->perfil               = $perfil;
        /*$this->comision_comprador   = $comision_comprador;
        $this->comision_vendedor    = $comision_vendedor;
        $this->categoria_crediticia = $categoria_crediticia;
        $this->afinidad             = $afinidad;*/
        $this->usuario_comercial_id = $usuario_comercial_id;
        $this->direccion               = $direccion;
        $this->localidad               = $localidad;
        $this->provincia               = $provincia;
        //$this->abreviacion          = $abreviacion;

        return $this->guardar();
    }

    public function habilitar(): self {
        $this->habilitada = true;
        $this->save();
        return $this;
    }

    public function deshabilitar(): self {
        $this->habilitada = false;
        $this->save();
        return $this;
    }

    /*public function getActividadesIdAttribute(): array {
        $rs = EmpresaActividad::listarTodos([ 'empresa_id' => $this->id ]);
        $ids = [];
        foreach($rs as $row) {
            $ids[] = $row->actividad_id;
        }

        return $ids;
    }*/

    /*public function getCategoriasIdAttribute(): array {
        $rs = EmpresaCategoria::listarTodos([ 'empresa_id' => $this->id ]);
        $ids = [];
        foreach($rs as $row) {
            $ids[] = $row->categoria_id;
        }

        return $ids;
    }*/

    public function usuarioComercial() {
        return $this->hasOne(User::class, 'id', 'usuario_comercial_id')->withTrashed();
    }


    /**
     * @return HasMany
     */
    /*public function archivos()
    {
        return $this->hasMany(Archivo::class, 'empresa_id', 'id');
    }*/

    static public function aplicarFiltros(Builder $query, array $filtros) {
        // esto es para evitar que el join con otras tablas reemplacen los
        // ids y columnas con mismo nombre.
        $query->select(['empresas.*']);
        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'ids') {
                $valor = is_array($valor) ? $valor : [$valor];
                $query->whereIn('id', $valor);
            }
            if ($nombre === 'busqueda') {
                if (is_numeric($valor)) {
                    $query->where(function($query) use($valor) {
                        $query->orWhere('cuit', $valor);
                        $query->orWhere('cuit', 'like', "%{$valor}%");
                    });
                } else {
                    $query->where('razon_social', 'like', "%{$valor}%");
                }
            }
            if (in_array($nombre, ['cuit', 'usuario_comercial_id','habilitada'])) {
                $query->where($nombre, $valor);
            }
            if ($nombre == 'perfil') {
                if (in_array($valor, ['COMPRADOR', 'VENDEDOR'])) {
                    $query->whereIn($nombre, [$valor, 'COMPRADOR_VENDEDOR']);
                } else {
                    $query->where($nombre, $valor);
                }
            }
            /*if ($nombre == 'categoria_id') {
                $query->join('empresas_categorias', 'empresas_categorias.empresa_id', '=', 'empresas.id')
                        ->whereIn('empresas_categorias.categoria_id', $valor)
                        ->where('empresas_categorias.deleted_at', null);
                $query->groupBy('empresas.id');
            }*/
            /*if ($nombre == 'actividad_id') {
                $query->join('empresas_actividades', 'empresas_actividades.empresa_id', '=', 'empresas.id')
                        ->whereIn('empresas_actividades.actividad_id', $valor)
                        ->where('empresas_actividades.deleted_at', null);
                $query->groupBy('empresas.id');
            }*/
            if ($nombre === 'id_not' && $valor) {
                $query->where('id', '<>', $valor);
            }
        }
    }
}
