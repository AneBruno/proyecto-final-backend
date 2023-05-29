@component('mail::message', ['unsuscribeRoute' => $unsuscribeRoute])

<p>
    {{ $datos['usuario_creador_nombre'] }} le ha asignado una nueva tarea.
</p> 
<p>
    Ingrese a la plataforma para visualizar el detalle del evento mediante el siguiente <a href="{{ $datos['link'] }}">link</a>
</p>

@endcomponent
