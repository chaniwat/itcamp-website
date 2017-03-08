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
        $data = [
            "camp" => 'camp_'.$camp,
            "applicantQuestions" => ApplicantDetailKey::orderBy('priority', 'desc')->get(),
            "campQuestions" => Question::getCampQuestion('camp_'.$camp)
        ];

        return view('frontend.register')->with($data);
    }

    public function showComplete()
    {
        return view('frontend.reg_complete');
    }

}
