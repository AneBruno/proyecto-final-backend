<?php

/*namespace App\Modules\Clientes\Contactos;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class ContactosService
{

    /**
     * @param int $page
     * @param int $limit
     * @param array $filtros
     * @param array $ordenes
     * @return LengthAwarePaginator
     *
    static public function listar(int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = [])
    {
        return Contacto::listar($page, $limit, $filtros, $ordenes, ['expandir'=>['cargoNombre'],'with_relation'=>['empresa']]);
    }


    static public function getById(int $id): Contacto
    {
        return Contacto::getById($id, [], ['expandir'=>['cargoNombre'], 'with_relation'=>['empresa','cargo']]);
    }

    /**
     * @param string $nombre
     * @param string $telefono_celular
     * @param string $telefono_fijo
     * @param string|null $email
     * @param int|null $empresa_id
     * @param string|null $fecha_nacimiento
     * @param string $cargo_id
     * @param string $nivel_jerarquia
     * @param string|null $direccion
     * @return Contacto
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
    ): Contacto {

        DB::beginTransaction();

        $contacto = Contacto::crear(
            $nombre,
            $telefono_celular,
            $telefono_fijo,
            $email,
            $empresa_id,
            $fecha_nacimiento,
            $cargo_id,
            $nivel_jerarquia
        );

        DB::commit();

        return $contacto;
    }

    /**
     * @param int $id
     * @param string $nombre
     * @param string $telefono_celular
     * @param string $telefono_fijo
     * @param string|null $email
     * @param int|null $empresa_id
     * @param string|null $fecha_nacimiento
     * @param string $cargo_id
     * @param string $nivel_jerarquia
     * @param string|null $direccion
     * @return Contacto
     * @throws RepositoryException
     *
    static public function actualizar(
        int     $id,
        string  $nombre,
        string  $telefono_celular,
        ?string $telefono_fijo,
        ?string $email,
        ?int    $empresa_id,
        ?string $fecha_nacimiento,
        string  $cargo_id,
        string  $nivel_jerarquia
    ): Contacto {

        DB::beginTransaction();

        $contacto = Contacto::getById($id);
        $contacto->actualizar(
            $nombre,
            $telefono_celular,
            $telefono_fijo,
            $email,
            $empresa_id,
            $fecha_nacimiento,
            $cargo_id,
            $nivel_jerarquia
        );

        DB::commit();

        return $contacto;
    }

    static public function validarCargo($empresa_id, $cargo_id, $contacto_id = null) {
        return Contacto::contar([
            'empresa_id' => $empresa_id,
            'cargo_id'   => $cargo_id,
            'id_not'     => $contacto_id,
        ]) === 0;
    }

    static public function validarEmail($empresa_id, $email, $contacto_id = null) {
        return Contacto::contar([
            'empresa_id' => $empresa_id,
            'email'      => $email,
            'id_not'     => $contacto_id
        ]) === 0;
    }

    static public function validarNombre($empresa_id, $nombre, $contacto_id = null) {
        return Contacto::contar(['empresa_id' => $empresa_id, 'nombre'   => $nombre  , 'id_not' => $contacto_id]);
    }

    /**
     * @param int $id
     * @throws RepositoryException
     *
    static public function borrar(int $id): void
    {
        Contacto::getById($id)->borrar();
    }

    static public function obtenerAlertaExistente(int $empresa_id, string $nombre, ?string $email = null, ?int $contacto_id = null): array {
        $rs = Contacto::listarTodos([
            'empresa_id' => $empresa_id,
            'id_not'     => $contacto_id,
        ]);

        $repiteNombre = false;
        $repiteEmail = false;
        foreach($rs as $contacto) {
            if ($contacto->nombre == $nombre) {
                $repiteNombre = true;
            }
            if ($contacto->email == $email && $email) {
                $repiteEmail = true;
            }
        }

        $mensaje = [];

        if ($repiteNombre) {
            $mensaje[] = "El contacto \"{$nombre}\" ya existe en esta empresa.";
        }

        if ($repiteEmail) {
            $mensaje[] = "El contacto \"{$email}\" ya existe en esta empresa.";
        }

        return $mensaje;
    }

    static public function validadorTelefono() {
        return function($attribute, $value, $fail) {
            $stringValue = "{$value}";
            if (strlen($stringValue) != 13) {
                $fail("El teléfono dete tener 13 dígitos: 549 000 0000000");
            }
            if (substr($stringValue, 0, 3) !== '549') {
                $fail("El teléfono debe comenzar con 549");
            }
        };
    }
}
*/