<?php

namespace App\Http\Controllers\Backend;

use App\SelectApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectApplicantController extends Controller
{

    public function showIndex() {
        return view('backend.group.select.index')->with('applicants', SelectApplicant::all());
    }

}
