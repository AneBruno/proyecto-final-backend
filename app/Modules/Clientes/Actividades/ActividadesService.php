<?php

namespace App\Modules\Clientes\Actividades;

class ActividadesService
{
    
    static public function listar(int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = [])
    {
        return Actividad::listar($page, $limit, $filtros, $ordenes);
    }
    

    static public function getById(int $id): Actividad
    {
        return Actividad::getById($id);
    }

    /**
     *
     * @param string $nombre
     * @param int|null $perfil
     * @return CategoriaCliente
     */
    static public function crear(string $nombre): Actividad
    {
        $categoriaCliente = Actividad::crear($nombre);
        
        return $categoriaCliente;
    }
    
    /**
     *
     * @param int $id
     * @param string $nombre
     * @param int|null $perfil
     * @return CategoriaCliente
     */
    static public function actualizar(int $id, string $nombre): Actividad
    {
        return Actividad::getById($id)->actualizar($nombre);
    }
    
    static public function habilitar(int $id): Actividad {
        $row = Actividad::getById($id, ['borrados' => true]);
        $row->habilitar();
        return $row;
    }
    
    /**
     *
     * @param int $id
     * @return void
     */
    static public function borrar(int $id): void
    {
        Actividad::getById($id)->borrar();
    }
}
