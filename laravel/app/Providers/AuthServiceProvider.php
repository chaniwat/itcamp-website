<?php

namespace App\Providers;

use App\Answer;
use App\ApplicantDetailKey;
use App\Http\Controllers\Backend\SelectApplicant;
use App\Policies\ApplicantQuestionPolicy;
use App\Policies\CheckAnswerPolicy;
use App\Policies\SelectApplicantPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Policies\ApplicantPolicy;
use App\Policies\CampQuestionPolicy;
use App\Policies\UserPolicy;
use App\Applicant;
use App\Question;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Applicant::class => ApplicantPolicy::class,
        ApplicantDetailKey::class => ApplicantQuestionPolicy::class,
        Question::class => CampQuestionPolicy::class,
        User::class => UserPolicy::class,
        Answer::class => CheckAnswerPolicy::class,
        SelectApplicant::class => SelectApplicantPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
