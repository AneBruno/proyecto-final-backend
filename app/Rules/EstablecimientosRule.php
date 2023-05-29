<?php

namespace App\Rules;

use App\Modules\Clientes\Establecimientos\Establecimiento;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Collection;

class EstablecimientosRule implements Rule
{
    protected string $message;

    public function passes($attribute, $value)
    {
        /** @var Collection $establecimientos */
        $establecimientos = Establecimiento::all('id');

        $passes = true;
        for ($i = 0; $i < count($value); $i++) {
            $id = (int) $value[$i];

            $establecimiento = $establecimientos->first(function (Establecimiento $establecimiento) use ($id) {
                return $establecimiento->getKey() === $id;
            });

            if ($establecimiento === null) {
                $passes = false;
                $this->message = 'El establecimiento ' . $id . ' no existe';
                break;
            }
        }

        return $passes;
    }

    public function message()
    {
        return $this->message;
    }
}
