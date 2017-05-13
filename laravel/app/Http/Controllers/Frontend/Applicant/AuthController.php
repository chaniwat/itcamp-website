<?php

namespace App\Http\Controllers\Frontend\Applicant;

use App\Services\AuthenticateService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    /**
     * AuthenticateService instance.
     * Backend Guard
     */
    protected $auth;

    public function __construct(AuthenticateService $authService)
    {
        $this->auth = $authService->frontend;
    }

    public function login(Request $request) {
        if($this->auth->login($request->input('username'), $request->input('password'))) {
            return redirect()->route('view.frontend.applicant.index');
        }

        return redirect()->route('view.frontend.applicant.login')->with('status', 'login_incorrect_detail');
    }

    public function logout() {
        if($this->auth->logout()) {
            return redirect()->route('view.frontend.applicant.login')->with('status', 'logout_successful');
        }

        return redirect()->route('view.frontend.applicant.login');
    }

    public function showLogin() {
        return view('frontend.applicant.login');
    }

}
