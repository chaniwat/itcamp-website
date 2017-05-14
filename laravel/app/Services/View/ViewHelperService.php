<?php

namespace App\Services\View;

class ViewHelperService implements ViewHelperInterface
{

    /**
     * Dependency instances.
     */
    private $status;
    private $path;
    private $formBuilder;

    public function __construct(
        StatusViewService $statusViewService,
        PathHelperService $pathHelperService,
        FormBuilderService $formBuilderService
    ) {
        $this->status = $statusViewService;
        $this->path = $pathHelperService;
        $this->formBuilder = $formBuilderService;
    }

    public function makeAlertStatus($blade, $mode = null)
    {
        return $this->status->makeAlertStatus($blade, $mode);
    }

    public function isActivePath($paths)
    {
        return $this->path->isActivePath($paths);
    }

    public function formBuilder()
    {
        return $this->formBuilder;
    }

}