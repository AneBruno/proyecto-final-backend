<?php

namespace App\Modules\Afip;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\App;

class CuitRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (App::environment() === 'local') {
            return true;
        }
        
        $cuit = preg_replace('/[^\d]/', '', (string) $value);
        $cuit_tipos = [20, 23, 24, 27, 30, 33, 34];

        if (strlen($cuit) != 11) {
            return false;
        }

        $tipo = (int) substr($cuit, 0, 2);

        if (!in_array($tipo, $cuit_tipos, TRUE)) {
            return false;
        }

        $acumulado = 0;
        $digitos = str_split($cuit); // Convertir en un array
        $digito = array_pop($digitos); // Extraer último elemento del array
        $contador = count($digitos);

        for ($i = 0; $i < $contador; $i++) {
            $acumulado += $digitos[ 9 - $i ] * (2 + ($i % 6));
        }

        $verif = 11 - ($acumulado % 11);

        // Si el resultado es 11, el dígito verificador será 0
        // Sino, será el dígito verificador
        $verif = $verif == 11 ? 0 : $verif;

        return $digito == $verif;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El cuit es inválido.';
    }
}
