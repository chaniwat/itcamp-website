<?php

namespace App\Exceptions;

/**
 * Class FileSizeNotAcceptedException<br>
 * File size not accepted (Higher than accept size)<br>
 * See maximum size in FormService (or set 'FILE_MAX_UPLOADED_SIZE' in .env)
 * @package App\Exceptions
 */
class FileSizeNotAcceptedException extends BaseException
{
    public function __construct()
    {
        parent::__construct("File size not accepted. (Higher than accept size)", 400, 'file_size_not_accepted');
    }
}