<?php

namespace App\Modules\Productos\Productos;

class ProductosService
{
    public function listar(int $offset = 0, int $limit = 0, array $filtros = [], array $ordenes = [])
    {
        if (empty($filtros) || !key_exists('habilitado', $filtros)) {
            $filtros['habilitado'] = true;
        }
        return Producto::listar($offset, $limit, $filtros, $ordenes);
    }


    public function getById(int $id): Producto
    {
        $producto = Producto::getById($id);

        return $producto;
    }

    /**
     * @param string $nombre
     * @param int $tipoProductoId
     * @return Producto
     */
    public function crear(string $nombre, int $tipoProductoId): Producto
    {
    $producto = Producto::crear($nombre, $tipoProductoId);

        return $producto;
    }

    /**
     * @param int $id
     * @param string $nombre
     * @param int $tipoProductoId
     * @return Producto
     */
    public function actualizar(
        int    $id,
        string $nombre,
        int    $tipoProductoId
    ): Producto {

        $producto = Producto::getById($id)->actualizar(
            $nombre,
            $tipoProductoId
        );

        return $producto;
    }

    /**
     * @param Producto $producto
     * @return Producto
     */
    public function habilitar(Producto $producto): Producto {
        $producto->habilitar();
        return $producto;
    }

    /**
     * @param Producto $producto
     * @return Producto
     */
    public function deshabilitar(Producto $producto): Producto {
        return $producto->deshabilitar();
    }

    /**
     *
     * @param int $id
     * @return void
     */
    public function borrar(int $id): void
    {
        Producto::getById($id)->borrar();
    }
}
