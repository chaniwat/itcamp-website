<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\FieldTypeNotAcceptException;
use App\Exceptions\InvalidFieldFormatException;
use App\Question;
use App\Section;
use App\Services\FormService;
use App\Services\QuestionService;
use App\Services\ValidatorService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    // TODO Move to QuestionService (For future use (APIs))
    // TODO Check policies (GATE)

    /**
     * Validator Service instance
     */
    private $validator;

    /**
     * Question Service instance
     */
    private $question;

    /**
     * Form Service instance
     */
    private $formService;

    public function __construct(QuestionService $questionService, ValidatorService $validatorService, FormService $formService)
    {
        $this->validator = $validatorService;
        $this->formService = $formService;
        $this->question = $questionService;
    }

    /**
     * Create new Question
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createQuestion(Request $request) {
        if (Gate::denies('create', Question::class)) {
            return redirect()->route('view.backend.question')->with('status', 'backend_not_enough_permission_to_create_question');
        }

        $error = null;
        try
        {
            $this->question->createQuestion($request->all());
        }
        catch (FieldTypeNotAcceptException $ex)
        {
            $error = 'backend_form_field_type_not_accept';
        }
        catch (InvalidFieldFormatException $ex)
        {
            $error = 'backend_incorrect_format_in_field_value';
        }

        if ($error)
        {
            return back()->with('status', $error)->withInput($request->all());
        }

        return redirect()->route('view.backend.question')->with('status', 'backend_add_question_success');
    }

    /**
     * Edit the Question
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateQuestion(Request $request, $id) {
        $question = Question::find($id);

        if($question == null) {
            return redirect()->route('view.backend.question')->with('status', 'backend_question_not_found');
        } else if(Gate::denies('update', $question)) {
            return redirect()->route('view.backend.question')->with('status', 'backend_not_enough_permission_to_edit_question');
        } else if($result = $this->checkBadQuestionDetail($request, ['question', 'field_setting'])) {
            return back()->with('status', $result)->withInput($request->all());
        }

        $this->structQuestion($question, $request);
        $question->save();

        return back()->with('status', 'backend_update_question_success');
    }

    /**
     * Delete Question
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteQuestion($id) {
        $question = Question::find($id);

        if($question == null) {
            return redirect()->route('view.backend.question')->with('status', 'backend_question_not_found');
        } else if(Gate::denies('update', $question)) {
            return redirect()->route('view.backend.question')->with('status', 'backend_not_enough_permission_to_remove_question');
        }

        Question::destroy($id);

        return redirect()->route('view.backend.question')->with('status', 'backend_remove_question_success');
    }

    public function viewQuestion() {
        // TODO Pagination

        return view('backend.group.question.index')->with('questions', Question::orderBy('priority', 'desc')->get());
    }

    public function viewCreateQuestion() {
        if (Gate::denies('create', Question::class)) {
            return redirect()->route('view.backend.question')->with('status', 'backend_not_enough_permission_to_create_question');
        }

        $data = [
            'field_types' => $this->formService->getAllAvailableFieldType(),
            'sections' => $this->getAvailableSection()
        ];

        return view('backend.group.question.create')->with('data', $data);
    }

    public function viewUpdateQuestion($id) {
        $question = Question::find($id);

        if($question == null) {
            return redirect()->route('view.backend.question')->with('status', 'backend_question_not_found');
        } else if (Gate::denies('update', $question)) {
            return redirect()->route('view.backend.question')->with('status', 'backend_not_enough_permission_to_edit_question');
        }

        $data = [
            'question' => $question,
            'field_types' => $this->formService->getAllAvailableFieldType(),
            'sections' => $this->getAvailableSection()
        ];

        return view('backend.group.question.update')->with('data', $data);
    }

    private function getAvailableSection() {
        if(Auth::guard('backend')->user()->staff->is_admin) {
            return Section::all();
        } else if(Auth::guard('backend')->user()->staff->section->name == 'knowledge') {
            return Section::where('name', 'REGEXP', '^camp_')->get();
        } else {
            return [Auth::guard('backend')->user()->staff->section];
        }
    }

}
