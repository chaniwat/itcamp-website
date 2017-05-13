<?php

namespace App\Services\View;

interface ViewHelperInterface
{

    public function makeAlertStatus($blade, $mode = null);
    public function isActivePath($paths);
    public function formBuilder();

}