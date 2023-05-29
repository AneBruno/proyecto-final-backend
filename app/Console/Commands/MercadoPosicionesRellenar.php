<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Modules\Mercado\Posiciones\PosicionesService;
use App\Modules\Puertos\Puerto;

class MercadoPosicionesRellenar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mercado:posiciones-rellenar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera posiciones de mercado.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->agregar( 760,  2, 5, 145,  6,  6);
        $this->agregar( 765,  2, 5, 140,  6,  6);
        $this->agregar(1425,  2, 5, 135,  6,  6);
        $this->agregar( 760,  2, 5, 146,  7,  7);
        $this->agregar( 760,  2, 5, 147,  8,  8);
        $this->agregar( 760,  2, 5, 150,  9,  9);
        $this->agregar( 760,  2, 5, 150, 10, 10);
        $this->agregar( 760,  2, 5, 150, 11, 11);
        $this->agregar( 760,  1, 5, 190,  0,  0);
        $this->agregar(1425,  6, 2, 220,  0,  0);
        $this->agregar(1425,  6, 2, 225,  0,  0);
        $this->agregar(1425,  6, 1, 230,  0,  0);
        $this->agregar(1425,  4, 1, 250,  1,  1);
        $this->agregar(1425,  4, 1, 235,  1,  1);
        $this->agregar(1425,  4, 1, 245,  0,  0);
        $this->agregar(1425,  4, 1, 225,  1,  1);
        $this->agregar(1425,  4, 1, 250,  0,  0);
        $this->agregar(1425,  4, 1, 235,  1,  1);
        $this->agregar(1425,  4, 1, 225,  1,  1);
        $this->agregar(1425, 11, 1, 145,  0,  0);
        $this->agregar( 760, 11, 1, 140,  0,  0);
        $this->agregar( 765, 11, 1, 135,  0,  0);
        $this->agregar(1510, 11, 1, 130,  0,  0);
        $this->agregar(1425, 11, 1, 150,  0,  0);
        $this->agregar(1425, 11, 1, 150, 11, 11);
        $this->agregar(1425, 11, 1, 145,  0,  0);
        $this->agregar(1425, 11, 1, 150,  0,  0);
        $this->agregar(1425, 11, 1, 150, 11, 11);
        $this->agregar(1425,  2, 3, 140,  0,  0);
        $this->agregar(1425,  2, 3, 145,  6,  6);
        $this->agregar( 765,  2, 1, 145,  9,  9);
        $this->agregar( 765,  2, 1, 145, 10, 10);
        $this->agregar( 765,  2, 1, 140,  2,  2);
        $this->agregar(1425,  4, 1, 250,  0,  0);
        $this->agregar(1425,  4, 1, 235,  1,  1);
        $this->agregar(1425,  4, 1, 245,  0,  0);
        $this->agregar(1425,  4, 1, 225,  1,  1);
        $this->agregar(1425,  4, 1, 250,  0,  0);
        $this->agregar(1425,  4, 1, 235,  1,  1);
        $this->agregar(1425,  4, 1, 225,  1,  1);
        $this->agregar(1425, 11, 1, 145,  0,  0);
        $this->agregar(1425, 11, 1, 150,  0,  0);
        $this->agregar(1425, 11, 1, 150, 11, 11);
        $this->agregar(1425, 11, 1, 145,  0,  0);
        $this->agregar(1425, 11, 1, 150,  0,  0);
        $this->agregar(1425, 11, 1, 150, 11, 11);
        $this->agregar(1425,  2, 3, 140,  0,  0);
        $this->agregar(1425,  2, 3, 145,  6,  6);
        $this->agregar(1510,  2, 5, 135,  6,  6);
        $this->agregar(1510,  2, 5, 137,  7,  7);
        $this->agregar(1510,  2, 5, 138,  8,  8);
        $this->agregar(1510,  2, 5, 138,  9,  9);
        $this->agregar(1510,  2, 5, 139, 10, 10);
        $this->agregar(1510,  2, 5, 140, 11, 11);
        $this->agregar(1510,  2, 5, 135,  2,  2);
        $this->agregar(1510,  2, 5, 135,  3,  3);
        $this->agregar(1510,  1, 5, 190,  5,  5);
        $this->agregar(1510,  1, 5, 170,  9,  9);
        $this->agregar(1510,  1, 5, 170, 10, 10);
        $this->agregar(1510,  1, 5, 172, 11, 11);
        $this->agregar(1510,  1, 5, 174, 12, 12);

        /**
         *
         * SELECT
         *      empresa_id,
         *      producto_id,
         *      calidad_id,
         *      precio,
         *      fecha_entrega_inicio,
         *      fecha_entrega_fin
         * FROM mercado_posiciones
         * WHERE producto_id IN (2,4)
         * AND calidad_id IN (1,4)
         * AND created_at IN (
         *      '2021-03-05 13:13:26',
         *      '2021-03-05 13:16:05',
         *      '2021-03-05 13:20:35',
         *      '2021-03-05 13:42:35',
         *      '2021-03-05 13:42:47',
         *      '2021-03-05 13:43:33',
         *      '2021-03-05 13:47:52',
         *      '2021-03-05 13:48:38',
         *      '2021-03-05 13:48:54',
         *      '2021-03-05 13:53:49',
         *      '2021-03-05 15:44:41',
         *      '2021-03-05 15:47:55',
         *      '2021-03-05 15:48:33',
         *      '2021-03-05 15:51:05'
         * );
         *
         * +------------+-------------+------------+--------+----------------------+-------------------+
         * | empresa_id | producto_id | calidad_id | precio | fecha_entrega_inicio | fecha_entrega_fin |
         * +------------+-------------+------------+--------+----------------------+-------------------+
         * |        760 |           4 |          4 | 215.00 | 2021-03-05           | 2021-04-14        |
         * |        760 |           4 |          4 | 210.00 | 2021-03-05           | 2021-04-14        |
         * |        760 |           4 |          4 | 235.00 | 2021-03-05           | 2021-04-14        |
         * |        760 |           4 |          4 | 245.00 | 2021-04-01           | 2021-04-02        |
         * |        761 |           4 |          4 | 245.00 | 2021-04-01           | 2021-04-02        |
         * |        761 |           4 |          4 | 260.00 | 2021-04-01           | 2021-04-02        |
         * |        760 |           4 |          4 | 260.00 | 2021-04-01           | 2021-04-02        |
         * +------------+-------------+------------+--------+----------------------+-------------------+
         *
         */

        // Como la consulta se generó en Marzo, para los fecha_entrega_inicio de mazo, se pone en 0
        $this->agregar( 760,  4, 4, 215,  0,  1);
        $this->agregar( 760,  4, 4, 210,  0,  1);
        $this->agregar( 760,  4, 4, 235,  0,  1);
        $this->agregar( 760,  4, 4, 245,  1,  1);
        $this->agregar( 761,  4, 4, 245,  1,  1);
        $this->agregar( 761,  4, 4, 260,  1,  1);
        $this->agregar( 760,  4, 4, 260,  1,  1);

        return 0;
    }

    private function agregar(int $empresaId, int $productoId, int $calidadId, int $precio, int $mesesDesde, int $mesesHasta) {
        static $puerto = null;

        if ($puerto === null) {
            $puerto = Puerto::getFirst();
        }

        $puertoId = $puerto->getKey();

        $date = new \DateTime();
        $fechaEntregaInicio = $date->add(new \DateInterval("P{$mesesDesde}M"))->format('Y-m-d');
        $fechaEntregaFin    = $date->add(new \DateInterval("P{$mesesHasta}M"))->format('Y-m-d');

        PosicionesService::crear(1,
            $productoId,
            $calidadId,
            $fechaEntregaInicio,
            $fechaEntregaFin,
            $empresaId,
            'USD',
            $precio,
            null,
            null,
            null,
            null,
            1,
            null,
            $puertoId
        );
    }
}
