@component('mail::message', ['unsuscribeRoute' => $unsuscribeRoute])
<span>Se ha dado de alta una nueva empresa</span><br>
<br>
<span>Razon social: {{ $empresa['razon_social'] }}</span><br>
<span>CUIT: {{ $empresa['cuit'] }}</span><br>
<br>

@endcomponent
