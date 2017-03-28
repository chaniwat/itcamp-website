<?php

namespace App\Exceptions;

/**
 * Class FieldTypeNotAcceptedException<br>
 * Field type not accepted.
 * @package App\Exceptions
 */
class FieldTypeNotAcceptedException extends BaseException
{
    public function __construct($type)
    {
        parent::__construct('Field type not accepted: '.$type, 400, 'backend_form_field_type_not_accept');
    }
}