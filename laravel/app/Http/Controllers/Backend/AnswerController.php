<?php

namespace App\Http\Controllers\Backend;

use App\Answer;
use App\Applicant;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AnswerController extends Controller
{

    public function saveAnswer() {
        abort(404);
    }

    public function showIndex() {
        // Policies Check
        if (Gate::denies('view_check_answer', Answer::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_check_answer');
        }

        $staff = Auth::user()->staff;

        if((!$staff->section->has_question && $staff->is_admin) || in_array($staff->section->name, ["web_developer", "knowledge"])) {
            return redirect()->route('view.backend.answers.overall');
        }

        $data = [];
        if(in_array($staff->section->name, ["head", "recreation"])) {
            $data['mode'] = "CHECKER";
            $data['section'] = $staff->section->name;
            $data['applicants'] = Applicant::getApprovedApplicants()->all();
            $data['checker_amount'] = $staff->section->checker_amount;
        } else {
            $data['mode'] = "CHECKER";
            $data['section'] = $staff->section->name;
            $data['applicants'] = Applicant::getApprovedApplicants()->where("camp_id", $staff->section->camp->id);
            $data['checker_amount'] = $staff->section->checker_amount;
        }

        return view('backend.group.answer.index')->with($data);
    }

    public function showOverall() {
        // Policies Check
        if (Gate::denies('view_overall_answer', Answer::class)) {
            return redirect()->route('view.backend.index')->with('status', 'backend_not_enough_permission_to_view_overall_answer');
        }

        $data['mode'] = "INSPECTOR";
        $data['applicants'] = Applicant::getApprovedApplicants()->all();

        $data['checkers'] = [];
        $sections = Section::where("has_question", true)->get();
        foreach ($sections as $section) {
            $data['checkers'][$section->name] = $section->checker_amount;
        }

        return view('backend.group.answer.index')->with($data);
    }

    public function showAnswer() {
        abort(404);
    }

}
