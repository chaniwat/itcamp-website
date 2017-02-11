<?php

namespace App\Services\View;

class ViewHelperService implements ViewHelperInterface
{

    /**
     * Dependency instances.
     */
    private $status;
    private $path;

    public function __construct(
        StatusViewService $statusViewService,
        PathHelperService $pathHelperService)
    {
        $this->status = $statusViewService;
        $this->path = $pathHelperService;
    }

    public function makeAlertStatus($blade)
    {
        return $this->status->makeAlertStatus($blade);
    }

    public function isActivePath($paths)
    {
        return $this->path->isActivePath($paths);
    }

}