<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Modules\Clientes\Empresas\Empresa;
use App\Modules\Mercado\CondicionesPago\CondicionPago;
use App\Modules\Productos\Productos\Producto;
use App\Modules\Puertos\Puerto;

class NegocioCerradoMail extends Mailable
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
              $comision_comprador_porcentaje,
              $comision_comprador;

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
        float $comision_comprador_porcentaje,
        float $comision_comprador
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
        $this->comision_comprador_porcentaje = $comision_comprador_porcentaje;
        $this->comision_comprador            = $comision_comprador;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.negocio-cerrado-comprador', [
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
            'comision'              =>$this->comision_comprador,
            'comision_porcentaje'   =>$this->comision_comprador_porcentaje

        ]);
    }
}
