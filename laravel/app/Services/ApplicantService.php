<?php

namespace App\Services;

use App\Applicant;
use App\ApplicantDetailKey;
use App\Camp;
use App\Exceptions\FileMimeNotAcceptedException;
use App\Exceptions\FileSizeNotAcceptedException;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicantService
{

    private $form;
    private $file;

    function __construct(FormService $formService, FileService $fileService)
    {
        $this->form = $formService;
        $this->file = $fileService;
    }

    /**
     * Register new applicant
     * @param Request $request
     * @param $camp
     */
    public function register(Request $request, $camp)
    {
        // Get all keys
        $applicantDetailKeys = ApplicantDetailKey::all();
        $questionKeys = Question::all();

        // Get IDs
        $camp = Camp::where('name', $camp)->first();
        $applicantDetailIDs = DB::table('applicant_detail_keys')->pluck('id')->all();
        $questionIDs = DB::table('questions')->whereIn('section_id', array(2, 3, $camp->section->id))->pluck('id')->all();

        // Extract Answer
        $applicantDetailAnswers = $request->only($applicantDetailIDs);
        $questionAnswers = $request->only($questionIDs);

        // Files checking
        $this->checkFile($request, $applicantDetailKeys, $applicantDetailAnswers);
        $this->checkFile($request, $questionKeys, $questionAnswers);

        // Create Applicant
        $applicant = new Applicant();
        $applicant->camp()->associate($camp);
        $applicant->save();

        // Save answers
        $this->saveAnswers($request, $applicant, 'applicant', $applicantDetailKeys, $applicantDetailAnswers);
        $this->saveAnswers($request, $applicant, 'camp', $questionKeys, $questionAnswers);
    }

    private function checkFile(Request $request, $models, $answers)
    {
        foreach ($answers as $key => $value)
        {
            $field_type = $models->find($key)->field_type;

            if ($field_type == 'FILE' && $request->hasFile($key)) {
                $file = $request->file($key);

                if (!$this->file->checkFileMimeAccepted($models->find($key)->field_setting, $file)) {
                    throw new FileMimeNotAcceptedException();
                } else if (!$this->file->checkFileSizeAccepted($file)) {
                    throw new FileSizeNotAcceptedException();
                }
            }
        }
    }

    private function saveAnswers(Request $request, Applicant $applicant, $questionType, $keys, $answers)
    {
        $question_setting = QuestionService::QUESTION_TYPE_MAPS[$questionType];

        // Construct Applicant detail DB values
        $values = [];

        foreach ($answers as $key => $value)
        {
            $field_type = $keys->find($key)->field_type;

            // If field is 'FILE' and file is exists, storing file and generate path (value)
            if($field_type == 'FILE' && $request->hasFile($key))
            {
                $destination = json_decode($keys->find($key)->field_setting, True)['directory'];

                $value = $this->file->storeFile($request->file($key), $destination);
            }

            if($value)
            {
                $array = [];

                $array["applicant_id"] = $applicant->id;
                $array[$question_setting['key_id']] = $key;
                $array["answer"] = $this->form->formatValue($field_type, $value);

                array_push($values, $array);
            }
        }

        DB::table($question_setting['answer_table'])->insert($values);
    }

}