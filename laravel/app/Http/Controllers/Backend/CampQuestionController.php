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

class CampQuestionController extends Controller
{

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
        // Policies Check
        if (Gate::denies('create', Question::class)) {
            return redirect()->route('view.backend.question.camp')->with('status', 'backend_not_enough_permission_to_create_question');
        }

        // Validation inputs
        $rules = [
            'question' => 'required',
            'field_id' => 'required|unique:questions,id',
            'field_setting' => 'required'
        ];
        $this->validator->validate($request, $rules);

        if($this->validator->containError('validation.required')) {
            return redirect()->back()->with('status', 'form_empty_field')->withInput($request->all());
        } else if($this->validator->containError('validation.unique')) {
            return redirect()->back()->with('status', 'backend_question_id_already_used')->withInput($request->all());
        }

        // Create question w/ error checking
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

        return redirect()->route('view.backend.question.camp')->with('status', 'backend_add_question_success');
    }

    /**
     * Edit the Question
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateQuestion(Request $request, $id) {
        // Find question
        $question = Question::find($id);
        if (!$question) {
            return redirect()->back()->with('status', 'backend_question_not_found')->withInput($request->all());
        }

        // Policies Check
        if(Gate::denies('update', $question)) {
            return redirect()->route('view.backend.question.camp')->with('status', 'backend_not_enough_permission_to_edit_question');
        }

        // Validation inputs
        $rules = [
            'question' => 'required',
            'field_setting' => 'required'
        ];
        $this->validator->validate($request, $rules);

        if($this->validator->containError('validation.required')) {
            return redirect()->back()->with('status', 'form_empty_field')->withInput($request->all());
        }

        // Create question w/ error checking
        $error = null;
        try
        {
            $this->question->updateQuestion($id, $request->all());
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

        return redirect()->route('view.backend.question.camp')->with('status', 'backend_update_question_success');
    }

    /**
     * Delete Question
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteQuestion($id) {
        // Find question
        $question = Question::find($id);
        if (!$question) {
            return redirect()->route('view.backend.question.camp')->with('status', 'backend_question_not_found');
        }

        // Policies Check
        if(Gate::denies('update', $question)) {
            return redirect()->route('view.backend.question.camp')->with('status', 'backend_not_enough_permission_to_remove_question');
        }

        $this->question->deleteQuestion($id);

        return redirect()->route('view.backend.question.camp')->with('status', 'backend_remove_question_success');
    }

    /**
     * Show view all question
     * @return $this
     */
    public function showViewQuestion() {
        return view('backend.group.question.camp.index')->with('questions', Question::orderBy('priority', 'desc')->get());
    }

    /**
     * Show view create question
     * @return \Illuminate\Http\Response
     */
    public function showViewCreateQuestion() {
        if (Gate::denies('create', Question::class)) {
            return redirect()->route('view.backend.question.camp')->with('status', 'backend_not_enough_permission_to_create_question');
        }

        $data = [
            'field_types' => $this->formService->getAllAvailableFieldType(),
            'sections' => $this->getAvailableSection()
        ];

        return view('backend.group.question.camp.create')->with('data', $data);
    }

    /**
     * Show view update question
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function showViewUpdateQuestion($id) {
        $question = Question::find($id);

        if($question == null) {
            return redirect()->route('view.backend.question.camp')->with('status', 'backend_question_not_found');
        } else if (Gate::denies('update', $question)) {
            return redirect()->route('view.backend.question.camp')->with('status', 'backend_not_enough_permission_to_edit_question');
        }

        $data = [
            'question' => $question,
            'field_types' => $this->formService->getAllAvailableFieldType(),
            'sections' => $this->getAvailableSection()
        ];

        return view('backend.group.question.camp.update')->with('data', $data);
    }

    /**
     * Get the available section selection of current logged user (Policies)
     * @return mixed
     */
    private function getAvailableSection() {
        // TODO [OPTIONAL] change this in future :S
        if(Auth::guard('backend')->user()->staff->is_admin) {
            return Section::all();
        } else if(Auth::guard('backend')->user()->staff->section->name == 'knowledge') {
            return Section::where('name', 'REGEXP', '^camp_')->get();
        } else {
            return [Auth::guard('backend')->user()->staff->section];
        }
    }

}
