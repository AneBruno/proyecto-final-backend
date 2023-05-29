@component('mail::message', ['unsuscribeRoute' => $unsuscribeRoute])

<p>
    El evento "{{ $titulo }}" se encuentra próximo a vencer.
</p>
<p>
    Ingrese a la plataforma para visualizar el detalle del evento mediante el siguiente <a href="{{ $link }}">link</a>
</p>

@endcomponent
