<?php

namespace App\Providers;

use App\Services\AccountService;
use App\Services\ApplicantService;
use App\Services\AuthenticateService;
use App\Services\FileService;
use App\Services\FormService;
use App\Services\QuestionService;
use App\Services\ValidatorService;
use App\Services\View\FormBuilderService;
use App\Services\View\PathHelperService;
use App\Services\View\StatusViewService;
use App\Services\View\ViewHelperInterface;
use App\Services\View\ViewHelperService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Utilities Service
        //
        // File Service
        $this->app->bind('app.fileService', FileService::class);
        // Form Service
        $this->app->bind('app.formService', FormService::class);
        // Validator Service
        $this->app->bind('app.validatorService', ValidatorService::class);

        // App Services
        //
        // Account Service
        $this->app->bind('app.accountService', AccountService::class);
        // Authenticate Service
        $this->app->bind('app.authenticateService', AuthenticateService::class);
        // Applicant Service
        $this->app->bind('app.applicantService', ApplicantService::class);
        // Question Service
        $this->app->bind('app.questionService', QuestionService::class);

        // View Services
        //
        // View helper dependencies
        $this->app->bind('app.view.statusViewService', StatusViewService::class);
        $this->app->bind('app.view.pathHelperService', PathHelperService::class);
        $this->app->bind('app.view.formBuilderService', FormBuilderService::class);
        // View helper service
        $this->app->bind('app.view.viewHelperService', ViewHelperService::class, ViewHelperInterface::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Share viewHelper to all views (ViewHelperService)
        View::share('viewHelper', $this->app->make('app.view.viewHelperService'));
    }
}
