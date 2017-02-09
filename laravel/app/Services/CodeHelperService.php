<?php

namespace App\Services;

class CodeHelperService
{

    private $setting_title = [
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
        'backend_add_question_success' => 'success', // add camp question
        'backend_camp_not_have_question' => 'danger', // camp not have question
        'backend_form_field_type_not_accept' => 'danger', // field type not accept (incorrect field type)
        'backend_incorrect_format_in_field_value' => 'danger', // incorrect format in field value setting of its type
        'backend_not_admin' => 'danger', // not a admin (for backend staff)
        'backend_not_enough_permission_to_create_question' => 'warning', // not enough permission to create question
        'backend_not_enough_permission_to_edit_question' => 'warning', // not enough permission to edit question
        'backend_not_enough_permission_to_remove_question' => 'warning', // not enough permission to remove question
        'backend_question_not_found' => 'warning', // question not found
        'backend_remove_question_success' => 'success', // remove question
        'backend_update_account_complete' => 'success', // update staff account
        'backend_update_account_password_complete' => 'success', // update staff account's password
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
    ];

    public function convertToTitle($code) {
        if(array_key_exists($code, $this->codeLevelTranslate)) {
            return $this->setting_title[$this->codeLevelTranslate[$code]];
        }

        return $this->setting_title['info'];
    }

    public function convertToAlertClass($code) {
        if(array_key_exists($code, $this->codeLevelTranslate)) {
            return $this->setting_alertClass[$this->codeLevelTranslate[$code]];
        }

        return $this->setting_alertClass['info'];
    }

    public function convertToIconClass($code) {
        if(array_key_exists($code, $this->codeLevelTranslate)) {
            return $this->setting_iconClass[$this->codeLevelTranslate[$code]];
        }

        return $this->setting_iconClass['info'];
    }

    public function makeAlertStatus() {

        // TODO Move to blade component

        if(session('status')) {
            $status = session('status');
            return /** @lang HTML */
                '<div class="alert '.$this->convertToAlertClass($status).' alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4><i class="icon fa '.$this->convertToIconClass($status).'"></i> '.$this->convertToTitle($status).'!</h4>
                    '.__('code.'.session('status')).'
                </div>';
        }

        return "";
    }
}