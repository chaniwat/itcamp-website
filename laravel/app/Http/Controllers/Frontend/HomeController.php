<?php

namespace App\Http\Controllers\Frontend;

use App\AdvertiseWeb;
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
