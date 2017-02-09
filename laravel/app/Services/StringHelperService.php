<?php

namespace App\Services;

class StringHelperService
{

    public function convertApplicantDetailKeyToName($s) {
        switch ($s) {
            case "a_congenitaldisease": return "โรคประจำตัว แพ้ยา";
            case "a_foodallergy": return "อาหาร สิ่งที่แพ้ (รวมมังสวิรัติและเจ)";
            case "a_knowitcampfrom": return "รู้จักค่าย IT CAMP ได้อย่างไร";
            case "a_knowitcampfrom_other": return "รู้จักค่าย IT CAMP ได้อย่างไร (อื่นๆ)";
            case "a_shirtsize": return "ขนาดเสื้อ";
            case "guardian_address_amphure":
            case "address_amphure": return "เขต/อำเภอ";
            case "guardian_address_homenum":
            case "address_homenum": return "บ้านเลขที่";
            case "guardian_address_moo":
            case "address_moo": return "หมู่";
            case "guardian_address_province":
            case "address_province": return "จังหวัด";
            case "guardian_address_road":
            case "address_road": return "ถนน";
            case "guardian_address_tumbon":
            case "address_tumbon": return "แขวง/ตำบล";
            case "guardian_address_zipcode":
            case "address_zipcode": return "รหัสไปรษณีย์";
            case "birthday": return "วันเกิด";
            case "camp_by_1":
            case "camp_by_2":
            case "camp_by_3": return "จัดโดย";
            case "camp_name_1": return "ชื่อค่าย 1";
            case "camp_name_2": return "ชื่อค่าย 2";
            case "camp_name_3": return "ชื่อค่าย 3";
            case "citizen_numid": return "เลขประจำตัวประชาชน";
            case "email": return "อีเมลล์";
            case "guardian_f_name":
            case "f_name": return "ชื่อ";
            case "facebook_url": return "เฟซบุ๊ก";
            case "guardian_connection": return "เกี่ยวข้องเป็น";
            case "guardian_phone_1": return "เบอร์โทรศัพท์ในกรณีฉุกเฉิน 1";
            case "guardian_phone_2": return "เบอร์โทรศัพท์ในกรณีฉุกเฉิน 2";
            case "interest_faculty_1":
            case "interest_faculty_2":
            case "interest_faculty_3": return "คณะ";
            case "interest_university_1":
            case "interest_university_2":
            case "interest_university_3": return "มหาวิทยาลัย/สถาบัน";
            case "guardian_l_name":
            case "l_name": return "นามสกุล";
            case "nickname": return "ชื่อเล่น";
            case "p_name": return "คำนำหน้า";
            case "p_name_other": return "คำนำหน้า (อื่นๆ)";
            case "phone": return "เบอร์โทรศัพท์";
            case "religion": return "ศาสนา";
            case "sex": return "เพศ";
            case "study_current_grade": return "ระดับชั้น";
            case "study_plan": return "แผนการเรียน";
            case "study_school": return "โรงเรียน/วิทยาลัย";
            case "study_school_province": return "จังหวัด";
            default: return "NULL";
        }
    }

}