<?php


namespace App\Helpers;


class DateHelper
{
    /**
     * @param string $fecha
     * @param int $dias
     * @return string
     */
     static public function sumarDias(string $fecha, int $dias): string
     {
         $nuevafecha = strtotime ( "{$dias} day" , strtotime ( $fecha ) ) ;
         return date ( 'Y-m-j' , $nuevafecha ); // fecha final con 30 dias sumados
     }
}
