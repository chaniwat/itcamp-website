<?php

namespace App\Http\Controllers\Backend;

use App\Applicant;
use App\ApplicantDetailKey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicantController extends Controller
{

    public function showApplicants()
    {
        return view('backend.group.applicant.index')->with('applicants', Applicant::orderByRaw(
            "FIELD(state, 'PENDING', 'CHECKED', 'COMPLETE', 'SELECT', 'RESERVE', 'FAIL', 'REJECT') ASC, id DESC"
        )->get());
    }

    public function showApplicantDetail($id)
    {
        $data = [
            'applicantQuestions' => ApplicantDetailKey::orderBy('priority', 'desc')->get(),
            'applicant' => Applicant::find($id)
        ];

        return view('backend.group.applicant.detail')->with($data);
    }

}
