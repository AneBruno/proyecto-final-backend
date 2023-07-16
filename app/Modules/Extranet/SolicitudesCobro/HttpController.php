<?php

/*namespace App\Modules\Extranet\SolicitudesCobro;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Modules\GestionDeSaldos\SolicitudResource;
use App\Modules\GestionDeSaldos\EstadoSolicitud;
use App\Modules\GestionDeSaldos\EstadoSolicitudResource;
use App\Modules\GestionDeSaldos\SolicitudesService;
use App\Modules\GestionDeSaldos\Requests\AgregarSolicitudRequest;
use App\Modules\Extranet\Auth\AuthService;
use Illuminate\Http\Request;

class HttpController extends Controller {
    
    public function store(AgregarSolicitudRequest $request) {
        
        $token      = $request->get('token'      );
        $cuit       = $request->get('cuit'       );
        $tipo       = $request->get('tipo'       );
        $formasPago = $request->get('formas_pago');
        $observaciones = $request->get('observaciones');
        
        $solicitud  = SolicitudesService::agregar($token, $cuit, $tipo, $formasPago, $observaciones);
        
        return $this->json($solicitud);
    }
    
    public function index(Request $request) {
        
        $token    = $request->get('token'       );
        $page   = $request->get('page'  ,  1);
        $limit    = $request->get('limit'   , 10);
        $filtros  = $request->get('filtros' , []);
        $ordenes  = $request->get('ordenes' , []);
        $opciones = $request->get('opciones', []);
        
        $rs = SolicitudesService::listarPorEmpresasAsociadasAUsuario($token, $page, $limit, $filtros, $ordenes, $opciones);
        return SolicitudResource::collection($rs);
    }

    public function show(int $id, Request $request) {
        $token = $request->get('token');

        $empresas = AuthService::obtenerEmpresasUsuario($token);

        $solicitud = SolicitudesService::getById($token, $id, [], [
            'with_relation' => ['formasPago', 'estadoSolicitud']
        ]);

        $solicitud = json_decode(json_encode ( $solicitud ) , true);

        $f = 0;
        foreach($solicitud['formas_pago'] as $formaPago) {
            foreach($empresas as $empresa) {
                foreach($empresa['Cuentas'] as $cuenta) {
                    if ($formaPago['cbu'] === $cuenta["Cbu"]) {
                        $solicitud['formas_pago'][$f]["cuenta"] = $cuenta;
                    }
                }   
            }
            $f++;
        }

        $data = [];

        $data["data"] = $solicitud;
        
        return $data;
    }

    public function cancelarEstado(int $id, Request $request) {
        $token = $request->get('token');

        try {
            AuthService::login($token);
        } catch (\Exception $e) {
            throw new BusinessException('Token invalido.');
        }

        $solicitud = SolicitudesService::getById($token, $id, [], []);

        $solicitud = SolicitudesService::cancelarEstado($solicitud);

        return new SolicitudResource($solicitud);
    }
    
    public function horarioLimiteSolicitudDisponibleDelDia() {
        return $this->json([
            'hora' => config('gestion-saldos.horario_limite_solicitud_disponible_del_dia', '13:00')
        ]);
    }
    
    public function listarEstados() {
        $rs = EstadoSolicitud::listarTodos();
        return EstadoSolicitudResource::collection($rs);
    }
}*/
