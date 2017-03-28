<?php

namespace App\Exceptions;

/**
 * Class ValidatorNoRulesGivenException<br>
 * No rule given when validating something
 * @package App\Exceptions
 */
class ValidatorNoRulesGivenException extends ValidatorServiceException
{
    public function __construct()
    {
        parent::__construct('Set rules first before validate the inputs', 500, null);
    }
}