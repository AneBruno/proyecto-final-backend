<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CosechasSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function() {

            DB::table('mercado_cosechas')->updateOrInsert(
                [
                    'id' => 1,
                ],
                [
                    'descripcion' => '20/21',
                    'habilitado' => '1'
                ]
            );

            DB::table('mercado_cosechas')->updateOrInsert(
                [
                    'id' => 2,
                ],
                [
                    'descripcion' => '21/22',
                    'habilitado' => '1'
                ]
            );

            DB::table('mercado_cosechas')->updateOrInsert(
                [
                    'id' => 3,
                ],
                [
                    'descripcion' => '22/23',
                    'habilitado' => '1'
                ]
            );
        });
    }

}
