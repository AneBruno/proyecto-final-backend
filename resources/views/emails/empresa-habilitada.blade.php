@component('mail::message', ['unsuscribeRoute' => $unsuscribeRoute])
<p>Bienvenido a Negocios de Granos</p>
<p>La empresa {{ $empresa['razon_social'] }}  se encuentra activa para operar con Negocio de granos.</p>
<p>Lo invitamos a llenar el siguiente <a href="/nocontent">formulario</a> para completar los datos de su empresa.</p>

<p>Saludos</p>

@endcomponent
