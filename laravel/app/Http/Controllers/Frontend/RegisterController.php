<?php

namespace App\Http\Controllers\Frontend;

use App\ApplicantDetailKey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{

    public function register(Request $request)
    {

    }

    public function showRegister()
    {
        $data = [
            "questions" => ApplicantDetailKey::all()
        ];

        return view('frontend.register')->with($data);
    }

}
