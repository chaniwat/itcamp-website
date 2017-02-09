<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // TODO Move to APIs (for future using)

    public function login(Request $request) {
        if(Auth::guard('backend')->attempt(['username' => $request->input('username'), 'password' => $request->input('password'), 'type' => 'STAFF'])) {
            return redirect()->intended('backend');
        }

        return redirect()->route('view.backend.login')->with('status', 'login_failed');
    }

    public function logout() {
        if(Auth::guard('backend')->check()) {
            Auth::guard('backend')->logout();
            return redirect()->route('view.backend.login')->with('status', 'logout_successful');
        }

        return redirect()->route('view.backend.login');
    }

    public function showLogin() {
        return view('backend.group.auth.login');
    }

}
