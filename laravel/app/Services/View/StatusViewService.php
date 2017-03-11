<?php

namespace App\Services\View;

class StatusViewService
{

    private $setting_alertTitle = [
        'info' => 'Info!',
        'success' => 'Success!',
        'danger' => 'Alert!',
        'warning' => 'Warning!'
    ];

    private $setting_alertClass = [
        'info' => 'alert-info',
        'success' => 'alert-success',
        'danger' => 'alert-danger',
        'warning' => 'alert-warning'
    ];

    private $setting_iconClass = [
        'info' => 'fa-info',
        'success' => 'fa-check',
        'danger' => 'fa-ban',
        'warning' => 'fa-warning'
    ];

    private $codeLevelTranslate = [
        'backend_add_account_success' => 'success', // add staff account
        'backend_add_applicant_question_success' => 'success', // add applicant question
        'backend_add_question_success' => 'success', // add camp question
        'backend_applicant_question_id_already_used' => 'warning', // applicant question field_id already used
        'backend_applicant_question_not_found' => 'warning', // applicant question not found
        'backend_camp_not_have_question' => 'danger', // camp not have question
        'backend_form_field_type_not_accept' => 'danger', // field type not accept (incorrect field type)
        'backend_incorrect_format_in_field_value' => 'danger', // incorrect format in field value setting of its type
        'backend_not_admin' => 'danger', // not a admin (for backend staff)
        'backend_not_enough_permission_to_create_applicant_question' => 'warning', // not enough permission to create applicant question
        'backend_not_enough_permission_to_edit_applicant_question' => 'warning', // not enough permission to edit applicant question
        'backend_not_enough_permission_to_remove_applicant_question' => 'warning', // not enough permission to remove applicant question
        'backend_not_enough_permission_to_create_question' => 'warning', // not enough permission to create camp question
        'backend_not_enough_permission_to_edit_question' => 'warning', // not enough permission to edit camp question
        'backend_not_enough_permission_to_remove_question' => 'warning', // not enough permission to remove camp question
        'backend_question_id_already_used' => 'warning', // camp question field_id already used
        'backend_question_not_found' => 'warning', // camp question not found
        'backend_remove_applicant_question_success' => 'success', // remove applicant question
        'backend_remove_question_success' => 'success', // remove camp question
        'backend_update_account_complete' => 'success', // update staff account
        'backend_update_account_password_complete' => 'success', // update staff account's password
        'backend_update_applicant_question_success' => 'success', // update applicant question
        'backend_update_question_success' => 'success', // update camp question
        'confirm_password_not_match' => 'danger', // check match password
        'frontend_register_camp_not_select' => 'danger', // camp not select
        'frontend_register_profile_citizen_numid_bad_format' => 'danger', // citizen id bad format
        'frontend_register_profile_phone_bad_format' => 'danger', // phone bad format
        'frontend_register_profile_zipcode_bad_format' => 'danger', // zipcode bad format
        'form_empty_field' => 'danger', // empty field
        'form_invalid_file_type' => 'danger', // invalid file type
        'login_failed' => 'danger', // login failed
        'logout_successful' => 'info', // logout successful
        'username_already_used' => 'warning', // username already used
    ];

    private function convertToAlertTitle($code) {
        if(array_key_exists($code, $this->codeLevelTranslate)) {
            return $this->setting_alertTitle[$this->codeLevelTranslate[$code]];
        }

        return $this->setting_alertTitle['info'];
    }

    private function convertToAlertClass($code) {
        if(array_key_exists($code, $this->codeLevelTranslate)) {
            return $this->setting_alertClass[$this->codeLevelTranslate[$code]];
        }

        return $this->setting_alertClass['info'];
    }

    private function convertToIconClass($code) {
        if(array_key_exists($code, $this->codeLevelTranslate)) {
            return $this->setting_iconClass[$this->codeLevelTranslate[$code]];
        }

        return $this->setting_iconClass['info'];
    }

    /**
     * Make alert if have status (in session)
     * @param $blade blade component to show alert
     * @return mixed
     */
    public function makeAlertStatus($blade) {
        if(session('status')) {
            $status = session('status');

            $alert = [
                'class' => $this->convertToAlertClass($status),
                'icon' => $this->convertToIconClass($status),
                'title' => $this->convertToAlertTitle($status),
                'message' => __('alert_status.'.$status)
            ];

            return view($blade)->with(['alert' => $alert]);
        }

        return "";
    }
}