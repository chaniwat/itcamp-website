<?php

namespace App\Exceptions;

class NoUsernameAndPasswordSet extends BaseException
{

    public function __construct()
    {
        parent::__construct("No username and password is set", 400, "no_username_and_password");
    }

}