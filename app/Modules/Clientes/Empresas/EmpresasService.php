<?php

namespace App\Modules\Clientes\Empresas;

use App\Modules\Usuarios\Usuarios\UserService;
use App\Modules\Direcciones\Direcciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmpresasService {

    static public function listar(int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = [], array $opciones = []) {
        return Empresa::listar($page, $limit, $filtros, $ordenes, $opciones);
    }


    static public function getById(int $id): Empresa {
        return Empresa::getById($id, [], ['expandir' => ['direccionCompleta']]);
    }

    static public function crear(
        int    $cuit,
        string $razonSocial,
        ?int    $telefono,
        ?string $email,
        ?string $perfil,
        int   $usuarioComercial,
        ?string $direccion,
        ?string $localidad,
        ?string $provincia,
        ?float $comision 
    ): Empresa {

        DB::beginTransaction();
        static::validarPuedeUsarCuit($cuit);

        $empresa = Empresa::crear(
            $cuit,
            $razonSocial,
            $telefono,
            $email,
            $perfil,
            $usuarioComercial,
            $direccion,
            $localidad,
            $provincia,
            $comision    
        );

        DB::commit();

        static::notificarNuevaEmpresa($empresa);

        return $empresa;
    }

    static public function actualizar(
        int     $id,
        int     $cuit,
        string  $razonSocial,
        ?int     $telefono,
        ?string  $email,
        ?string  $perfil,
        int    $usuarioComercial,
        ?string $direccion,
        ?string $localidad,
        ?string $provincia,
        ?float $comision
    ): Empresa {

        DB::beginTransaction();

        $empresa = Empresa::getById($id);
        $empresa->actualizar(
            $cuit,
            $razonSocial,
            $telefono,
            $email,
            $perfil,
            $usuarioComercial,
            $direccion,
            $localidad,
            $provincia,
            $comision
        );

        DB::commit();

        return $empresa;
    }

    static public function habilitar(int $id): Empresa {
        $empresa = Empresa::getById($id);
        $empresa->habilitar();
        return $empresa;
    }

    static public function deshabilitar(int $id): Empresa {
        $empresa = Empresa::getById($id);
        $empresa->deshabilitar();
        return $empresa;
    }

    static public function puedeUsarCuit($cuit, ?int $empresaId = null) {
        return Empresa::contar([
            'cuit'       => $cuit,
            'id_not'     => $empresaId
        ]) === 0;
    }

    static public function validarPuedeUsarCuit(int $cuit, ?int $empresaId = null) {
        if (!static::puedeUsarCuit($cuit)) {
            throw new \Exception('El cuit ya fue ingresado en otra empresa');
        }
    }

    static public function validadorCuitUnico($empresaId = null) {
        return function($attribute, $value, $fail) use($empresaId) {
            if (!static::puedeUsarCuit($value, $empresaId)) {
                $fail("El cuit ya fue ingresado en otra empresa");
            }
        };
    }

    static public function notificarNuevaEmpresa(Empresa $empresa): void {
        $rs = UserService::listarAdministradores();

        foreach($rs as $usuario) {
            try {
                UserService::enviarMail($usuario, new MailEmpresaNueva($empresa));
            } catch (\Exception $e) {
                // La cuenta de email puede no existir.
            }
        }
    }

}
