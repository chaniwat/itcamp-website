<?php

namespace App\Http\Controllers\Frontend\Applicant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function showIndex() {
        $user = Auth::user();

        $data = [
            "applicant" => $user->applicant
        ];

        return view('frontend.applicant.index')->with($data);
    }

}
