<?php

namespace App\Http\Controllers\Backend;

use App\Applicant;
use App\ApplicantDetailKey;
use App\Services\ApplicantService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ApplicantController extends Controller
{

    // TODO Approve/Reject Applicant

    public function approvingApplicant(Request $request, $id) {
        // Policies Check
        if (Gate::denies('update_state', Applicant::class)) {
            return redirect()->route('view.backend.applicants.detail', ["id" => $id])->with('status', 'backend_not_enough_permission_to_update_applicant_state');
        }

        if(($applicant = Applicant::find($id)) == null) {
            return redirect()->route('view.backend.applicants')->with('status', 'backend_applicant_not_found');
        }

        $applicant->state = $request->input('state');
        $applicant->save();

        return redirect()->back()->with('status', 'backend_applicant_state_updated');
    }

    public function goToApplicantID(Request $request) {
        return redirect()->route('view.backend.applicants.detail', ['id' => $request->input('id')]);
    }

    public function showApplicants()
    {
        // NOTE No need to order (let DataTable.js handle itself)
//        return view('backend.group.applicant.index')->with('applicants', Applicant::orderByRaw(
//            "FIELD(state, 'PENDING', 'CHECKED', 'COMPLETE', 'SELECT', 'RESERVE', 'CONFIRM_SELECT', 'CONFIRM_RESERVE', 'CANCEL_SELECT', 'CANCEL_RESERVE', 'FAIL', 'REJECT'), id DESC"
//        )->get());
        return view('backend.group.applicant.index')->with('applicants', Applicant::all());
    }

    public function showApplicantDetail($id)
    {
        if(($applicant = Applicant::find($id)) == null) {
            return redirect()->route('view.backend.applicants')->with('status', 'backend_applicant_not_found');
        }

        $next = DB::table('applicants')->select('id')
            ->where('id', '>', $applicant->id)
            ->orderByRaw('id ASC')
            ->first();
        $previous = DB::table('applicants')->select('id')
            ->where('id', '<', $applicant->id)
            ->orderByRaw('id DESC')
            ->first();

        $data = [
            'applicantQuestions' => ApplicantDetailKey::orderBy('priority', 'desc')->get(),
            'applicant' => $applicant,
            'nextId' => $next != null ? $next->id : null,
            'previousId' => $previous != null ? $previous->id : null,
        ];

        return view('backend.group.applicant.detail')->with($data);
    }

}
