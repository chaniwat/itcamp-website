<?php

namespace App\Exceptions;

class StaffNotFound extends BaseException
{

    public function __construct($id)
    {
        parent::__construct("Staff not found, id : ".$id, "staff_not_found", 'view.backend.account.staff', 404);
    }

}