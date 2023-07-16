<?php
/*
namespace App\Modules\Oficinas;

class OficinasService
{
    
    public function listar(int $offset = 0, int $limit = 0, array $filtros = [])
    {
        $collection = Oficina::listar($offset, $limit, $filtros);
        
        return $collection;
    }
    

    public function getById(int $id): Oficina
    {
        $oficina = Oficina::getById($id);
        
        return $oficina;
    }

    /**
     *
     * @param string $nombre
     * @param int|null $oficina_madre_id
     * @return Oficina
     *
    public function crear(string $nombre, ?int $oficina_madre_id): Oficina
    {
        $oficina = Oficina::crear($nombre, $oficina_madre_id);
        
        return $oficina;
    }
    
    /**
     *
     * @param int $id
     * @param string $nombre
     * @param int|null $oficina_madre_id
     * @return Oficina
     *
    public function actualizar(int $id, string $nombre, ?int $oficina_madre_id): Oficina
    {
        $oficina = Oficina::getById($id)->actualizar($nombre, $oficina_madre_id);
        
        return $oficina;
    }
    
    /**
     *
     * @param int $id
     * @return void
     *
    public function borrar(int $id): void
    {
        Oficina::getById($id)->borrar();
    }
}
*/