<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Need to run Section first (base of all models)
        $this->call(SectionsSeeder::class);

        $this->call(CampsSeeder::class);
        $this->call(SuperAdminSeeder::class);
    }
}
