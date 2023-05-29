<?php

namespace App\Modules\Clientes\Eventos;

use App\Exceptions\BusinessException;
use App\Modules\Clientes\Eventos\Archivos\ArchivosService;
use App\Modules\Clientes\Eventos\Dtos\ActualizarEventoDto;
use App\Modules\Clientes\Eventos\Dtos\CrearEventoDto;
use App\Modules\Usuarios\Usuarios\User;
use App\Modules\Usuarios\Usuarios\UserService;

class EventosService {
    
    static public function listar(int $usuarioId, int $offset, int $limit, array $filtros = [], array $ordenes = [], array $opciones = []) {
        $filtros = static::agregarRestricciones($usuarioId, $filtros);
        return Evento::listar($offset, $limit, $filtros, $ordenes, $opciones);
    }
    
    static public function getById(int $usuarioId, int $id) {
        $filtros = static::agregarRestricciones($usuarioId);
        return Evento::getById($id, $filtros);
    }
    
    static private function agregarRestricciones(int $usuarioId, array $filtros = []): array {
        $usuario = User::getById($usuarioId);
        if ($usuario->esRepresentante()) {
            $filtros['usuario_representante_id'] = $usuarioId;
        }
        
        return $filtros;
    }
    
    static public function puedeEditarPorEventoId(User $usuario, int $eventoId): bool {
        $evento = Evento::getById($eventoId);
        return static::puedeEditar($usuario, $evento);
    }
    
    static public function puedeEditar(User $usuario, Evento $evento): bool {
        
        if ($evento->esCreadoPor($usuario->id)) {
            return true;
        }
        
        if ($evento->tieneResponsable($usuario->id)) {
            return true;
        }
        
        if ($usuario->esAdministradorPlataforma()) {
            return true;
        }
        
        if ($usuario->esResponsableComercial()) {
            return $evento->tieneComercialesYRepresentantesEnOficina($usuario->oficina_id);
        }
        
        if ($usuario->esComercial()) {
            return $evento->tieneComercialesEnOficina($usuario->oficina_id);
        }
        
        return false;
    }
    
    static public function validarPuedeEditar(User $usuario, Evento $evento) {
        if (!static::puedeEditar($usuario, $evento)) {
            throw new BusinessException('No puede editar el evento');
        }
    }

    static public function crear(CrearEventoDto $dto) {
        $usuarioCreador = User::getById($dto->usuarioId);
        $evento = Evento::crear($dto);
        ArchivosService::agregarNuevos($evento->id, $dto->obtenerArchivosNuevos());
        static::notificarUsuariosAsignados($dto->usuarioId, $evento);
        return $evento;
    }

    static public function actualizar(ActualizarEventoDto $dto) {
        $evento               = Evento::getById($dto->id);
        $estabaCerrado        = $evento->estaCerrado();
        $responsablesAExcluir = $evento->getResponsablesIds();
        static::validarPuedeEditar(User::getById($dto->usuarioId), $evento);
        
        $evento->actualizar($dto);
        ArchivosService::sincronizar ($evento->id, $dto->obtenerArchivosExistentes());
        ArchivosService::agregarNuevos($evento->id, $dto->obtenerArchivosNuevos());
        
        // Acá queda así porque los estados se manejan separados.
        if ($dto->estado === Evento::CERRADO) {
            $evento->marcarCerrado($dto->resolucion, $dto->usuarioId);
        }
        
        if ($dto->estado === Evento::ABIERTO) {
            $evento->marcarAbierto();
        }

        static::notificarUsuariosAsignados($dto->usuarioId, $evento, $responsablesAExcluir);
        
        if (!$estabaCerrado && $evento->estaCerrado()) {
            static::notificarEventoCerrado($evento);
        }
        
        return $evento;
    }
    
    static public function notificarUsuariosAsignados(int $usuarioId, Evento $evento, array $responsablesAExcluir = []): void {
        $usuario = User::getById($usuarioId);
        $responsables = $evento->responsables()->get();
        
        foreach($responsables as $responsable) {
            if (
            	in_array($responsable->id, $responsablesAExcluir) ||
				$responsable->id === $evento->usuarioCreador->id ||
				!$responsable->suscripto_notificaciones
			) {
                continue;
            }

            UserService::enviarMail($responsable, new MailEventoAsignado($usuario, $evento));
        }
    }
    
    static public function notificarEventoCerrado(Evento $evento) {
        $usuariosId = array_unique(array_merge($evento->getResponsablesIds(), [$evento->usuario_creador_id]));
        $responsables = User::listarTodos([
            'ids' => $usuariosId,
        ]);

        foreach($responsables as $responsable) {
            if (in_array($responsable->id, [$evento->usuario_cierre_id, $evento->usuario_creador_id])) {
                continue;
            }

            UserService::enviarMail($responsable, new MailEventoCerrado($evento));
        }
    }
    
    static public function obtenerLinkSpa(Evento $evento): string {
        return config('app.dashboard_url') . '/app/clientes/eventos/' . $evento->id;
    }
    
    static public function notificar() {
        $rs = Evento::listarTodos([
            'estado'         => 'ABIERTO',
            'alerta_minutos' => -5,
        ]);
        
        foreach($rs as $row) {
            static::notificarAlerta($row);
        }
    }
    
    static public function notificarAlerta(Evento $evento): void {
        foreach($evento->responsables as $responsable) {
            echo "notificando a: {$responsable->email}\n";

			UserService::enviarMail($responsable, new MailAlerta($evento));
        }
    }

}
