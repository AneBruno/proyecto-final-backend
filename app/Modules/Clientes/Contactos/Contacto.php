<?php

/*namespace App\Modules\Clientes\Contactos;

use App\Modules\Clientes\Cargos\Cargo;
use App\Modules\Clientes\Empresas\Empresa;
use App\Modules\Clientes\RedesSociales\RedSocial;
use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class Contacto extends ModelRepository
{
    use SoftDeletes;

    protected $table = 'contactos';

    public $timestamps = true;

    /**
     * @param string $nombre
     * @param string $telefono_celular
     * @param string $telefono_fijo
     * @param string|null $email
     * @param int $empresa_id
     * @param string|null $fecha_nacimiento
     * @param string $cargo_id
     * @param string $nivel_jerarquia
     * @return static
     * @throws RepositoryException
     *
    static public function crear(
        string  $nombre,
        string  $telefono_celular,
        ?string $telefono_fijo,
        ?string $email,
        int     $empresa_id,
        ?string $fecha_nacimiento,
        string  $cargo_id,
        string  $nivel_jerarquia
    ): self {
        $row = new static;

        $row->nombre           = $nombre;
        $row->telefono_celular = $telefono_celular;
        $row->telefono_fijo    = $telefono_fijo;
        $row->email            = $email;
        $row->empresa_id       = $empresa_id;
        $row->fecha_nacimiento = $fecha_nacimiento;
        $row->cargo_id         = $cargo_id;
        $row->nivel_jerarquia  = $nivel_jerarquia;

        return $row->insertar();
    }

    /**
     * @param string $nombre
     * @param string $telefono_celular
     * @param string $telefono_fijo
     * @param string|null $email
     * @param int $empresaId
     * @param string|null $fecha_nacimiento
     * @param string $cargo
     * @param string $nivel_jerarquia
     * @return $this
     * @throws RepositoryException
     *
    public function actualizar(
        string  $nombre,
        string  $telefono_celular,
        ?string $telefono_fijo,
        ?string $email,
        ?int    $empresa_id,
        ?string $fecha_nacimiento,
        string  $cargo_id,
        string  $nivel_jerarquia
    ): self {
        $this->nombre           = $nombre;
        $this->telefono_celular = $telefono_celular;
        $this->telefono_fijo    = $telefono_fijo;
        $this->email            = $email;
        $this->empresa_id       = $empresa_id;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->cargo_id         = $cargo_id;
        $this->nivel_jerarquia  = $nivel_jerarquia;

        return $this->guardar();
    }

    /**
     * @param Builder $query
     * @param array $filtros
     *
    static public function aplicarFiltros(Builder $query, array $filtros)
    {
        parent::aplicarFiltros($query, $filtros);
        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'ids') {
                $valor = is_array($valor) ? $valor : [$valor];
                $query->whereIn('id', $valor);
            }
            
            if ($nombre === 'empresa_id') {
                $query
                    ->Where('empresa_id', $valor);
            }
            
            if ($nombre === 'usuario_comercial_id') {
                $query->joinRelationship('empresa', function($join) use ($valor) {
                    $join->where('empresas.usuario_comercial_id', $valor);
                });
            }

            if ($nombre === 'busqueda') {
                $query->where(function($query) use($valor) {
                    $query
                        ->orWhere('nombre',           'like', "%{$valor}%")
                        ->orWhere('telefono_celular', 'like', "%{$valor}%")
                        ->orWhere('telefono_fijo',    'like', "%{$valor}%")
                        ->orWhere('email',            'like', "%{$valor}%");
                });
            }

            if ($nombre === 'nombre_empresa') {
                $query->select('contactos.*');
                $query->join('empresas', 'empresas.id', '=', 'contactos.empresa_id');
                $query->where(function($query) use($valor) {
                    $query
                        ->orWhere('contactos.nombre',      'like', "%{$valor}%")
                        ->orWhere('empresas.razon_social', 'like', "%{$valor}%");
                });
            }
        }
    }

    public function getCargoNombreAttribute(): string {
        return Cargo::getById($this->cargo_id)->nombre;
    }

    /**
     * @return HasMany
     *
    public function redesSociales()
    {
        return $this->hasMany(RedSocial::class, 'contacto_id', 'id');
    }

    /**
     * @return BelongsTo
     *
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id', 'id');
    }

    /**
     * @return HasOne
     *
    public function empresa()
    {
        return $this->hasOne(Empresa::class, 'id', 'empresa_id');
    }
}
*/