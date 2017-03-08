<?php

namespace App\Http\Controllers\Backend;

use App\ApplicantDetailKey;
use App\Exceptions\FieldTypeNotAcceptException;
use App\Exceptions\InvalidFieldFormatException;
use App\Services\ApplicantQuestionService;
use App\Services\FormService;
use App\Services\ValidatorService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ApplicantQuestionController extends Controller
{

    /**
     * Validator Service instance
     */
    private $validator;

    /**
     * Applicant question Service instance
     */
    private $applicantQuestion;

    /**
     * Form Service instance
     */
    private $formService;

    public function __construct(ApplicantQuestionService $applicantQuestionService, ValidatorService $validatorService, FormService $formService)
    {
        $this->applicantQuestion = $applicantQuestionService;
        $this->validator = $validatorService;
        $this->formService = $formService;
    }

    /**
     * Create new applicant Question
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createQuestion(Request $request) {
        // Policies Check
        if (Gate::denies('create', ApplicantDetailKey::class)) {
            return redirect()->route('view.backend.question.applicant')->with('status', 'backend_not_enough_permission_to_create_applicant_question');
        }

        // Validation inputs
        $rules = [
            'question' => 'required',
            'field_id' => 'required|unique:applicant_detail_keys,id',
            'field_setting' => 'required'
        ];
        $this->validator->validate($request, $rules);

        if($this->validator->containError('validation.required')) {
            return redirect()->back()->with('status', 'form_empty_field')->withInput($request->all());
        } else if($this->validator->containError('validation.unique')) {
            return redirect()->back()->with('status', 'backend_applicant_question_id_already_used')->withInput($request->all());
        }

        // Create question w/ error checking
        $error = null;
        try
        {
            $this->applicantQuestion->createQuestion($request->all());
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

        return redirect()->route('view.backend.question.applicant')->with('status', 'backend_add_applicant_question_success');
    }

    /**
     * Edit the applicant Question
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateQuestion(Request $request, $id) {
        // Find question
        $question = ApplicantDetailKey::find($id);
        if (!$question) {
            return redirect()->back()->with('status', 'backend_applicant_question_not_found')->withInput($request->all());
        }

        // Policies Check
        if(Gate::denies('update', $question)) {
            return redirect()->route('view.backend.question.applicant')->with('status', 'backend_not_enough_permission_to_edit_applicant_question');
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
            $this->applicantQuestion->updateQuestion($id, $request->all());
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

        return redirect()->route('view.backend.question.applicant')->with('status', 'backend_update_applicant_question_success');
    }

    /**
     * Delete Question
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteQuestion($id) {
        // CANNOT DELETE THIS ;w;

        return response(403);
    }

    /**
     * Show view all question
     * @return $this
     */
    public function showViewQuestion() {
        return view('backend.group.question.applicant.index')->with('questions', ApplicantDetailKey::orderBy('priority', 'desc')->get());
    }

    /**
     * Show view create question
     * @return \Illuminate\Http\Response
     */
    public function showViewCreateQuestion() {
        if (Gate::denies('create', ApplicantDetailKey::class)) {
            return redirect()->route('view.backend.question.applicant')->with('status', 'backend_not_enough_permission_to_create_applicant_question');
        }

        $data = [
            'field_types' => $this->formService->getAllAvailableFieldType(),
        ];

        return view('backend.group.question.applicant.create')->with('data', $data);
    }

    /**
     * Show view update question
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function showViewUpdateQuestion($id) {
        $question = ApplicantDetailKey::find($id);

        if($question == null) {
            return redirect()->route('view.backend.question.camp')->with('status', 'backend_applicant_question_not_found');
        } else if (Gate::denies('update', $question)) {
            return redirect()->route('view.backend.question.camp')->with('status', 'backend_not_enough_permission_to_edit_applicant_question');
        }

        $data = [
            'question' => $question,
            'field_types' => $this->formService->getAllAvailableFieldType()
        ];

        return view('backend.group.question.applicant.update')->with('data', $data);
    }

}
