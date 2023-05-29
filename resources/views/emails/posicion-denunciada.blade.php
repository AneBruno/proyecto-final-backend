@component('mail::message', ['unsuscribeRoute' => $unsuscribeRoute])
    <p>Tu posición de {{$producto}} | {{$calidad}} | {{$entrega}} | {{$destino}} | {{$moneda}} {{$precio}}
    ha sido denunciada por {{$usuarioDenunciante}}.</p>
    <p>Para revisarla ingresa al siguiente <a href="{{$link}}">link</a>.</p>
@endcomponent
