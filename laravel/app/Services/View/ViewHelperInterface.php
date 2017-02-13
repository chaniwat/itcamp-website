<?php

namespace App\Services\View;

interface ViewHelperInterface
{
    public function makeAlertStatus($blade);
    public function isActivePath($paths);
}