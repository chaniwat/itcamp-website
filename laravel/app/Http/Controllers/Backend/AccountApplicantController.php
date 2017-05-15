<?php

namespace App\Http\Controllers\Backend;

use App\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountApplicantController extends Controller
{

    public function showApplicant() {
        return view('backend.group.account.applicant.index')->with('applicants', Applicant::whereNotNull('user_id')->get());
    }

}
