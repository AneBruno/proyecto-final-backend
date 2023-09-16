@component('mail::message')
Hola {{ $nombre }}!

Tu cuenta ha sido habilitada. Ya puedes operar en la <a href="{{ url('http://localhost:4200/login') }}">plataforma</a>.

@endcomponent
