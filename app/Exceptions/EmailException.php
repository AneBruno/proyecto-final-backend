<?php

namespace App\Exceptions;

use Exception;

class EmailException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'errors' => [
                [
                    'codigo' => 1000,
                    'title' => 'No se pudo enviar el email',
                    'detalle' => $this->getMessage(),
                    'previous' => $this->getPrevious()->getMessage()
                ]
            ]
        ], 500);
    }
}
