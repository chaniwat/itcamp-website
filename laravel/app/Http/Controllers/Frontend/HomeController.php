<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
//        return view('frontend.index');

        // Redirect to landing page
        return redirect()->route('view.frontend.landing');
    }

    public function showLanding()
    {
        return view('frontend.landing');
    }

}
