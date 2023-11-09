@component('mail::message')
<p>Estimado {{$razon_social}},
<p>Se cerró con éxito un negocio para su posición de compra del día de hoy.</p>
<br>
<p><b> Resumen de la transacción:</b></p>
<p> Fecha de cierre: {{$fecha_cierre}}</p>
<p> Comprador: {{$razon_social}}</p>
<p> Vendedor: {{$razon_social_vendedor}}</p>
<p> Producto: {{$producto}}</p>
<p> Puerto de destino: {{$puerto}}</p>
<p> Forma de pago: {{$forma_pago}}</p>
<p> Precio por tonelada: {{$moneda}} {{$precio_cierre}}</p>
<p> Toneladas: {{$toneladas_cierre}}</p>
<p><b> Total a pagar: {{$moneda}} {{$precio_total}} + Comisión ({{$comision_porcentaje}}%): {{$moneda}} {{$comision}}</b></p>



@endcomponent
