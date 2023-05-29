@component('mail::message', ['unsuscribeRoute' => $unsuscribeRoute])
    <p>{{ $usuario_solicitante }} ha creado una nueva solicitud de CBU para {{ $razon_social }}</p>
    <p>Ingrese a la plataforma para evaluarla</p>
@endcomponent
