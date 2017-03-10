<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        if(env('APP_OPEN')) {
            return view('frontend.index');
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
