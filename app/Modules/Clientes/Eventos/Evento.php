<?php

namespace App\Modules\Clientes\Eventos;

use App\Modules\Clientes\Contactos\Contacto;
use App\Modules\Clientes\Empresas\Empresa;
use App\Modules\Clientes\Eventos\Dtos\ActualizarEventoDto;
use App\Modules\Clientes\Eventos\Dtos\CrearEventoDto;
use App\Modules\Clientes\Eventos\Archivos\Archivo;
use App\Modules\Clientes\TiposEvento\TipoEvento;
use App\Modules\Mercado\Ordenes\Orden;
use App\Modules\Usuarios\Usuarios\User;
use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Evento extends ModelRepository {
    protected $table = 'eventos';

    public $timestamps = true;

    public $fillable = [
        'tipo_evento_id',
        'titulo',
        'usuario_creador_id',
        'descripcion',
        'fecha_vencimiento',
        'estado',
    ];

    public const ABIERTO = 'ABIERTO';
    public const CERRADO = 'CERRADO';
    
    static public function generarConsulta(array $filtros = [], array $ordenes = [], array $opciones = []): Builder {
        $query = parent::generarConsulta($filtros, $ordenes, $opciones);
        
        $query->select('eventos.*');
        
        $query->join('eventos_responsables',        'eventos_responsables.evento_id', '=', 'eventos.id', 'left');
        $query->join('usuarios AS usuario_creador', 'usuario_creador.id',             '=', 'eventos.usuario_creador_id');
        $query->join('usuarios',                    'usuarios.id',                    '=', 'eventos_responsables.usuario_id', 'left');
        $query->join('eventos_empresas',            'eventos_empresas.evento_id',     '=', 'eventos.id', 'left');
        $query->join('empresas',                    'empresas.id',                    '=', 'eventos_empresas.empresa_id', 'left');
        
        $query->groupBy('eventos.id');
        
        return $query;
    }

    static public function aplicarFiltros(Builder $query, array $filtros) {
        parent::aplicarFiltros($query, $filtros);
        
        foreach($filtros as $nombre => $valor) {

            if ($nombre == 'titulo') {
                $query->where('eventos.titulo', 'like', "%{$valor}%");
            }

            if ($nombre == 'tipo_evento_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                if (!empty($valor)) {
                    $query->whereIn('eventos.tipo_evento_id', $valor);
                }
            }

            if ($nombre == 'created_at_desde') {
                $query->whereDate('eventos.created_at', '>=' ,$valor);
            }

            if ($nombre == 'created_at_hasta') {
                $query->whereDate('eventos.created_at', '<=' ,$valor);
            }

            if ($nombre == 'fecha_vencimiento_desde') {
                $query->whereDate('eventos.fecha_vencimiento', '>=' ,$valor);
            }

            if ($nombre == 'fecha_vencimiento_hasta') {
                $query->whereDate('eventos.fecha_vencimiento', '<=' ,$valor);
            }

            if ($nombre == 'responsable_nombre') {
                $query->whereRaw("CONCAT(usuarios.nombre, ' ', usuarios.apellido) LIKE '%{$valor}%'");
            }
            
            if ($nombre == 'usuario_creador_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('eventos.usuario_creador_id', $valor);
            }

            if ($nombre == 'creador_nombre') {
                $query->whereRaw("CONCAT(usuario_creador.nombre, ' ', usuario_creador.apellido) LIKE '%{$valor}%'");
            }

            if ($nombre == 'oficina_id') {
                $query->where('usuarios.oficina_id', $valor);
            }

            if ($nombre == 'empresa_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('empresas.id', $valor);
            }
            
            if ($nombre == 'usuario_representante_id') {
                
                $query->selectRaw("SUM(IF(eventos_responsables.usuario_id = '{$valor}', 1, 0)) AS esta_asignado");
                $query->selectRaw("SUM(IF(empresas.usuario_comercial_id   = '{$valor}', 1, 0)) AS tiene_empresa_representada");
                
                $query->havingRaw("(
                    esta_asignado > 0 OR
                    tiene_empresa_representada > 0
                )");
            }
            
            if ($nombre == 'usuario_responsable_id') {
                $valor = is_array($valor) ? $valor : [$valor];
                $query->whereIn('usuarios.id', $valor);
            }

            if ($nombre === 'estado') {
                if ($valor !== 'todos') {
                    $query->where('eventos.estado', '=', $valor);
                }
            }
            
            if ($nombre === 'alerta_minutos') {
                 // evito usar now() ya que el servidor que usamos 
                 // tuvo varios problemas con la hora.
                $desde = date('Y-m-d H:i:00', strtotime("{$valor} minutes"));
                $hasta = date('Y-m-d H:i:59');
                $query->whereRaw("(
                    eventos.fecha_alerta_1 BETWEEN '{$desde}' AND '{$hasta}' OR
                    eventos.fecha_alerta_2 BETWEEN '{$desde}' AND '{$hasta}'
                )");
            }
        }
    }

    static public function aplicarOrdenes(Builder $query, array $ordenes) {
        foreach ($ordenes as $columna => $sentido) {
            if ($columna == 'fecha_vencimiento') {
                $query->orderBy($columna, $sentido);
            }

            if ($columna == 'created_at') {
                $query->orderBy($columna, $sentido);
            }
        }
    }

    public function tipoEvento(): BelongsTo {
        return $this->belongsTo(TipoEvento::class, 'tipo_evento_id', 'id');
    }

    public function usuarioCreador(): BelongsTo {
        return $this->belongsTo(User::class, 'usuario_creador_id', 'id');
    }

    public function usuarioCierre(): BelongsTo {
        return $this->belongsTo(User::class, 'usuario_cierre_id', 'id');
    }

    public function contactos(): BelongsToMany {
        return $this->belongsToMany(Contacto::class, 'eventos_contactos', 'evento_id', 'contacto_id');
    }

    public function ordenes(): BelongsToMany {
        return $this->belongsToMany(Orden::class, 'eventos_ordenes', 'evento_id', 'orden_id' );
    }

    public function responsables(): BelongsToMany {
        return $this->belongsToMany(User::class, 'eventos_responsables', 'evento_id', 'usuario_id');
    }

    public function empresas(): BelongsToMany {
        return $this->belongsToMany(Empresa::class, 'eventos_empresas', 'evento_id', 'empresa_id');
    }

    public function archivos(): HasMany {
        return $this->hasMany(Archivo::class,'evento_id', 'id');
    }
    
    static public function crear(CrearEventoDto $dto): self {
        DB::beginTransaction();
        
        $evento = new static;
        $evento->titulo             = $dto->titulo;
        $evento->descripcion        = $dto->descripcion;
        $evento->fecha_vencimiento  = $dto->fecha_vencimiento;
        $evento->tipo_evento_id     = $dto->tipo_evento_id;
        $evento->fecha_alerta_1     = $dto->fecha_alerta_1;
        $evento->fecha_alerta_2     = $dto->fecha_alerta_2;
        $evento->estado             = Evento::ABIERTO;
        $evento->usuario_creador_id = $dto->usuarioId;

        $evento->insertar();
        $evento->actualizarDatosRelacionados($dto);
        
        DB::commit();
        
        return $evento;
    }
    
    public function actualizar(ActualizarEventoDto $dto): self {
        DB::beginTransaction();
        
        $this->titulo            = $dto->titulo;
        $this->descripcion       = $dto->descripcion;
        $this->fecha_vencimiento = $dto->fecha_vencimiento;
        $this->tipo_evento_id    = $dto->tipo_evento_id;
        $this->fecha_alerta_1    = $dto->fecha_alerta_1;
        $this->fecha_alerta_2    = $dto->fecha_alerta_2;
        
        $this->guardar();
        $this->actualizarDatosRelacionados($dto);
        
        DB::commit();
        
        return $this;
        
    }
    
    public function actualizarDatosRelacionados(CrearEventoDto $dto) {
        $this->responsables()->sync($dto->getIds($dto->responsables));
        $this->empresas    ()->sync($dto->getIds($dto->empresas    ));
        $this->ordenes     ()->sync($dto->getIds($dto->ordenes     ));
        $this->contactos   ()->sync($dto->getIds($dto->contactos   ));
    }
    
    public function marcarCerrado($resolucion, int $usuarioCierreId): self {
        $this->estado = static::CERRADO;
        if ($resolucion !== null) {
            $this->resolucion = $resolucion;
        }
        $this->usuario_cierre_id = $usuarioCierreId; 
        $this->guardar();
        return $this;
    }
    
    public function marcarAbierto(): self {
        $this->estado = static::ABIERTO;
        $this->guardar();
        return $this;
    }
    
    public function estaCerrado(): bool {
        return $this->estado === static::CERRADO;
    }
    
    public function getResponsablesIds(): array {
        return $this->responsables->map(function($row) {
            return $row->id;
        })->toArray();
    }
    
    public function esCreadoPor(int $usuarioId): bool {
        return $this->usuarioCreador->id === $usuarioId;
    }
    
    public function tieneResponsable(int $usuarioId): bool {
        foreach($this->responsables as $responsable) {
            if ($responsable->id === $usuarioId) {
                return true;
            }
        }
        
        return false;
    }
    
    public function tieneComercialesYRepresentantesEnOficina(int $oficinaId): bool {
        if ($this->usuarioCreador->oficinaId === $oficinaId && (
            $this->usuarioCreador->esComercial() || 
            $this->usuarioCreador->esRepresentante()
        )) {
            return true;
        }
        
        foreach($this->responsables as $responsable) {
            if ($responsable->oficina_id === $oficinaId && (
                $responsable->esComercial() || 
                $responsable->esRepresentante()
            )) {
                return true;
            }
        }
        
        return false;
    }
    
    public function tieneComercialesEnOficina(int $oficinaId): bool {
        
        foreach($this->responsables as $responsable) {
            if ($responsable->oficina_id === $oficinaId && $responsable->esComercial()) {
                return true;
            }
        }
        
        return false;
    }
}
