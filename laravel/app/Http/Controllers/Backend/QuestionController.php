<?php

namespace App\Http\Controllers\Backend;

use App\Question;
use App\Section;
use App\Utility\FormUtility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    //

    /**
     * Create new Question
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createQuestion(Request $request) {
        if (Gate::denies('create', Question::class)) {
            return redirect()->route('view.backend.question')->with('status', 'backend_not_enough_permission_to_create_question');
        } else if($result = $this->checkBadQuestionDetail($request, ['question', 'id', 'field_setting'])) {
            return back()->with('status', $result)->withInput($request->all());
        }

        $question = new Question();
        $question->id = $request->input('id');
        $this->structQuestion($question, $request);
        $question->save();

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
     * Check for any bad logic for Question
     * @param Request $request
     * @param $requireFields
     * @return bool|string
     */
    private function checkBadQuestionDetail(Request $request, $requireFields) {
        $section = Section::find($request->input('section'));
        if (!$request->has($requireFields)) {
            return 'form_empty_field';
        } else if(!$section->has_question) {
            return 'backend_camp_not_have_question';
        } else if(!in_array($request->input('field_type'), FormUtility::acceptField)) {
            return 'backend_form_field_type_not_accept';
        } else if(!FormUtility::checkSettingTypeFormat($request->input('field_type'), $request->input('field_value'))) {
            return 'backend_incorrect_format_in_field_value';
        }
        return false;
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
            'field_types' => FormUtility::acceptField,
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
            'field_types' => FormUtility::acceptField,
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

    private function structQuestion(Question $question, Request $request) {
        $question->question = $request->input('question');
        $question->description = $request->input('description');
        $question->section()->associate(Section::find($request->input('section')));
        $question->priority = $request->input('priority');
        $question->field_type = $request->input('field_type');
        $question->field_setting = $request->input('setting');
    }

}
