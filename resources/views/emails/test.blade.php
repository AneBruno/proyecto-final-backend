@component('mail::message', ['unsuscribeRoute' => $unsuscribeRoute])
# E-mail test

<div>
    [{{ $environment }}] {{ config('app.name') }} <br>
    Enviado: {{ $datetime }}. <br>
    {{ $timezone }}
</div>

<br>

<div>
    <b>Mail Driver:</b> {{$mailer}} <br>
</div>

@endcomponent
