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

        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/register', 'DashboardController@showRegisterDashboard')->name('view.backend.dashboard.register');
            Route::get('/overview', 'DashboardController@showOverviewDashboard')->name('view.backend.dashboard.overview');
        });

        Route::group(['prefix' => 'applicant'], function() {
            Route::get('/', function () { abort(404); })->name('view.backend.applicants');
        });

        Route::group(['prefix' => 'answer'], function() {
            Route::get('/', function () { abort(404); })->name('view.backend.answers');
        });

        Route::group(['prefix' => 'question'], function () {
            Route::get('/', function () { abort(404); })->name('view.backend.question');
        });

        Route::group(['prefix' => 'account', 'middleware' => 'admin.backend'], function() {

            Route::group(['prefix' => 'applicant'], function () {
                // TODO Applicant Account Management (For applicant to login into system when have been selected)
                Route::get('/', function () { abort(404); })->name('view.backend.account.applicant');
            });

            Route::group(['prefix' => 'staff'], function () {

                Route::get('/', 'AccountStaffController@showStaff')->name('view.backend.account.staff');
                Route::get('add', 'AccountStaffController@showCreateStaff')->name('view.backend.account.staff.create');
                Route::get('edit/{id}', 'AccountStaffController@showUpdateStaff')->name('view.backend.account.staff.update');

                Route::post('add', 'AccountStaffController@createStaff')->name('backend.account.staff.create');
                Route::post('edit/{id}', 'AccountStaffController@updateStaff')->name('backend.account.staff.update');
                Route::post('edit/{id}/password', 'AccountStaffController@updateStaffPassword')->name('backend.account.staff.update.password');

            });

        });

    });

    #endregion

});

#endregion
