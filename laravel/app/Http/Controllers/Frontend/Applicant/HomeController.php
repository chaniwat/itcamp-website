<?php

namespace App\Http\Controllers\Frontend\Applicant;

use App\ApplicantEvidence;
use App\Services\FileService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    /**
     * @var FileService
     */
    private $fileService;

    function __construct(FileService $fileService) {
        $this->fileService = $fileService;
    }

    public function uploadEvidenceSlip(Request $request) {
        if($request->hasFile("evidence_slip")) {
            $file = $request->file("evidence_slip");

            if (!$this->fileService->checkFileMimeAccepted('{"acceptTypes": "picture"}', $file)) {
                return redirect()->route('view.frontend.applicant.index')->with('status', 'evidence_invalid_file_type');
            } else if (!$this->fileService->checkFileSizeAccepted($file)) {
                return redirect()->route('view.frontend.applicant.index')->with('status', 'evidence_invalid_file_size');
            }

            $value = $this->fileService->storeFile($file, "applicant/evidence");

            $applicant = Auth::user()->applicant;

            $evidence = new ApplicantEvidence();
            $evidence->applicant()->associate($applicant);
            $evidence->file = $value;
            $evidence->state = "PENDING";

            $evidence->save();

            return redirect()->route('view.frontend.applicant.index')->with('status', 'evidence_upload_complete');
        } else {
            return redirect()->route('view.frontend.applicant.index')->with('status', 'evidence_no_file');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disclaimCamp(Request $request) {
        if(Hash::check($request->input('d_password'), Auth::user()->password)) {
            $applicant = Auth::user()->applicant;

            if($applicant->state == "SELECT") {
                $applicant->state = "CANCEL_SELECT";
            } else if($applicant->state == "RESERVE") {
                $applicant->state = "CANCEL_RESERVE";
            }
            $applicant->save();

            Auth::logout();

            return redirect()->route('view.frontend.applicant.login')->with('status', 'applicant_disclaim_complete');
        } else {
            return redirect()->route('view.frontend.applicant.index')->with('status', 'applicant_disclaim_invalid_password');
        }
    }

    public function showIndex() {
        $user = Auth::user();
        $applicant = $user->applicant;

        $data = [
            'applicant' => $applicant,
            'evidence_state' => $applicant->evidences->count() > 0 ? $applicant->evidences->first()->state : 'NOT_SEND'
        ];

        if($applicant->evidences->count() > 0) {
            $data['evidence'] = $applicant->evidences->first();
        }

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
