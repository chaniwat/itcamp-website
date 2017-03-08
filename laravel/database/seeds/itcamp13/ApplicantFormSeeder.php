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

            #region Applicant's Address

            /**
             * Applicant's Address
             */
            [
                'id' => 'address_homenum',
                'priority' => '950',
                'question' => 'บ้านเลขที่',
                'description' => 'address home number',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_moo',
                'priority' => '949',
                'question' => 'หมู่',
                'description' => 'address moo',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_road',
                'priority' => '948',
                'question' => 'ถนน',
                'description' => 'address road',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_tumbon',
                'priority' => '947',
                'question' => 'ตำบล',
                'description' => 'address tumbon',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_amphure',
                'priority' => '946',
                'question' => 'อำเภอ',
                'description' => 'address amphure',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_province',
                'priority' => '945',
                'question' => 'จังหวัด',
                'description' => 'address province',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'address_zipcode',
                'priority' => '944',
                'question' => 'รหัสไปรณีย์',
                'description' => 'address zipcode',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's Contact

            /**
             * Applicant's Contact
             */
            [
                'id' => 'facebook_url',
                'priority' => '920',
                'question' => 'Facebook URL',
                'description' => 'facebook url',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'phone',
                'priority' => '919',
                'question' => 'เบอร์โทรศัพท์',
                'description' => 'phone',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'email',
                'priority' => '918',
                'question' => 'Email',
                'description' => 'email',
                'field_type' => 'EMAIL',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's Study Profile

            /**
             * Applicant's Study Profile
             */
            [
                'id' => 'study_current_grade',
                'priority' => '850',
                'question' => 'ระดับชั้น',
                'description' => 'current grade',
                'field_type' => 'SELECT',
                'field_setting' => /** @lang JSON */
                    '{"lists":[{"key": "10", "text":"ม.4"},{"key": "11", "text":"ม.5"},{"key": "12", "text":"ม.6"},{"key": "21", "text":"ปวช."},{"key": "other", "text":"อื่นๆ"}]}'
            ],
            [
                'id' => 'study_plan',
                'priority' => '849',
                'question' => 'แผนการเรียน',
                'description' => 'current plan',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'study_school',
                'priority' => '848',
                'question' => 'โรงเรียน',
                'description' => 'current school',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'study_school_province',
                'priority' => '847',
                'question' => 'จังหวัด',
                'description' => 'current school province',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's Guardian Profile

            /**
             * Applicant's Guardian Profile
             */
            [
                'id' => 'guardian_f_name',
                'priority' => '800',
                'question' => 'ชื่อจริงผู้ปกครอง',
                'description' => 'guardian first name',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_l_name',
                'priority' => '799',
                'question' => 'นามสกุลผู้ปกครอง',
                'description' => 'guardian last name',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_connection',
                'priority' => '798',
                'question' => 'เกี่ยวข้่องกันเป็น',
                'description' => 'guardian connection to applicant',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_homenum',
                'priority' => '797',
                'question' => 'บ้านเลขที่',
                'description' => 'guardian address homenum',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_moo',
                'priority' => '796',
                'question' => 'หมู่',
                'description' => 'guardian address moo',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_road',
                'priority' => '795',
                'question' => 'ถนน',
                'description' => 'guardian address road',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_tumbon',
                'priority' => '794',
                'question' => 'ตำบล',
                'description' => 'guardian address tumbon',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_amphure',
                'priority' => '793',
                'question' => 'อำเภอ',
                'description' => 'guardian address amphure',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_province',
                'priority' => '792',
                'question' => 'จังหวัด',
                'description' => 'guardian address province',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_address_zipcode',
                'priority' => '791',
                'question' => 'รหัสไปรษณีย์',
                'description' => 'guardian address zipcode',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_phone_1',
                'priority' => '790',
                'question' => 'เบอร์โทรศัพท์',
                'description' => 'guardian phone number 1',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'guardian_phone_2',
                'priority' => '789',
                'question' => 'เบอร์โทรศัพท์ (เพิ่มเติม)',
                'description' => 'guardian phone number 2',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's Interest

            /**
             * Applicant's Interest
             */
            [
                'id' => 'interest_faculty_1',
                'priority' => '750',
                'question' => 'คณะที่สนใจลำดับที่ 1',
                'description' => 'interest faculty 1',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'interest_university_1',
                'priority' => '749',
                'question' => 'สถาบัน/มหาลัย',
                'description' => 'interest university 1',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'interest_faculty_2',
                'priority' => '748',
                'question' => 'คณะที่สนใจลำดับที่ 2',
                'description' => 'interest faculty 2',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'interest_university_2',
                'priority' => '747',
                'question' => 'สถาบัน/มหาลัย',
                'description' => 'interest university 2',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'interest_faculty_3',
                'priority' => '746',
                'question' => 'คณะที่สนใจลำดับที่ 3',
                'description' => 'interest faculty 3',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'interest_university_3',
                'priority' => '745',
                'question' => 'สถาบัน/มหาลัย',
                'description' => 'interest university 3',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's past camps

            /**
             * Applicant's past camps
             */
            [
                'id' => 'camp_name_1',
                'priority' => '730',
                'question' => 'ค่ายที่เคยเข้า',
                'description' => 'past camp name 1',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'camp_by_1',
                'priority' => '729',
                'question' => 'จัดโดย',
                'description' => 'past camp by 1',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'camp_name_2',
                'priority' => '728',
                'question' => 'ค่ายที่เคยเข้า',
                'description' => 'past camp name 2',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'camp_by_2',
                'priority' => '727',
                'question' => 'จัดโดย',
                'description' => 'past camp by 2',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'camp_name_3',
                'priority' => '726',
                'question' => 'ค่ายที่เคยเข้า',
                'description' => 'past camp name 3',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'camp_by_3',
                'priority' => '725',
                'question' => 'จัดโดย',
                'description' => 'past camp by 3',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],

            #endregion

            #region Applicant's information

            /**
             * Additional applicant's information
             */
            [
                'id' => 'a_foodallergy',
                'priority' => '680',
                'question' => 'อาหารที่แพ้',
                'description' => 'food allergy',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'a_congenitaldisease',
                'priority' => '679',
                'question' => 'โรคประจำตัว',
                'description' => 'congenital disease',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'a_knowitcampfrom',
                'priority' => '678',
                'question' => 'ได้รับข่าวสารจาก',
                'description' => 'know it camp from',
                'field_type' => 'CHECKBOX',
                'field_setting' => /** @lang JSON */
                    '{"lists":[{"key": "fb", "text":"Facebook"},{"key": "twitter", "text":"Twitter"},{"key": "friend", "text":"เพื่อนแนะนำ"},{"key": "other", "text":"อื่นๆ"}]}'
            ],
            [
                'id' => 'a_knowitcampfrom_other',
                'priority' => '678',
                'question' => 'ได้รับข่าวสารจาก (อื่นๆ)',
                'description' => 'know it camp from (other option)',
                'field_type' => 'TEXT',
                'field_setting' => /** @lang JSON */
                    '{}'
            ],
            [
                'id' => 'a_shirtsize',
                'priority' => '677',
                'question' => 'ขนาดไซว์เสื้อ',
                'description' => 'shirt size',
                'field_type' => 'RADIO',
                'field_setting' => /** @lang JSON */
                    '{"lists":[{"key": "s", "text":"S"},{"key": "m", "text":"M"},{"key": "l", "text":"L"},{"key": "xl", "text":"XL"},{"key": "xxl", "text":"XXL"}]}'
            ],
            [
                'id' => 'a_confirmcurrentgrade',
                'priority' => '676',
                'question' => 'เอกสาร ปพ.1',
                'description' => 'ปพ.1',
                'field_type' => 'FILE',
                'field_setting' => /** @lang JSON */
                    '{"directory": "applicant/c_grade","acceptTypes": "picture"}'
            ],

            #endregion

        ]);

        // TODO foreign row other (2 fields)
    }
}
