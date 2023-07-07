<?php

namespace App\Modules\Puertos;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Direcciones\ModeloConLocalizacion;
use Illuminate\Database\Eloquent\Builder;

class Puerto extends ModeloConLocalizacion
{
    use SoftDeletes;

    protected $table = 'puertos';

    public $timestamps = true;

    protected $fillable = [
        'estado'
    ];

    /*protected $appends = [
        'urlImagenMapa',
        'direccionCompleta',
    ];*/

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    static public function crear(string $nombre, string $localidad, string $provincia/*, string $terminal*/): self {
        $row           = new static;
        $row->nombre   = $nombre;
        $row->localidad = $localidad;
        $row->provincia = $provincia;
        //$row->terminal = $terminal;
        $row->estado   = 'HABILITADO';
        return $row->insertar();
    }

    public function actualizar(string $nombre, string $localidad, string $provincia/*, string $terminal*/): self {
        $this->nombre   = $nombre;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
        //$this->terminal = $terminal;
        return $this->guardar();
    }

    static public function aplicarFiltros(Builder $query, array $filtros) {

        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'busqueda') {
                $query->where(function(Builder $query) use ($valor) {
                    $query
                        ->orWhere('nombre',       'like', "%{$valor}%")
                        ->orWhere('localidad', 'like', "%{$valor}%")
                        //->orWhere('terminal',     'like', "%{$valor}%")
                        //->orWhere('direccion',    'like', "%{$valor}%")
                        //->orWhere('departamento', 'like', "%{$valor}%")
                        ->orWhere('provincia',    'like', "%{$valor}%");
                });
            }

            if ($nombre === 'estado') {
                if ($valor !== 'todos') {
                    $query->where('estado', '=', $valor);
                }
            }
        }
    }

    public function getLocalidad()
    {
        return $this->localidad;
    }

    /*public function getDepartamento()
    {
        return $this->departamento;
    }*/

    public function getProvincia()
    {
        return $this->provincia;
    }

    /*public function getLatitud()
    {
        return $this->latitud;
    }

    public function getLongitud()
    {
        return $this->longitud;
    }*/
}
