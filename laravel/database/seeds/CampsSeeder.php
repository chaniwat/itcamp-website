<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Migration\Helper\MigrationHelper;

class CampsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('camps')->insert([
            ['name' => 'camp_app', 'section_id' => MigrationHelper::findSectionByName('camp_app')],
            ['name' => 'camp_game', 'section_id' => MigrationHelper::findSectionByName('camp_game')],
            ['name' => 'camp_network', 'section_id' => MigrationHelper::findSectionByName('camp_network')],
            ['name' => 'camp_iot', 'section_id' => MigrationHelper::findSectionByName('camp_iot')],
            ['name' => 'camp_datasci', 'section_id' => MigrationHelper::findSectionByName('camp_datasci')],
        ]);
    }
}
