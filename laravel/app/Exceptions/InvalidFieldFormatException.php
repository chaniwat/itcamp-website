<?php

namespace App\Exceptions;

use Exception;

class InvalidFieldFormatException extends InvalidFieldSettingException
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}