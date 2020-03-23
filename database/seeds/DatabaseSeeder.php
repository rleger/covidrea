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
        $this->call(SimulationSeeder::class);
        $this->call(EtablissementSeeder::class);
        $this->call(ServiceSeeder::class);
    }
}
