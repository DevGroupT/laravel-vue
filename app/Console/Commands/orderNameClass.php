<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class orderNameClass extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrateorder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This method migrate tables in order';

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
        $migrations = [ 
                        '2014_10_12_000000_create_users_table.php',
                        '2014_10_12_100000_create_password_resets_table.php',
                        // '2017_12_07_122845_create_oauth_providers_table.php',
                        // '2019_08_19_000000_create_failed_jobs_table.php',
                        // '2021_08_05_004812_create_countries_table.php',
                        // '2021_08_05_030126_create_states_table.php',
                        // '2021_08_05_030818_create_cities_table.php',
                        // '2021_08_05_031502_create_departments_table.php',
                        // '2021_08_05_013658_create_employees_table.php'
        ];

        foreach($migrations as $migration)
        {
           $basePath = 'database/migrations/';          
           $migrationName = trim($migration);
           $path = $basePath.$migrationName;
           $this->call('migrate:refresh', [
            '--path' => $path ,            
           ]);
        }
    }
}