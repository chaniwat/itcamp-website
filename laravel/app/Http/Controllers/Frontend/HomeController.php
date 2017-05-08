<?php

namespace App\Http\Controllers\Frontend;

use App\AdvertiseWeb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        if(env('APP_OPEN')) {

            $data = [
                "sponsors" => [
                    "big" => ["kmitl.jpg", "itkmitl.jpg"],
                    "medium" => ["camphub.png"],
                    "small" => []
                ],
                "exchangers" => [
                    "banner" => AdvertiseWeb::whereNotNull('banner')->get(),
                    "text" => AdvertiseWeb::whereNull('banner')->get()
                ]
            ];

            $now = Carbon::now()->subSeconds(env('APP_TIME_OFFSET', 0));
            $registrationEnd = Carbon::createFromFormat('d/m/Y H:i:s', env('APP_REGISTRATION_END').' 00:00:00');
            $announceEnd = Carbon::createFromFormat('d/m/Y H:i:s', "15/05/2017 00:00:00");
            $confirmEnd = Carbon::createFromFormat('d/m/Y H:i:s', "22/05/2017 00:00:00");
            $campEnd = Carbon::createFromFormat('d/m/Y H:i:s', "08/06/2017 00:00:00");

            $data['registrationEnd'] = $now->greaterThan(Carbon::createFromFormat('d/m/Y', env('APP_REGISTRATION_END')));
            $data['timeline'] = [
                "registration" => $now->greaterThanOrEqualTo($registrationEnd),
                "announce" => $now->greaterThanOrEqualTo($announceEnd),
                "confirm" => $now->greaterThanOrEqualTo($confirmEnd),
                "camp_day" => $now->greaterThanOrEqualTo($campEnd),
            ];

            return view('frontend.index')->with($data);
        } else {
            // Redirect to landing page
            return redirect()->route('view.frontend.landing');
        }
    }

    public function showLanding()
    {
        if(env('APP_OPEN')) {
            // Redirect to index page
            return redirect()->route('view.frontend.index');
        } else {
            return view('frontend.landing');
        }
    }

}
