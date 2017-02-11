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
        $user = Auth::guard('backend')->user();
        if ($user->staff->is_admin || $user->staff->section->name == 'web_developer') {
            return $next($request);
        }

        return redirect()->route('view.backend.index')->with('status', 'backend_not_admin');
    }
}
