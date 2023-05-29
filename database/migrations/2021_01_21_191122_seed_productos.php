<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::beginTransaction();
        
        DB::table('productos')->truncate();
        DB::table('calidades')->truncate();
        
        $this->agregarCalidad('1',	'Cámara');
        $this->agregarCalidad('2',	'Fábrica');
        $this->agregarCalidad('3',	'No Bonifca G1 y Rebaja G3');
        $this->agregarCalidad('4',	'Exportación');
        $this->agregarCalidad('5',	'Camara G2 - Rechaza G3');
        $this->agregarCalidad('6',	'Camara - 100% - No Bonifica Ni Rebaja Grado');
        $this->agregarCalidad('7',	'Art. 12');
        $this->agregarCalidad('8',	'Gluten 20');
        $this->agregarCalidad('9',	'Gluten 22');
        $this->agregarCalidad('10',	'Gluten 24');
        $this->agregarCalidad('11',	'Gluten 26');
        $this->agregarCalidad('12',	'Gluten 28');
        $this->agregarCalidad('13',	'Gluten 30');
        $this->agregarCalidad('14',	'Gluten 32');
        $this->agregarCalidad('15',	'Gluten 28 - FN 280');
        $this->agregarCalidad('16',	'Gluten 30 - FN 300');
        $this->agregarCalidad('17',	'Gluten 32 - FN 320');
        $this->agregarCalidad('18',	'Camara - 1 Punto Libre');
        $this->agregarCalidad('19',	'Camara - 2 Puntos Libres');
        $this->agregarCalidad('20',	'Camara - 3 Puntos Libres');
        $this->agregarCalidad('21',	'Camara - 4 Puntos Libres');
        $this->agregarCalidad('22',	'Camara - 5 Puntos Libres');
        $this->agregarCalidad('23',	'Camara - 6 Puntos Libres');
        
        $this->agregarProducto('TRIGO', '1', 'Toneladas', 'Si');
        $this->agregarProducto('MAIZ', '1', 'Toneladas', 'Si ');
        $this->agregarProducto('LINO', '1', 'Toneladas', 'No');
        $this->agregarProducto('GIRASOL', '1', 'Toneladas', 'Si');
        $this->agregarProducto('SORGO', '1', 'Toneladas', 'Si');
        $this->agregarProducto('SOJA', '1', 'Toneladas', 'Si');
        $this->agregarProducto('AVENA', '1', 'Toneladas', 'No');
        $this->agregarProducto('ALPISTE', '1', 'Toneladas', 'No');
        $this->agregarProducto('MIJO', '1', 'Toneladas', 'No');
        $this->agregarProducto('CENTENO', '1', 'Toneladas', 'No');
        $this->agregarProducto('CEBADA FORRAJERA', '1', 'Toneladas', 'Si');
        $this->agregarProducto('TRIGO CANDEAL', '1', 'Toneladas', 'No');
        $this->agregarProducto('COLZA', '1', 'Toneladas', 'No');
        $this->agregarProducto('MANI', '1', 'Toneladas', 'No');
        $this->agregarProducto('ITA', '1', 'Toneladas', 'No');
        $this->agregarProducto('SORGO FORRAJERO', '1', 'Toneladas', 'No');
        $this->agregarProducto('PELLETS DE SOJA', '1', 'Toneladas', 'No');
        $this->agregarProducto('TRIGO SARRACENO', '1', 'Toneladas', 'No');
        $this->agregarProducto('SOJA SUSTENTABLE', '1', 'Toneladas', 'No');
        $this->agregarProducto('AGROPIRO ALARGADO', '1', 'Toneladas', 'No');
        $this->agregarProducto('ALFALFA', '1', 'Toneladas', 'No');
        $this->agregarProducto('FESTUCA ALTA', '1', 'Toneladas', 'No');
        $this->agregarProducto('SOJA FABRICA', '1', 'Toneladas', 'No');
        $this->agregarProducto('SOJA FABRICA ENTREGA', '1', 'Toneladas', 'No');
        $this->agregarProducto('SEMILLA DE AVENA', '1', 'Toneladas', 'No');
        $this->agregarProducto('SEMILLA DE TRIGO', '1', 'Toneladas', 'No');
        $this->agregarProducto('SEMILLA DE MAIZ', '1', 'Toneladas', 'No');
        $this->agregarProducto('SEMILLA DE SOJA', '1', 'Toneladas', 'No');
        $this->agregarProducto('SEMILLA DE GIRASOL', '1', 'Toneladas', 'No');
        $this->agregarProducto('SEMILLA NATURAL GIRASOL', '1', 'Toneladas', 'No');
        $this->agregarProducto('SEMILLA MACHO GIRASOL', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ DENTADO', '1', 'Toneladas', 'No');
        $this->agregarProducto('PELLETS DE GIRASOL', '1', 'Toneladas', 'No');
        $this->agregarProducto('PELLETS DE AFRECHILLO', '1', 'Toneladas', 'No');
        $this->agregarProducto('MOHA CARAPE', '1', 'Toneladas', 'No');
        $this->agregarProducto('CEBADA CERVECERA', '1', 'Toneladas', 'Si');
        $this->agregarProducto('COLZA DOBLE "00"/ CANOLA', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ BLANCO', '1', 'Toneladas', 'No');
        $this->agregarProducto('MANI CAJA', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ ESPECIAL', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ FLAMENCO', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ PISCINGALLO', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ DURO COLORADO', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ CARGILL 280', '1', 'Toneladas', 'No');
        $this->agregarProducto('ARROZ', '1', 'Toneladas', 'No');
        $this->agregarProducto('MANI INDUSTRIA', '1', 'Toneladas', 'No');
        $this->agregarProducto('SOJA CHICAGO', '1', 'Toneladas', 'No');
        $this->agregarProducto('TRIGO CHICAGO', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ CHICAGO', '1', 'Toneladas', 'No');
        $this->agregarProducto('SEMILLA DE CEBADA SCARLETT', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ PARTIDO', '1', 'Toneladas', 'No');
        $this->agregarProducto('SOJA MINI', '1', 'Toneladas', 'No');
        $this->agregarProducto('TRIGO MINI', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ MINI', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ PARTIDO', '1', 'Toneladas', 'No');
        $this->agregarProducto('CUARTA DE CEBADA', '1', 'Toneladas', 'No');
        $this->agregarProducto('MINI TRIGO', '1', 'Toneladas', 'No');
        $this->agregarProducto('CT ALGODON', '1', 'Toneladas', 'No');
        $this->agregarProducto('MAIZ FLINT', '1', 'Toneladas', 'No');
        $this->agregarProducto('GARBANZO', '1', 'Toneladas', 'No');
        $this->agregarProducto('POROTO MUNG', '1', 'Toneladas', 'No');
        $this->agregarProducto('ARVEJA VERDE', '1', 'Toneladas', 'No');
        $this->agregarProducto('EXPELLER', '1', 'Toneladas', 'No');
        $this->agregarProducto('FOSFATO DIAMONICO', '2', 'Toneladas', 'No');
        $this->agregarProducto('FOSFATO MONOAMONICO', '2', 'Toneladas', 'No');
        $this->agregarProducto('GLIFOSATO', '2', 'Toneladas', 'No');
        $this->agregarProducto('UREA GRANULADA', '2', 'Toneladas', 'No');
        $this->agregarProducto('UREA PERLADA', '2', 'Toneladas', 'No');
        $this->agregarProducto('GLIFOSATO ATANOR', '2', 'Toneladas', 'No');
        $this->agregarProducto('2.4 D', '2', 'Toneladas', 'No');
        $this->agregarProducto('SUPER FOSFATO TRIPLE', '2', 'Toneladas', 'No');
        $this->agregarProducto('SUPER FOSFATO SIMPLE', '2', 'Toneladas', 'No');
        $this->agregarProducto('PANZER GOLD', '2', 'Toneladas', 'No');
        $this->agregarProducto('MEZCLA FISICA 7-40', '2', 'Toneladas', 'No');
        $this->agregarProducto('ACEITE DE SOJA', '3', 'Toneladas', 'No');
        $this->agregarProducto('HARINA SOJA', '4', 'Toneladas', 'No');
        $this->agregarProducto('HARINA DE SOJA HIPRO', '4', 'Toneladas', 'No');
        $this->agregarProducto('DOLAR', '5', 'Unidades', 'No');
        $this->agregarProducto('DOLAR-MAT', '5', 'Unidades', 'No');
        $this->agregarProducto('VARIOS', '5', 'Unidades', 'No');
        $this->agregarProducto('GANADO', '6', 'Unidades', 'No');
        $this->agregarProducto('GIRASOL ALTO OLEICO', '1', 'Toneladas', 'Si');
        $this->agregarProducto('VIENTRES', '6', 'Unidades', 'No');
        $this->agregarProducto('INVERNADA', '6', 'Unidades', 'No');
        $this->agregarProducto('GORDO', '6', 'Unidades', 'No');
        
        DB::commit();
    }
    
    public function agregarProducto($nombre, $tipo_producto_id, $unidad, $uso_frecuente) {
        DB::table('productos')->insert([[
            'nombre'           => $nombre,
            'tipo_producto_id' => $tipo_producto_id,
            'unidad'           => strtoupper(($unidad)),
            'uso_frecuente'    => $uso_frecuente === 'Si' ? 1 : 0
        ]]);
    }
    
    public function agregarCalidad($id, $nombre) {
        DB::table('calidades')->insert([[
            'id'     => $id,
            'nombre' => $nombre,
            'orden'  => $id,
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
