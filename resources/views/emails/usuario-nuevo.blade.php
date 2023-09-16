@component('mail::message')

<p> Se registró el usuario <b>{{ $nombre }}</b>.</p>
<br>

<p>Ingrese a la <a href="{{ url('http://localhost:4200/login') }}">plataforma</a> para verificar su información y habilitarlo para operar.<p>

@endcomponent
