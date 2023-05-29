@component('mail::message', ['unsuscribeRoute' => $unsuscribeRoute])

<p>
    {{ $solicitud->nombre_usuario }} ha creado una nueva solicitud de cobro para {{ $solicitud->razon_social }} por un total
    de ${{ number_format($solicitud->monto_total, 2, ',', '.') }}
</p>
<p>Observaciones: {{ $solicitud->observaciones ?? '-' }}</p>
<p> Ingrese a la plataforma para evaluarla</p>

@endcomponent
