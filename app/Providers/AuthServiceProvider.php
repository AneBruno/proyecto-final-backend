<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        \App\Modules\Clientes\Empresas\Archivos\Archivo::class
                => \App\Modules\Clientes\Empresas\Archivos\Policies\ArchivoPolicy::class,

        \App\Modules\Clientes\Empresas\Empresa::class
                => \App\Modules\Clientes\Empresas\EmpresaPolicy::class,

        \App\Modules\Clientes\Contactos\Contacto::class
                => \App\Modules\Clientes\Contactos\ContactoPolicy::class,

        \App\Modules\Mercado\CondicionesPago\CondicionPago::class
                => \App\Modules\Mercado\CondicionesPago\CondicionPagoPolicy::class,

        \App\Modules\Mercado\Cosechas\Cosecha::class
        => \App\Modules\Mercado\Cosechas\CosechaPolicy::class,

        \App\Modules\Mercado\Posiciones\Posicion::class
        => \App\Modules\Mercado\Posiciones\PosicionesPolicy::class,

        \App\Modules\Mercado\Ordenes\Orden::class
        => \App\Modules\Mercado\Ordenes\OrdenPolicy::class,

        \App\Modules\Clientes\TiposEvento\TipoEvento::class
        => \App\Modules\Clientes\TiposEvento\TipoEventoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::personalAccessTokensExpireIn(now()->addDay());
    }
}
