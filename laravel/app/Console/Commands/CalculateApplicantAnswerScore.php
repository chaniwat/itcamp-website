<?php

namespace App\Console\Commands;

use App\Applicant;
use App\Camp;
use App\Question;
use App\Section;
use App\SelectApplicant;
use Illuminate\Console\Command;

class CalculateApplicantAnswerScore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'score:calculate {selectCount} {reserveCount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the applicant score';

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
        $selectCount = $this->argument('selectCount');
        $reserveCount = $this->argument('reserveCount');

        $selectedApplicants = SelectApplicant::all();
        $selectedIds = $selectedApplicants->pluck('applicant_id')->all();
        $applicants = Applicant::getOnlyCompletedApplicants()->all();

        $applicantCollection = collect([]);

        foreach ($applicants as $applicant) {
            if(in_array($applicant->id, $selectedIds)) {
                $selectApplicant = $selectedApplicants->where('applicant_id', $applicant->id)->first();
                $this->info('Skipped applicant id : '.$applicant->id.
                    ' | head: '.$selectApplicant->head_score.
                    ', subhead: '.$selectApplicant->subhead_score.
                    ', recreation: '.$selectApplicant->recreation_score.
                    ', camp: '.$selectApplicant->camp_score.
                    ', total: '.array_sum($selectApplicant->only('head_score', 'subhead_score', 'recreation_score', 'camp_score')).
                    ' | subhead_no_q: '.($selectApplicant->subhead_no_q ? 'true' : 'false')
                );

                $applicantCollection->push([
                    'id' => $applicant->id,
                    'camp_id' => $applicant->camp->id,
                    'head_score' => $selectApplicant->head_score,
                    'subhead_score' => $selectApplicant->subhead_score,
                    'recreation_score' => $selectApplicant->recreation_score,
                    'camp_score' => $selectApplicant->camp_score,
                    'total_score' => array_sum($selectApplicant->only('head_score', 'subhead_score', 'recreation_score', 'camp_score')),
                    'subhead_no_q' => $selectApplicant->subhead_no_q
                ]);
            } else {
                $answers = $applicant->answers;

                // Head
                $head_score = $answers->where('question_id', 'q_head_1')->first()->staffs->first()->pivot->score;

                // Sub head
                $subhead_answer = $answers->where('question_id', 'q_head_2')->first();
                if($subhead_answer != null) {
                    $subhead_score = $subhead_answer->staffs->first()->pivot->score;
                    $subhead_no_q = false;
                } else {
                    $subhead_score = 0;
                    $subhead_no_q = true;
                }

                // Recreation
                $f_recreation_score = 0;
                foreach ($answers->where('question_id', 'q_recreation_1_f')->first()->staffs as $staff) {
                    $f_recreation_score += $staff->pivot->score;
                }
                $f_recreation_score /= Section::where('name', 'recreation')->first()->checker_amount;

                $d_recreation_score = 0;
                foreach ($answers->where('question_id', 'q_recreation_1_d')->first()->staffs as $staff) {
                    $d_recreation_score += $staff->pivot->score;
                }
                $d_recreation_score /= Section::where('name', 'recreation')->first()->checker_amount;

                $recreation_score = ($f_recreation_score + $d_recreation_score) / 2;

                // Camp
                $camp_questions = Question::where('section_id', $applicant->camp->section->id)->pluck('id')->all();
                $camp_checker_amount = $applicant->camp->section->checker_amount;
                $camp_score = 0;
                foreach ($answers->whereIn('question_id', $camp_questions) as $answer) {
                    $answer_score = 0;
                    foreach ($answer->staffs as $staff) {
                        $answer_score += $staff->pivot->score;
                    }
                    $answer_score /= $camp_checker_amount;
                    $camp_score += $answer_score;
                }

                $this->info('Calculate applicant id : '.$applicant->id.
                    ' | head: '.$head_score.
                    ', subhead: '.$subhead_score.
                    ', recreation: '.$recreation_score.
                    ', camp: '.$camp_score.
                    ', total: '.($head_score + $subhead_score + $recreation_score + $camp_score).
                    ' | subhead_no_q: '.($subhead_no_q ? 'true' : 'false')
                );

                $applicantCollection->push([
                    'id' => $applicant->id,
                    'camp_id' => $applicant->camp->id,
                    'head_score' => $head_score,
                    'subhead_score' => $subhead_score,
                    'recreation_score' => $recreation_score,
                    'camp_score' => $camp_score,
                    'total_score' => ($head_score + $subhead_score + $recreation_score + $camp_score),
                    'subhead_no_q' => $subhead_no_q
                ]);
            }
        }

        $this->info('sorting!!');

        $camps = Camp::all();
        $campIds = $camps->pluck('id')->all();
        foreach ($campIds as $campId) {
            $this->info('Selecting camp: '.__('camp.'.$camps->find($campId)->name));
            $i = 0;
            foreach ($applicantCollection->where('camp_id', $campId)->sortByDesc('total_score')->all() as $applicant) {
                if(in_array($applicant['id'], $selectedIds)) {
                    $sApplicant = $selectedApplicants->find($applicant['id']);
                } else {
                    $sApplicant = new SelectApplicant();
                    $sApplicant->applicant()->associate(Applicant::find($applicant['id']));
                }

                $sApplicant->head_score = $applicant['head_score'];
                $sApplicant->subhead_score = $applicant['subhead_score'];
                $sApplicant->recreation_score = $applicant['recreation_score'];
                $sApplicant->camp_score = $applicant['camp_score'];
                $sApplicant->subhead_no_q = $applicant['subhead_no_q'];

                if($i < $selectCount) {
                    $sApplicant->state = 'SELECT';
                    $this->info('Camp: '.$camps->find($campId)->name.' | selected | applicant id: '.$applicant["id"].', total score: '.$applicant["total_score"]);
                } else if($i < $selectCount + $reserveCount) {
                    $sApplicant->state = 'RESERVE';
                    $this->info('Camp: '.$camps->find($campId)->name.' | reserved | applicant id: '.$applicant["id"].', total score: '.$applicant["total_score"]);
                } else {
                    $sApplicant->state = 'REJECT';
                    $this->info('Camp: '.$camps->find($campId)->name.' | rejected | applicant id: '.$applicant["id"].', total score: '.$applicant["total_score"]);
                }

                $sApplicant->save();

                $i++;
            }
        }
    }
}
