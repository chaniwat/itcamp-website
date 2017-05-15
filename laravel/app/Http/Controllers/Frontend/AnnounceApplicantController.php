<?php

namespace App\Http\Controllers\Frontend;

use App\RealApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnounceApplicantController extends Controller
{
    public function showAnnounce($camp) {
        if(!in_array($camp, ['app', 'game', 'network', 'iot', 'datasci'])) {
            return abort(404);
        }

        $data = [
            "camp" => 'camp_'.$camp,
            "applicants" => RealApplicant::where('camp', 'camp_'.$camp)->get()
        ];

        switch($camp) {
            case 'app': $data['colors'] = ['#2167E8', '#2472ff']; break;
            case 'game': $data['colors'] = ['#E8A820', '#f9b422']; break;
            case 'network': $data['colors'] = ['#c43430', '#e33c38']; break;
            case 'iot': $data['colors'] = ['#5FA343', '#6ab74c']; break;
            case 'datasci': $data['colors'] = ['#3F2062', '#633399']; break;
        }

        return view('frontend.announce')->with($data);
    }
}
