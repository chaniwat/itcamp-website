<?php

namespace App\Exceptions;

use Exception;

class InvalidFieldSettingException extends \Exception
{

    public function __construct($message)
    {
        parent::__construct($message);
    }

}