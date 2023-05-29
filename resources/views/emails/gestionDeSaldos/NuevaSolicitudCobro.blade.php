@component('mail::message', ['unsuscribeRoute' => $unsuscribeRoute])

<p> {{ $nombre_usuario }} ha creado una nueva solicitud de cobro para {{ $razon_social }}</p>
<p> Ingrese a la plataforma para evaluarla</p>

@endcomponent
