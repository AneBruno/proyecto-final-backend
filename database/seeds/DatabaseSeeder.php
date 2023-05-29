<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(AccesosSeeder::class);
        $this->call(OficinasSeeder::class);
        $this->call(CategoriasClienteSeeder::class);
        $this->call(TiposProductoSeeder::class);
        $this->call(CosechasSeeder::class);
    }
}
