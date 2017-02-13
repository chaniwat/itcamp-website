<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Services\AuthenticateService;
use Illuminate\Http\Request;

use App\Http\Requests;
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
        $this->auth = $authService->backend;
    }

    public function login(Request $request) {
        if($this->auth->login($request->input('username'), $request->input('password'))) {
            return redirect()->intended('backend');
        }

        return redirect()->route('view.backend.login')->with('status', 'login_failed');
    }

    public function logout() {
        if($this->auth->logout()) {
            return redirect()->route('view.backend.login')->with('status', 'logout_successful');
        }

        return redirect()->route('view.backend.login');
    }

    public function showLogin() {
        return view('backend.group.auth.login');
    }

}
