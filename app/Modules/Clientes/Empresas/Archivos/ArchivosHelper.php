<?php

namespace App\Modules\Clientes\Empresas\Archivos;

class ArchivosHelper
{
    public const CONSTACIA_AFIP = 1;

    public const CONSTANCIA_IIBB = 2;

    public const CM05 = 3;

    public const CERTIFICADO_EXCLUSION = 4;

    public const DATOS_BANCARIOS = 5;

    public const ARCHIVOS = [
        self::CONSTACIA_AFIP,
        self::CONSTANCIA_IIBB,
        self::CM05,
        self::CERTIFICADO_EXCLUSION,
        self::DATOS_BANCARIOS
    ];
}
