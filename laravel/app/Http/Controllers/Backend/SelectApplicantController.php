<?php

namespace App\Http\Controllers\Backend;

use App\Camp;
use App\SelectApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectApplicantController extends Controller
{

    public function saveSelectState(Request $request, $id) {
        $applicant = SelectApplicant::where('applicant_id', $id)->first();
        $applicant->state = $request->input('state');
        $applicant->save();

        return response()->json();
    }

    public function showIndex() {
        $applicants = SelectApplicant::all();

        $camps = Camp::all();
        $campIds = $camps->pluck('id')->all();

        $count = [];

        foreach($campIds as $campId) {
            $count[$camps->find($campId)->name] = [0, 0, 0];

            foreach ($applicants as $applicant) {
                if($applicant->applicant->camp_id == $campId) {
                    switch ($applicant->state) {
                        case 'SELECT': $count[$camps->find($campId)->name][0]++; break;
                        case 'RESERVE': $count[$camps->find($campId)->name][1]++; break;
                        case 'REJECT': $count[$camps->find($campId)->name][2]++; break;
                    }
                }
            }
        }

        $data = [
            'applicants' => $applicants,
            'camps' => $camps,
            'count' => $count
        ];

        return view('backend.group.select.index')->with($data);
    }

}
