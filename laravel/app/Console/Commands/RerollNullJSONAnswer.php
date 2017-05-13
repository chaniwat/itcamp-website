<?php

namespace App\Console\Commands;

use App\Answer;
use App\Applicant;
use App\Question;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RerollNullJSONAnswer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'answer:fixJson';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix applicant score that json_encode is null (reroll section check)';

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
        $applicantsToFix = [];

        foreach(Answer::all() as $answer) {
            if(json_decode($answer->answer, true) == null) {
                if(!array_key_exists($answer->question->section->id, $applicantsToFix)) {
                    $applicantsToFix[$answer->question->section->id] = [];
                }

                if(!array_has($applicantsToFix[$answer->question->section->id], $answer->applicant->id)) {
                    array_push($applicantsToFix[$answer->question->section->id], $answer->applicant->id);
                }
            }
        }

        foreach($applicantsToFix as $sectionId => $applicants) {
            $this->info("Fix: section id => ".$sectionId.", applicants => [".implode(",", $applicants)."]");

            $question = Question::where("section_id", $sectionId)->pluck("id")->all();

            $bar = $this->output->createProgressBar(count($applicants));
            $bar->setFormatDefinition('custom', ' %current%/%max% -- %message%%applicantId%');
            $bar->setFormat('custom');

            foreach($applicants as $applicantId)
            {
                $bar->setMessage('Fixing applicant id => ');
                $bar->setMessage($applicantId, 'applicantId');

                DB::table('answer_staff')
                    ->join('answers', 'answers.id', '=', 'answer_staff.answer_id')
                    ->where('answers.applicant_id', $applicantId)
                    ->whereIn("answers.question_id", $question)->delete();

                DB::table('applicant_question_checks')
                    ->where('applicant_id', $applicantId)
                    ->where('section_id', $sectionId)->delete();

                $applicant = Applicant::find($applicantId);
                $applicant->state = 'CHECKED';
                $applicant->save();

                $bar->advance();
            }

            $bar->finish();

            $this->info("Done fix: section id => ".$sectionId);
        }
    }
}
