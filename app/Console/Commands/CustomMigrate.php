<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class CustomMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:custom';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecutar migracion con parametros mysql adicionales';

    /**
     * @var DatabaseManager
     */
    protected $db;

    /**
     * CustomMigrate constructor.
     * @param DatabaseManager $db
     */
    public function __construct(DatabaseManager $db)
    {
        parent::__construct();
        $this->db = $db;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->db->statement('SET SESSION sql_require_primary_key = OFF');

        $this->call('migrate', [
            '--force' => 'default'
        ]);

        $this->db->statement('SET SESSION sql_require_primary_key = ON');

        $this->info('The command was successful!');
    }
}
