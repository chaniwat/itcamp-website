<?php

use Illuminate\Database\Seeder;

class ApplicantCriticalDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applicant_detail_keys')->insert([

            #region Applicant's Profile

            /**
             * Applicant's Profiles
             */
            [
                'id' => 'p_name',
                'priority' => '1000',
                'question' => 'คำนำหน้า',
                'description' => 'prefix name',
                'field_type' => 'SELECT',
                'field_setting' => /** @lang JSON */
                    '{"lists":[{"key": "mr", "text":"นาย"},{"key": "mrs", "text":"นางสาว"},{"key": "other", "text":"อื่นๆ"}]}'
            ],
            [
                'id' => 'p_name_other',
                'priority' => '1000',
                'question' => 'คำนำหน้า (อื่นๆ)',
                'description' => 'prefix name (other option)',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'f_name',
                'priority' => '998',
                'question' => 'ชื่อจริง',
                'description' => 'first name',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'l_name',
                'priority' => '997',
                'question' => 'นามสกุล',
                'description' => 'last name',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'nickname',
                'priority' => '996',
                'question' => 'ชื่อเล่น',
                'description' => 'nickname',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'birthday',
                'priority' => '995',
                'question' => 'วันเกิด',
                'description' => 'birthday',
                'field_type' => 'DATE',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'sex',
                'priority' => '994',
                'question' => 'เพศ',
                'description' => 'sex',
                'field_type' => 'SELECT',
                'field_setting' => /** @lang JSON */
                    '{"lists":[{"key": "male", "text":"ชาย"},{"key": "female", "text":"หญิง"}]}'
            ],
            [
                'id' => 'religion',
                'priority' => '993',
                'question' => 'ศาสนา',
                'description' => 'religion',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'citizen_numid',
                'priority' => '992',
                'question' => 'บัตรประชาชน',
                'description' => 'citizen number id',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],

            #endregion

        ]);
    }
}
