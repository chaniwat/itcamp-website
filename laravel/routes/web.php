<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#region Frontend route

Route::group(['namespace' => 'Frontend'], function () {

    Route::get('/', 'HomeController@index')->name('view.frontend.index');
    Route::get('/landing', 'HomeController@showLanding')->name('view.frontend.landing');

    #region register

    if(env('APP_OPEN')) {

        Route::group(['prefix' => 'applicant', 'namespace' => 'Applicant'], function () {

            Route::group(['middleware' => 'web'], function () {
                Route::get('/', 'HomeController@showIndex')->name('view.frontend.applicant.index');
            });

            Route::group(['middleware' => 'guest'], function () {
                Route::get('/login', 'AuthController@showLogin')->name('view.frontend.applicant.login');
            });

            Route::post('login', 'AuthController@login')->name('frontend.applicant.auth.login');
            Route::get('logout', 'AuthController@logout')->name('frontend.applicant.auth.logout');

        });

        Route::group(['prefix' => 'advertise'], function () {
            Route::get('/', 'AdvertiseController@showForm')->name('view.frontend.advertise');
            Route::get('/complete', 'AdvertiseController@showComplete')->name('view.frontend.advertise.complete');
            Route::post('/', 'AdvertiseController@saveAdvertise')->name('frontend.advertise');
        });

        Route::group(['prefix' => 'register', 'middleware' => 'web.registration'], function () {
            Route::get('/complete', 'RegisterController@showComplete')->name('view.frontend.register.complete');
            Route::get('/close', 'RegisterController@showClose')->name('view.frontend.register.close');

            Route::get('/{camp}', 'RegisterController@showRegister')->name('view.frontend.register');
            Route::post('/{camp}', 'RegisterController@register')->name('frontend.register');
        });

        Route::group(['prefix' => '/s/register'], function () {
            Route::get('/complete', 'RegisterController@secretShowComplete')->name('view.frontend.s.register.complete');
            Route::get('/{camp}', 'RegisterController@secretShowRegister')->name('view.frontend.s.register');
            Route::post('/{camp}', 'RegisterController@secretRegister')->name('frontend.s.register');
        });
    }

    #endregion

});

#endregion

#region Backend route

Route::group(['prefix' => 'backend', 'namespace' => 'Backend'], function () {

    #region non-auth routes (logout, logout, etc)

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

        Route::group(['middleware' => 'guest.backend'], function () {
            Route::get('login', 'AuthController@showLogin')->name('view.backend.login');
        });

        Route::post('login', 'AuthController@login')->name('backend.auth.login');
        Route::get('logout', 'AuthController@logout')->name('backend.auth.logout');

    });

    #endregion

    #region auth route : only staff account

    Route::group(['middleware' => 'auth.backend'], function () {

        Route::get('/', 'DashboardController@index')->name('view.backend.index');

        Route::get('/self/password', 'AccountStaffController@showUpdateSelfPassword')->name('view.backend.self.password');
        Route::post('/self/password', 'AccountStaffController@updateSelfPassword')->name('backend.self.password');

        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/register', 'DashboardController@showRegisterDashboard')->name('view.backend.dashboard.register');
            Route::get('/overview', 'DashboardController@showOverviewDashboard')->name('view.backend.dashboard.overview');
        });

        Route::group(['prefix' => 'applicant/select'], function () {

            Route::get('/', 'SelectApplicantController@showIndex')->name('view.backend.applicant.select');

        });

        Route::group(['prefix' => 'applicant'], function () {

            Route::get('/', 'ApplicantController@showApplicants')->name('view.backend.applicants');
            Route::get('/{id}', 'ApplicantController@showApplicantDetail')->name('view.backend.applicants.detail');

            Route::post('/', 'ApplicantController@goToApplicantID')->name('backend.applicants.go_to_id');
            Route::post('/{id}/status', 'ApplicantController@approvingApplicant')->name('backend.applicants.update.state');

        });

        /*
        Route::group(['prefix' => 'stats'], function () {

            Route::get('/', 'StatsController@showOverview')->name('view.backend.stats');
            Route::get('/view', 'StatsController@showView')->name('view.backend.stats.view');
            Route::get('/error', 'StatsController@showError')->name('view.backend.stats.error');

        });
        */

        Route::group(['prefix' => 'answer'], function () {

            Route::get('/', 'AnswerController@showIndex')->name('view.backend.answers');
            Route::get('/overall', 'AnswerController@showOverall')->name('view.backend.answers.overall');
            Route::get('/check', 'AnswerController@showCheckAnswer')->name('view.backend.answers.check');

            Route::post('/save', 'AnswerController@saveScore')->name('backend.answers.save.score');

        });

        Route::group(['prefix' => 'question'], function () {

            Route::group(['prefix' => 'applicant'], function () {
                Route::get('/', 'ApplicantQuestionController@showViewQuestion')->name('view.backend.question.applicant');
                Route::get('create', 'ApplicantQuestionController@showViewCreateQuestion')->name('view.backend.question.applicant.create');
                Route::get('{id}/update', 'ApplicantQuestionController@showViewUpdateQuestion')->name('view.backend.question.applicant.update');

                Route::post('create', 'ApplicantQuestionController@createQuestion')->name('backend.question.applicant.create');
                Route::post('{id}/update', 'ApplicantQuestionController@updateQuestion')->name('backend.question.applicant.update');
                Route::get('{id}/delete', 'ApplicantQuestionController@deleteQuestion')->name('backend.question.applicant.delete');
            });

            Route::group(['prefix' => 'camp'], function () {
                Route::get('/', 'CampQuestionController@showViewQuestion')->name('view.backend.question.camp');
                Route::get('create', 'CampQuestionController@showViewCreateQuestion')->name('view.backend.question.camp.create');
                Route::get('{id}/update', 'CampQuestionController@showViewUpdateQuestion')->name('view.backend.question.camp.update');

                Route::post('create', 'CampQuestionController@createQuestion')->name('backend.question.camp.create');
                Route::post('{id}/update', 'CampQuestionController@updateQuestion')->name('backend.question.camp.update');
                Route::get('{id}/delete', 'CampQuestionController@deleteQuestion')->name('backend.question.camp.delete');
            });

        });

        Route::group(['prefix' => 'account'], function () {

            Route::group(['prefix' => 'applicant'], function () {
                // TODO Applicant Account Management (For applicant to login into system when have been selected)
                Route::get('/', function () {
                    abort(404);
                })->name('view.backend.account.applicant');
            });

            Route::group(['prefix' => 'staff'], function () {
                Route::get('/', 'AccountStaffController@showStaff')->name('view.backend.account.staff');
                Route::get('create', 'AccountStaffController@showCreateStaff')->name('view.backend.account.staff.create');
                Route::get('{id}/update', 'AccountStaffController@showUpdateStaff')->name('view.backend.account.staff.update');

                Route::post('add', 'AccountStaffController@createStaff')->name('backend.account.staff.create');
                Route::post('{id}/update', 'AccountStaffController@updateStaff')->name('backend.account.staff.update');
                Route::post('{id}/update/password', 'AccountStaffController@updateStaffPassword')->name('backend.account.staff.update.password');
            });

        });

    });

    #endregion

});

#endregion
