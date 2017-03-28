<?php

namespace App\Exceptions;

/**
 * Class InvalidFieldSettingException<br>
 * Invalid field setting
 * @package App\Exceptions
 */
class InvalidFieldSettingException extends BaseException
{
    public function __construct()
    {
        parent::__construct('Invalid field setting', 400, 'invalid_field_setting');
    }
}