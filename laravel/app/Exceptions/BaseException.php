<?php

namespace App\Exceptions;

/**
 * Class BaseException<br>
 * Custom exception for status code and status message (use with StatusViewService)
 * @package App\Exceptions
 */
class BaseException extends \Exception
{

    private $route;
    private $status;

    /**
     * Exception constructor.
     * @param string $message
     * @param string $status
     * @param string $route
     * @param int $code
     */
    public function __construct($message, $status, $route, $code = 0)
    {
        parent::__construct($message, $code);
        $this->code = $code;
        $this->status = $status;
        $this->route = $route;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getRoute()
    {
        return $this->route;
    }

}