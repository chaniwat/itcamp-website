<?php

namespace App\Console\Commands;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class PublishApplicantCampCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:applicant';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish applicant data into excel';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $applicants = Applicant::whereIn('state', array('SELECT', 'RESERVE'))->get();

        $keys = ['p_name', 'f_name', 'l_name', 'nickname', 'birthday', 'sex', 'religion', 'facebook_url',
            'study_current_grade', 'study_plan', 'study_school_province', 'a_foodallergy', 'a_congenitaldisease', 'a_pillsallergy',
            'a_knowitcampfrom', 'a_purposeofthis', 'a_pastcamp', 'a_campexplain'];

        $questions = ['q_recreation_1_f', 'q_recreation_1_d'];

        Excel::create('itcamp13_applicants_'.Carbon::now()->format('mdYHis'), function($excel) use ($applicants, $keys, $questions) {

            $excel->sheet('Applicants', function($sheet) use ($applicants, $keys, $questions) {

                $sheet->row(1, array_merge(['id'], $keys, $questions));

                $i = 2;
                foreach ($applicants as $applicant) {

                    $keys_answers = [];
                    foreach ($keys as $key) {
                        if(($value = $applicant->getDetailValue($key)) != null) {
                            array_push($keys_answers, $applicant->getDetailValue($key));
                        } else {
                            array_push($keys_answers, "-");
                        }
                    }

                    $questions_answers = [];
                    foreach ($questions as $question) {
                        if(($value = $applicant->getAnswerValue($question)) != null) {
                            if($question == 'q_recreation_1_f') {
                                array_push($questions_answers, 'http://itcamp.in.th/13/storage/'.$applicant->getAnswerValue($question));
                            } else {
                                array_push($questions_answers, $applicant->getAnswerValue($question));
                            }
                        } else {
                            array_push($questions_answers, "-");
                        }
                    }

                    $sheet->row($i++, array_merge([$applicant->id], $keys_answers, $questions_answers));
                }

            });

        })->store('xlsx', storage_path('excel/exports'));;

    }
}
