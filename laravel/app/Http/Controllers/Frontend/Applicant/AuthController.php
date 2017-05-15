<?php

namespace App\Http\Controllers\Frontend\Applicant;

use App\Services\AuthenticateService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        if($user = $this->auth->login($request->input('username'), $request->input('password'))) {
            $user = Auth::user();

            if(in_array($user->applicant->state, ['CANCEL_SELECT', 'CANCEL_RESERVE'])) {
                $this->auth->logout();
                return redirect()->route('view.frontend.applicant.login')->with('status', 'login_disclaim');
            } else if($user->applicant->state == 'RESERVE' && !$user->active) {
                $this->auth->logout();
                return redirect()->route('view.frontend.applicant.login')->with('status', 'login_reserve');
            }

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
