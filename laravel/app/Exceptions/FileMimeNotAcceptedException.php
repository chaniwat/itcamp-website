<?php

namespace App\Exceptions;

/**
 * Class FileMimeNotAcceptedException<br>
 * File mime not accepted
 * @package App\Exceptions
 */
class FileMimeNotAcceptedException extends BaseException
{
    public function __construct()
    {
        parent::__construct('File mime not accepted.', 400, 'file_mime_not_accepted');
    }
}