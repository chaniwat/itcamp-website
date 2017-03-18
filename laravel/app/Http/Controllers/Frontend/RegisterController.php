<?php

namespace App\Http\Controllers\Frontend;

use App\ApplicantDetailKey;
use App\Camp;
use App\Question;
use App\Services\ApplicantService;
use App\Services\ValidatorService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{

    private $validator;
    private $applicant;

    function __construct(ValidatorService $validatorService, ApplicantService $applicantService)
    {
        $this->validator = $validatorService;
        $this->applicant = $applicantService;
    }

    public function register(Request $request, $camp)
    {
        $this->applicant->register($request, $camp);

        return redirect()->route('view.frontend.register.complete');
    }

    public function showRegister($camp)
    {
        if(!in_array($camp, ['app', 'game', 'network', 'iot', 'datasci'])) {
            return abort(404);
        }

        $data = [
            "camp" => 'camp_'.$camp,
            "applicantQuestions" => ApplicantDetailKey::orderBy('priority', 'desc')->get(),
            "campQuestions" => Question::getCampQuestion('camp_'.$camp)
        ];

        switch($camp) {
            case 'app': $data['colors'] = ['#2167E8', '#2472ff']; break;
            case 'game': $data['colors'] = ['#E8A820', '#f9b422']; break;
            case 'network': $data['colors'] = ['#c43430', '#e33c38']; break;
            case 'iot': $data['colors'] = ['#5FA343', '#6ab74c']; break;
            case 'datasci': $data['colors'] = ['#3F2062', '#633399']; break;
        }

        return view('frontend.register')->with($data);
    }

    public function showComplete()
    {
        return view('frontend.reg_complete');
    }

}
