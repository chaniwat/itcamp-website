<?php

namespace App\Providers;

use App\Services\AuthenticateService;
use App\Services\View\PathHelperService;
use App\Services\View\StatusViewService;
use App\Services\View\ViewHelperInterface;
use App\Services\View\ViewHelperService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Share viewHelper to all views
        View::share('viewHelper', $this->app->make('app.view.viewHelperService'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Authenticate Service
        $this->app->bind('app.authenticateService', AuthenticateService::class);

        // View helper dependencies
        $this->app->bind('app.view.statusViewService', StatusViewService::class);
        $this->app->bind('app.view.pathHelperService', PathHelperService::class);
        // View helper class
        $this->app->bind('app.view.viewHelperService', ViewHelperService::class, ViewHelperInterface::class);
    }
}
