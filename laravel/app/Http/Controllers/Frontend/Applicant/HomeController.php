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
            'applicant' => $user->applicant
        ];

        switch(str_replace('camp_', '', $data['applicant']->camp->name)) {
            case 'app': $data['colors'] = ['#2167E8', '#2472ff']; break;
            case 'game': $data['colors'] = ['#E8A820', '#f9b422']; break;
            case 'network': $data['colors'] = ['#c43430', '#e33c38']; break;
            case 'iot': $data['colors'] = ['#5FA343', '#6ab74c']; break;
            case 'datasci': $data['colors'] = ['#3F2062', '#633399']; break;
        }

        return view('frontend.applicant.index')->with($data);
    }

}
