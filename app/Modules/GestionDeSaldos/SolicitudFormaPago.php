<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*namespace App\Modules\GestionDeSaldos;

use App\Tools\ModelRepository;

/**
 * Description of SolicitudFormaPago
 *
 * @author kodear
 *
class SolicitudFormaPago extends ModelRepository {
    
    const FORMA_PAGO_CHEQUE        = 'Cheque';
    const FORMA_PAGO_E_CHEQ        = 'E-cheq';
    const FORMA_PAGO_TRANSFERENCIA = 'Transferencia';

    const FORMAS_PAGO = [
    	self::FORMA_PAGO_TRANSFERENCIA,
		self::FORMA_PAGO_CHEQUE,
		self::FORMA_PAGO_E_CHEQ
	];
    
    protected $table = 'solicitudes_formas_pago';
    
    static public function agregar(int $solicitudId, string $formaPago, float $monto, string $fecha, string $cbu): self {
        $row = new static;
        $row->solicitud_id = $solicitudId;
        $row->forma_pago   = $formaPago;
        $row->monto        = $monto;
        $row->fecha        = $fecha;
        $row->cbu          = $cbu;
        $row->guardar();
        
        return $row;
    }
    
}
*/