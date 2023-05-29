@component('mail::message', ['unsuscribeRoute' => $unsuscribeRoute])

<p>
    El evento "{{ $titulo }}" fue resuelto por {{ $usuario_cierre_nombre }}.
</p>

<p>
    Resolución: {!! $resolucion !!}
</p>

<p>
    Ingrese a la plataforma para visualizar el detalle del evento mediante el siguiente <a href="{{ $link }}">link</a>
</p>

@endcomponent
