<?php

namespace App\Services\View;

use App\Answer;
use App\Applicant;
use App\ApplicantDetailKey;
use App\Question;
use App\Services\FormService;

class FormBuilderService
{

    const FRONTEND_TEMPLATE_DIR = 'vendor/form_builder/frontend/';
    const BACKEND_TEMPLATE_DIR = 'vendor/form_builder/backend/';

    /**
     * @param Question|ApplicantDetailKey $question Input field
     * @return mixed
     */
    public function buildFrontInputField($question)
    {
        $data = [
            'field_id' => $question->id,
            'field_type' => strtolower($question->field_type),
            'field_class' => $question->field_class,
            'title' => $question->question,
            'description' => in_array('show-description', explode(' ', $question->field_class)) ? $question->description : '',
            'require' => $question->require,
            'hideTitle' => in_array('hide-title', explode(' ', $question->field_class)),
        ];

        if(in_array($question->field_type, ['CHECKBOX', 'RADIO', 'SELECT', 'SELECT_MULTIPLE'])) {
            $data['lists'] = json_decode($question->field_setting, True)['lists'];
        }

        if($question->parent)
        {
            $data['parent_id'] = $question->parent->id;
        }
        else
        {
            $data['parent_id'] = null;
        }

        return view(FormBuilderService::FRONTEND_TEMPLATE_DIR.strtolower($data['field_type']))->with($data);
    }

    public function buildBackendInputField($question, Applicant $answerer, $mode)
    {
        $data = [
            'field_id' => $question->id,
            'field_type' => strtolower($question->field_type),
            'field_class' => $question->field_class,
            'title' => $question->question,
            'description' => '',
            'require' => $question->require,
            'hideTitle' => in_array('hide-title', explode(' ', $question->field_class)),
        ];

        if($mode == ApplicantDetailKey::class) {
            $answers = $answerer->applicantDetails;
            $answerKey = $answers->find($question->id);
        } else if($mode == Answer::class) {
            $answers = $answerer->answers;
            $answerKey = $answers->where('question_id', $question->id)->first();
        }

        if($answerKey)
        {
//            if($mode == ApplicantDetailKey::class) {
//                $data['value'] = json_decode($answerKey->pivot->answer, True)['value'];
//            } else if($mode == Answer::class) {
//                $data['value'] = json_decode($answerKey->answer, True)['value'];
//            }
            if($mode == ApplicantDetailKey::class) {
                $data['value'] = str_replace('"}', '', str_replace('{"value": "', '', $answerKey->pivot->answer));
            } else if($mode == Answer::class) {
                $data['value'] = str_replace('"}', '', str_replace('{"value": "', '', $answerKey->answer));
            }
        }
        else
        {
            if(in_array($question->field_type, ['CHECKBOX', 'SELECT_MULTIPLE'])) {
                $data['value'] = [];
            } else {
                $data['value'] = '';
            }
        }

        if(in_array($question->field_type, ['CHECKBOX', 'RADIO', 'SELECT', 'SELECT_MULTIPLE']))
        {
            $data['lists'] = json_decode($question->field_setting, True)['lists'];
        }

        return view(FormBuilderService::BACKEND_TEMPLATE_DIR.strtolower($data['field_type']))->with($data);
    }

}