<?php

namespace App\Modules\Productos\Calidades;

class CalidadesService
{

    public function listar(int $offset = 0, int $limit = 0, array $filtros = [])
    {
        return Calidad::listar($offset, $limit, $filtros);
    }
    

    public function getById(int $id): Calidad
    {
        $calidad = Calidad::getById($id);
        
        return $calidad;
    }

    /**
     *
     * @param string $nombre
     * @param int|null $orden
     * @return Calidad
     */
    public function crear(string $nombre, int $orden): Calidad
    {
        $calidad = Calidad::crear($nombre, $orden);
        
        return $calidad;
    }
    
    /**
     *
     * @param int $id
     * @param string $nombre
     * @param int|null $orden
     * @return Calidad
     */
    public function actualizar(int $id, string $nombre, int $orden): Calidad
    {
        $calidad = Calidad::getById($id);
        $calidad->actualizar($nombre, $orden);
        
        return $calidad;
    }
    
    /**
     *
     * @param int $id
     * @return void
     */
    public function borrar(int $id): void
    {
        Calidad::getById($id)->borrar();
    }
}
