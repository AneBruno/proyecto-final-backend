<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Modules\Clientes\Empresas\Empresa;

class NegocioCerradoVendedor extends Mailable
{
    use Queueable, SerializesModels;
    protected $comprador, 
    $producto,    
    $forma_pago, 
    $puerto, 
    $observaciones, 
    $fecha_cierre, 
    $vendedor ,
    $moneda,
    $precio_cierre,
    $toneladas_cierre,
    $precio_total,
    $comision_vendedor_porcentaje,
    $comision_vendedor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        string $fecha_cierre,
        Empresa $comprador, 
        Empresa $vendedor,
        string $producto, 
        string $forma_pago, 
        string $puerto, 
        string $moneda,
        float $precio_cierre,
        int $toneladas_cierre,
        float $precio_total,
        float $comision_vendedor_porcentaje,
        float $comision_vendedor
        )
    {
        $this->subject = 'Negocio cerrado con éxito';
        $this->comprador                     = $comprador;
        $this->vendedor                      = $vendedor;
        $this->fecha_cierre                  = $fecha_cierre;
        $this->producto                      = $producto;
        $this->forma_pago                    = $forma_pago;
        $this->puerto                        = $puerto;
        $this->moneda                        = $moneda;
        $this->precio_cierre                 = $precio_cierre;
        $this->toneladas_cierre              = $toneladas_cierre;
        $this->precio_total                  = $precio_total;
        $this->comision_vendedor_porcentaje  = $comision_vendedor_porcentaje;
        $this->comision_vendedor             = $comision_vendedor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.negocio-cerrado-vendedor', [
            'fecha_cierre'          => $this->fecha_cierre,
            'razon_social'          => $this->comprador->razon_social,
            'razon_social_vendedor' =>$this->vendedor->razon_social,
            'producto'              => $this->producto,
            'forma_pago'            => $this->forma_pago,
            'puerto'                =>$this->puerto,
            'moneda'                =>$this->moneda,
            'precio_cierre'         =>$this->precio_cierre,
            'toneladas_cierre'      => $this->toneladas_cierre,
            'precio_total'          => $this->precio_total,
            'comision'              =>$this->comision_vendedor,
            'comision_porcentaje'   =>$this->comision_vendedor_porcentaje
        ]);
    }
}
