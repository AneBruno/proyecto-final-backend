<?php

namespace App\Modules\Clientes\Categorias;

class CategoriasClienteService
{
    
    static public function listar(int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = [])
    {
        return CategoriaCliente::listar($page, $limit, $filtros, $ordenes);
    }
    

    static public function getById(int $id): CategoriaCliente
    {
        return CategoriaCliente::getById($id);
    }

    static public function crear(string $nombre, string $perfil): CategoriaCliente
    {
        $categoriaCliente = CategoriaCliente::crear($nombre, $perfil);
        
        return $categoriaCliente;
    }
    
    static public function actualizar(int $id, string $nombre, string $perfil): CategoriaCliente
    {
        $categoriaCliente = CategoriaCliente::getById($id)->actualizar($nombre, $perfil);
        return $categoriaCliente;
    }
    
    static public function habilitar(int $id): CategoriaCliente {
        $categoria = CategoriaCliente::getById($id, ['borrados' => true]);
        $categoria->habilitar();
        return $categoria;
    }
    
    static public function borrar(int $id): void
    {
        CategoriaCliente::getById($id)->borrar();
    }
}
