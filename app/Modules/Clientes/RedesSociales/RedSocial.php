<?php
/*
namespace App\Modules\Clientes\RedesSociales;

use App\Tools\ModelRepository;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Builder;

class RedSocial extends ModelRepository
{
    protected $table = 'redes_sociales';

    public $timestamps = true;

    /**
     * @param int $contacto_id
     * @param string $red
     * @param string|null $url
     * @return static
     * @throws RepositoryException
     *
    static public function crear(int  $contacto_id, string  $red, ?string $url): self
    {
        $row = new static;

        $row->contacto_id = $contacto_id;
        $row->red = $red;
        $row->url = $url;

        return $row->insertar();
    }

    /**
     * @param string $red
     * @param string $url
     * @return $this
     * @throws RepositoryException
     *
    public function actualizar(string  $red, string $url): self
    {
        $this->red = $red;
        $this->url = $url;

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
            if ($nombre == 'contacto_id') {
                $query->where($nombre, $valor);
            }
        }
    }
}
*/