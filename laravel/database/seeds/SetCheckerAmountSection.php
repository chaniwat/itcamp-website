<?php

use Illuminate\Database\Seeder;

class SetCheckerAmountSection extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $camps = [
            "head" => "2",
            "recreation" => "3",
            "camp_app" => "3",
            "camp_game" => "3",
            "camp_network" => "3",
            "camp_iot" => "3",
            "camp_datasci" => "3",
        ];

        foreach ($camps as $key => $value) {
            DB::table('sections')->where('name', $key)->update(['checker_amount' => $value]);
        }
    }
}
