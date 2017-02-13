<?php

namespace App\Exceptions;

use Exception;

class FieldTypeNotAcceptException extends InvalidFieldSettingException
{

    public function __construct($message)
    {
        parent::__construct($message);
    }

}