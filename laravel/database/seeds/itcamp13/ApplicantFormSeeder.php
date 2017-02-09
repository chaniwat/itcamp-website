<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicantFormSeeder extends Seeder
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
                'description' => 'prefix name',
                'field_type' => 'SELECT',
                'field_value' => /** @lang JSON */
                    '{"lists":[{"key": "mr", "text":"นาย"},{"key": "mrs", "text":"นางสาว"},{"key": "other", "text":"อื่นๆ"}]}'
            ],
            [
                'id' => 'p_name_other',
                'description' => 'prefix name (other option)',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'f_name',
                'description' => 'first name',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'l_name',
                'description' => 'last name',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'nickname',
                'description' => 'nickname',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'birthday',
                'description' => 'birthday',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'sex',
                'description' => 'sex',
                'field_type' => 'SELECT',
                'field_value' => /** @lang JSON */
                    '{"lists":[{"key": "male", "text":"ชาย"},{"key": "female", "text":"หญิง"}]}'
            ],
            [
                'id' => 'religion',
                'description' => 'religion',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'citizen_numid',
                'description' => 'citizen number id',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's Address

            /**
             * Applicant's Address
             */
            [
                'id' => 'address_homenum',
                'description' => 'address home number',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_moo',
                'description' => 'address moo',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_road',
                'description' => 'address road',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_tumbon',
                'description' => 'address tumbon',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_amphure',
                'description' => 'address amphure',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_province',
                'description' => 'address province',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_zipcode',
                'description' => 'address zipcode',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's Contact

            /**
             * Applicant's Contact
             */
            [
                'id' => 'facebook_url',
                'description' => 'facebook url',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'phone',
                'description' => 'phone',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'email',
                'description' => 'email',
                'field_type' => 'EMAIL',
                'field_value' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's Study Profile

            /**
             * Applicant's Study Profile
             */
            [
                'id' => 'study_current_grade',
                'description' => 'current grade',
                'field_type' => 'SELECT',
                'field_value' => /** @lang JSON */
                    '{"lists":[{"key": "10", "text":"ม.4"},{"key": "11", "text":"ม.5"},{"key": "12", "text":"ม.6"},{"key": "other", "text":"อื่นๆ"}]}'
            ],
            [
                'id' => 'study_plan',
                'description' => 'current plan',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'study_school',
                'description' => 'current school',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'study_school_province',
                'description' => 'current school province',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's Guardian Profile

            /**
             * Applicant's Guardian Profile
             */
            [
                'id' => 'guardian_f_name',
                'description' => 'guardian first name',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_l_name',
                'description' => 'guardian last name',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_connection',
                'description' => 'guardian connection to applicant',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_homenum',
                'description' => 'guardian address homenum',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_moo',
                'description' => 'guardian address moo',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_road',
                'description' => 'guardian address road',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_tumbon',
                'description' => 'guardian address tumbon',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_amphure',
                'description' => 'guardian address amphure',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_province',
                'description' => 'guardian address province',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_zipcode',
                'description' => 'guardian address zipcode',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_phone_1',
                'description' => 'guardian phone number 1',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_phone_2',
                'description' => 'guardian phone number 2',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's Interest

            /**
             * Applicant's Interest
             */
            [
                'id' => 'interest_faculty_1',
                'description' => 'interest faculty 1',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'interest_university_1',
                'description' => 'interest university 1',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'interest_faculty_2',
                'description' => 'interest faculty 2',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'interest_university_2',
                'description' => 'interest university 2',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'interest_faculty_3',
                'description' => 'interest faculty 3',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'interest_university_3',
                'description' => 'interest university 3',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's past camps

            /**
             * Applicant's past camps
             */
            [
                'id' => 'camp_name_1',
                'description' => 'past camp name 1',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'camp_by_1',
                'description' => 'past camp by 1',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'camp_name_2',
                'description' => 'past camp name 2',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'camp_by_2',
                'description' => 'past camp by 2',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'camp_name_3',
                'description' => 'past camp name 3',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'camp_by_3',
                'description' => 'past camp by 3',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's information

            /**
             * Additional applicant's information
             */
            [
                'id' => 'a_foodallergy',
                'description' => 'food allergy',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'a_congenitaldisease',
                'description' => 'congenital disease',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'a_knowitcampfrom',
                'description' => 'know it camp from',
                'field_type' => 'CHECKBOX',
                'field_value' => /** @lang JSON */
                    '{"lists":[{"key": "fb", "text":"Facebook"},{"key": "twit", "text":"Twitter"},{"key": "friend", "text":"เพื่อนแนะนำ"},{"key": "other", "text":"อื่นๆ"}]}'
            ],
            [
                'id' => 'a_knowitcampfrom_other',
                'description' => 'know it camp from (other option)',
                'field_type' => 'TEXT',
                'field_value' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'a_shirtsize',
                'description' => 'shirt size',
                'field_type' => 'RADIO',
                'field_value' => /** @lang JSON */
                    '{"lists":[{"key": "s", "text":"S"},{"key": "m", "text":"M"},{"key": "l", "text":"L"},{"key": "xl", "text":"XL"},{"key": "xxl", "text":"XXL"}]}'
            ],

            #endregion

        ]);
    }
}
