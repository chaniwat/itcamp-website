<?php

namespace App\Exceptions;

/**
 * Class InvalidFieldFormatException<br>
 * Invalid field format (value's format)
 * @package App\Exceptions
 */
class InvalidFieldFormatException extends BaseException
{
    public function __construct()
    {
        parent::__construct("Invalid field format (incorrect value's format)", 400, 'invalid_field_value');
    }
}