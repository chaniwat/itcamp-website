<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BackendCheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('backend')->user()->staff->is_admin) {
            return $next($request);
        }

        return redirect()->route('view.backend.login')->with('status', 'backend_not_admin');
    }
}
