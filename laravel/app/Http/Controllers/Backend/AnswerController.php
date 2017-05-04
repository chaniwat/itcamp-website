<?php

namespace App\Http\Controllers\Backend;

use App\Answer;
use App\Applicant;
use App\ApplicantQuestionCheck;
use App\Question;
use App\Section;
use App\Http\Controllers\Controller;
use App\Services\QuestionService;
use App\Services\ValidatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AnswerController extends Controller
{

    const SESSION_CURRENT_CHECKING_ID = 'answer.checking.id';

    /**
     * @var ValidatorService
     */
    private $validatorService;

    /**
     * @var QuestionService
     */
    private $questionService;

    /**
     * AnswerController constructor.
     * @param ValidatorService $validatorService
     * @param QuestionService $questionService
     */
    public function __construct(ValidatorService $validatorService, QuestionService $questionService) {
        $this->validatorService = $validatorService;
        $this->questionService = $questionService;
    }

    public function saveScore(Request $request) {
        if(!($currentId = session(self::SESSION_CURRENT_CHECKING_ID))) {
            return redirect()->route('view.backend.answers')->with('status', 'backend_applicant_not_selected');
        }

        $checker = Auth::user()->staff;
        $targetApplicant = Applicant::find($currentId);

        if(
            $targetApplicant->isAnswerCheckedByStaff($checker) ||
            $targetApplicant->getAnswerCheckerAmount($checker->section) >= $checker->section->checker_amount
        ) {
            return redirect()->route('view.backend.answers.check');
        }

        $questions = Question::getSectionQuestion($checker->section)->where('has_score', true);

        $rules = [];
        foreach($questions as $question) {
            $rules[$question->id.'_score'] = 'not_in:null|between:'.$question->min_score.','.$question->max_score;
        }
        $this->validatorService->validate($request, $rules);

        if($this->validatorService->containError('validation.not_in')) {
            return redirect()->back()->with(['status' => 'backend_answer_score_not_complete', 'recheck' => true])->withInput();
        } else if($this->validatorService->containError('validation.between')) {
            return redirect()->back()->with(['status', 'backend_answer_invalid_score_range', 'recheck' => true])->withInput();
        }

        $answers = $targetApplicant->answers()->whereIn('question_id', $questions->pluck('id'))->get();

        foreach ($answers as $answer) {
            $answer->staffs()->save($checker, ['score' => $request->get($answer->question_id."_score")]);
        }

        ApplicantQuestionCheck::create([
            'applicant_id' => $targetApplicant->id,
            'staff_id' => $checker->id,
            'section_id' => $checker->section->id
        ]);

        // TODO Refactor this checking for update state

        $sections = Section::whereIn("name", ['head', 'recreation', $targetApplicant->camp->section->name])->get();

        $flag = true;
        foreach($sections as $section) {
            if($targetApplicant->getAnswerCheckerAmount($section) < $section->checker_amount) {
                $flag = false;
                break;
            }
        }

        if($flag) {
            $targetApplicant->state = 'COMPLETE';
            $targetApplicant->save();
        }

        return redirect()->route('view.backend.answers.check')->with('status', 'backend_answer_check_score_saved');
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
            $data['section'] = $staff->section;
            $data['applicants'] = Applicant::getApprovedApplicants()->all();
            $data['checker_amount'] = $staff->section->checker_amount;
        } else {
            $data['mode'] = "CHECKER";
            $data['section'] = $staff->section;
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

        $data['section'] = [
            'head' => Section::where('name', 'head')->first(),
            'recreation' => Section::where('name', 'recreation')->first()
        ];

        return view('backend.group.answer.index')->with($data);
    }

    /**
     * Random a uncompleted applicant (uncheck answer) of current staff's section and show applicant's answers
     */
    public function showCheckAnswer(Request $request) {
        $checker = Auth::user()->staff;

        if(session('recheck')) {
            $randomApplicant = Applicant::find(session(self::SESSION_CURRENT_CHECKING_ID));
        } else {
            if(($randomApplicant = $this->questionService->randomUnfinishApplicant($checker)) == null) {
                return redirect()->route('view.backend.answers')->with('status', 'backend_no_applicant_to_check');
            }

            $request->session()->put(self::SESSION_CURRENT_CHECKING_ID, $randomApplicant->id);
        }

        $data = [
            "questions" => Question::getSectionQuestion($checker->section),
            "applicant" => $randomApplicant,
            "checker" => $checker
        ];

        return view('backend.group.answer.check')->with($data);
    }

}
