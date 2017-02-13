<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Migration\Helper\MigrationHelper;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('super@1234'),
            'type' => 'STAFF',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('staff')->insert([
            'name' => 'The_Super_Admin',
            'user_id' => 1,
            'section_id' => MigrationHelper::findSectionByName('web_developer'),
            'is_head' => True,
            'is_admin' => True
        ]);
    }
}
