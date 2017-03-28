<?php

namespace App\Exceptions;

use Exception;

/**
 * Class BaseException<br>
 * Custom exception for status code and status message (use with StatusViewService)
 * @package App\Exceptions
 */
class BaseException extends Exception
{
    public $status_code;
    public $status_message;

    /**
     * Exception constructor.
     * @param string $message
     * @param int $status_code
     * @param string $status_message
     */
    public function __construct($message, $status_code, $status_message)
    {
        parent::__construct($message);
        $this->status_code = $status_code;
        $this->status_message = $status_message;
    }

}