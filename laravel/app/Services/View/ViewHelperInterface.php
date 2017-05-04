<?php

namespace App\Services\View;

use App\Exceptions\BaseException;

interface ViewHelperInterface
{

    public function makeAlertStatus($blade);
    public function makeAlertException(BaseException $exception, $blade);
    public function isActivePath($paths);
    public function formBuilder();

}