<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            ['name' => 'null', 'has_question' => false, 'is_camp' => false],
            ['name' => 'head', 'has_question' => true, 'is_camp' => false],
            ['name' => 'recreation', 'has_question' => true, 'is_camp' => false],
            ['name' => 'knowledge', 'has_question' => false, 'is_camp' => false],
            ['name' => 'camp_app', 'has_question' => true, 'is_camp' => true],
            ['name' => 'camp_game', 'has_question' => true, 'is_camp' => true],
            ['name' => 'camp_network', 'has_question' => true, 'is_camp' => true],
            ['name' => 'camp_iot', 'has_question' => true, 'is_camp' => true],
            ['name' => 'camp_datasci', 'has_question' => true, 'is_camp' => true],
            ['name' => 'register', 'has_question' => false, 'is_camp' => false],
            ['name' => 'web_developer', 'has_question' => false, 'is_camp' => false],
        ]);
    }
}
