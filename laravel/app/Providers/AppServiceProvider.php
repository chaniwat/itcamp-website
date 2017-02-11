<?php

namespace App\Providers;

use App\Services\AuthenticateService;
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
        //
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
    }
}
