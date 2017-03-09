<?php

namespace App\Services;

use App\Applicant;
use App\ApplicantDetailKey;
use App\Camp;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicantService
{

    private $form;

    function __construct(FormService $formService)
    {
        $this->form = $formService;
    }

    /**
     * Register new applicant
     * @param Request $request
     * @param $camp
     * @throws \Exception
     */
    public function register(Request $request, $camp)
    {
        // TODO Validate require field

        // Extract IDs
        $camp = Camp::where('name', $camp)->first();
        $applicantDetailKeys = DB::table('applicant_detail_keys')->pluck('id')->all();
        $questionKeys = DB::table('questions')->whereIn('section_id', array(2, 3, $camp->section->id))->pluck('id')->all();

        // Extract Answer
        $applicantDetailAnswers = $request->only($applicantDetailKeys);
        $questionAnswers = $request->only($questionKeys);

        // Check file type first
        $this->checkFile($request, $applicantDetailKeys, $applicantDetailAnswers);
        $this->checkFile($request, $questionKeys, $questionAnswers);

        // Create Applicant
        $applicant = new Applicant();
        $applicant->camp()->associate($camp);
        $applicant->save();

        // Get all applicant_detail_key
        $applicantDetailKeys = ApplicantDetailKey::all();

        // Construct Applicant detail DB values
        $applicantDetailValue = $this
            ->constructDBArrayValues($request, $applicant, $applicantDetailKeys, $applicantDetailAnswers, 'applicant_detail_key_id');

//        var_dump($applicantDetailValue);
        DB::table('applicant_applicant_detail_key')->insert($applicantDetailValue);

        // Get all applicant_detail_key
        $questionKeys = Question::all();

        // Construct Applicant detail DB values
        $questionValue = $this
            ->constructDBArrayValues($request, $applicant, $questionKeys, $questionAnswers, 'question_id');

//        var_dump($questionValue);
        DB::table('answers')->insert($questionValue);
    }

    private function constructDBArrayValues(Request $request, Applicant $applicant, $models, $answers, $qKey)
    {
        // Construct Applicant detail DB values
        $arrayValue = [];

        foreach ($answers as $key => $value)
        {
            $field_type = $models->find($key)->field_type;

            if($field_type == 'FILE')
            {
                /*
                 * Upload file
                 */
                $filePath = null;
                if($request->hasFile($key)) {
                    $file = $request->file($key);
                    $jsonValue = json_decode($models->find($key)->field_setting, True);

                    if(!$this->form->isFileMimeAccept($jsonValue['acceptTypes'], $file->getMimeType())) {
                        throw new \Exception('form_invalid_file_type');
                    }

                    $destination = $jsonValue['directory'];
                    $filename = Carbon::now()->format('mdYHis').md5($file->getClientOriginalName()).".".$file->getClientOriginalExtension();
                    $file->move("storage/".$destination, $filename);

                    $value = $destination."/".$filename;
                }
            }

            if($value)
            {
                $array = [];

                $array["applicant_id"] = $applicant->id;
//                $array["applicant_id"] = 1;
                $array[$qKey] = $key;
                $array["answer"] = $this->form->constructValueTypeFormat($field_type, $value);

                array_push($arrayValue, $array);
            }
        }

        return $arrayValue;
    }

    private function checkFile(Request $request, $models, $answers)
    {
        foreach ($answers as $key => $value)
        {
            $field_type = $models->find($key)->field_type;

            if ($field_type == 'FILE') {
                /*
                 * Upload file
                 */
                $filePath = null;
                if ($request->hasFile($key)) {
                    $file = $request->file($key);
                    $jsonValue = json_decode($models->find($key)->field_setting, True);

                    if (!$this->form->isFileMimeAccept($jsonValue['acceptTypes'], $file->getMimeType())) {
                        throw new \Exception('form_invalid_file_type');
                    }
                }
            }
        }
    }

}