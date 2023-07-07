<?php

namespace App\Modules\Clientes\Empresas;

use App\Modules\Usuarios\Usuarios\UserService;
use App\Modules\Direcciones\Direcciones;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmpresasService {

    static public function listar(int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = []) {
        return Empresa::listar($page, $limit, $filtros, $ordenes);
    }


    static public function getById(int $id): Empresa {
        return Empresa::getById($id, [], ['expandir' => [/*'actividades_id','categorias_id',*/'urlImagenMapa','direccionCompleta']]);
    }

    static public function crear(
        int    $cuit,
        string $razonSocial,
        ?int    $telefono,
        ?string $email,
        ?string $perfil,
       /* ?float $comisionComprador,
        ?float $comisionVendedor,
        ?string $categoriaCrediticia,
        ?string $afinidad,*/
        ?int   $usuarioComercial,
        ?string $direccion,
        ?string $localidad,
        ?string $provincia
        //?string $placeId,
        //?string $descripcionUbicacion
        /*?array  $actividades_id,
        ?array  $categorias_id,
        ?string $abreviacion*/
    ): Empresa {

        DB::beginTransaction();
        static::validarPuedeUsarCuit($cuit);

        $empresa = Empresa::crear(
            $cuit,
            $razonSocial,
            $telefono,
            $email,
            $perfil,
            /*$comisionComprador,
            $comisionVendedor,
            $categoriaCrediticia,
            $afinidad,*/
            $usuarioComercial,
            $direccion,
            $localidad,
            $provincia            
            //$abreviacion
        );

        /*if ($placeId) {
            Direcciones::actualizarUbicacionPorPlaceId($empresa, $placeId);
            $empresa->actualizarDescripcionUbicacion($descripcionUbicacion);
        }*/

        /*if ($actividades_id) {
            static::actualizarActividades($empresa->id, $actividades_id);
        }

        if ($categorias_id) {
            static::actualizarCategorias($empresa->id, $categorias_id);
        }*/
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
        /*?float  $comisionComprador,
        ?float  $comisionVendedor,
        ?string  $categoriaCrediticia,
        ?string  $afinidad,*/
        ?int    $usuarioComercial,
        ?string $direccion,
        ?string $localidad,
        ?string $provincia
        //?string $placeId,
        //?string $descripcionUbicacion
        /*?array  $actividades_id,
        ?array  $categorias_id,
        ?string $abreviacion*/
    ): Empresa {

        DB::beginTransaction();

        $empresa = Empresa::getById($id);
        $empresa->actualizar(
            $cuit,
            $razonSocial,
            $telefono,
            $email,
            $perfil,
            /*$comisionComprador,
            $comisionVendedor,
            $categoriaCrediticia,
            $afinidad,*/
            $usuarioComercial,
            $direccion,
            $localidad,
            $provincia
            //$abreviacion
        );

        //$empresa->actualizarDescripcionUbicacion($descripcionUbicacion);

        /*if ($placeId) {
            Direcciones::actualizarUbicacionPorPlaceId($empresa, $placeId);
        }*/

        /*if ($actividades_id) {
            static::actualizarActividades($empresa->id, $actividades_id);
        }

        if ($categorias_id) {
            static::actualizarCategorias($empresa->id, $categorias_id);
        }*/

        DB::commit();

        return $empresa;
    }

    /*static public function actualizarActividades(int $empresa_id, array $ids) {
        $actuales = [];

        // Borrar los excedentes
        foreach(EmpresaActividad::listarTodos(['empresa_id' => $empresa_id]) as $relacion) {
            $actuales[] = $relacion->actividad_id;

            if (!in_array($relacion->actividad_id, $ids)) {
                $relacion->borrar();
            }
        }

        // Agregar los que no existen.
        foreach(array_unique($ids) as $id) {
            if (!in_array($id, $actuales)) {
                EmpresaActividad::crear($empresa_id, $id);
            }
        }
    }*/

    /*static public function actualizarCategorias(int $empresa_id, array $ids) {
        $actuales = [];

        // Borrar los excedentes
        foreach(EmpresaCategoria::listarTodos(['empresa_id' => $empresa_id]) as $relacion) {
            $actuales[] = $relacion->categoria_id;

            if (!in_array($relacion->categoria_id, $ids)) {
                $relacion->borrar();
            }
        }

        // Agregar los que no existen.
        foreach(array_unique($ids) as $id) {
            if (!in_array($id, $actuales)) {
                EmpresaCategoria::crear($empresa_id, $id);
            }
        }
    }*/

    static public function habilitar(int $id): Empresa {
        $empresa = Empresa::getById($id);
        $empresa->habilitar();

        //@todo: acá se envía el correo electrónico a la empresa.
        static::notificarEmpresaHabilitada($empresa);
        return $empresa;
    }

    static public function deshabilitar(int $id): Empresa {
        $empresa = Empresa::getById($id);
        $empresa->deshabilitar();
        return $empresa;
    }

    /*static public function borrar(int $id): void {
        Empresa::getById($id)->borrar();
    }*/

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
        $rs = UserService::listarAdministrativos();

        foreach($rs as $usuario) {
            try {
                UserService::enviarMail($usuario, new MailEmpresaNueva($empresa));
            } catch (\Exception $e) {
                // La cuenta de email puede no existir.
            }
        }
    }

    static public function notificarEmpresaHabilitada(Empresa $empresa): void {
        if (!$empresa->email) {
            return;
        }

        Mail::to($empresa->email)->send(new MailEmpresaHabilitada($empresa));
    }
}
