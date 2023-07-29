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
     * @param int $usuario_comercial_id
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
        int   $usuario_comercial_id,
        ?string $direccion,
        ?string $localidad,
        ?string $provincia
    ): self {

        $row = new static;
        $row->cuit                 = $cuit;
        $row->razon_social         = $razon_social;
        $row->telefono             = $telefono;
        $row->email                = $email;
        $row->perfil               = $perfil;
        $row->usuario_comercial_id = $usuario_comercial_id;
        $row->habilitada           = false;
        $row->direccion               = $direccion;
        $row->localidad               = $localidad;
        $row->provincia               = $provincia;

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
        int   $usuario_comercial_id,
        ?string $direccion,
        ?string $localidad,
        ?string $provincia
    ): self {

        $this->cuit                 = $cuit;
        $this->razon_social         = $razon_social;
        $this->telefono             = $telefono;
        $this->email                = $email;
        $this->perfil               = $perfil;
        $this->usuario_comercial_id = $usuario_comercial_id;
        $this->direccion               = $direccion;
        $this->localidad               = $localidad;
        $this->provincia               = $provincia;

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

    public function usuarioComercial() {
       return $this->belongsTo(User::class, 'usuario_comercial_id', 'id');
    }

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
            if ($nombre === 'id_not' && $valor) {
                $query->where('id', '<>', $valor);
            }
        }
    }
}
