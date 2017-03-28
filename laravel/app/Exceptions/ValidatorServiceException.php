<?php

namespace App\Exceptions;

class ValidatorServiceException extends BaseException
{
    public function __construct($message, $status_code, $status_message)
    {
        parent::__construct($message, $status_code, $status_message);
    }
}