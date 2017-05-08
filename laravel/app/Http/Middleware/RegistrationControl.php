<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class RegistrationControl
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
        $registrationEnd = Carbon::createFromFormat('d/m/Y', env('APP_REGISTRATION_END'));
        $now = Carbon::now()->subSeconds(env('APP_TIME_OFFSET', 0));

        if($now->greaterThan($registrationEnd)) {
            if(!$request->is('register/close')) {
                return redirect()->route('view.frontend.register.close');
            }
        } else {
            if($request->is('register/close')) {
                return redirect()->route('view.frontend.index');
            }
        }

        return $next($request);
    }
}
