<?php

namespace App\Console\Commands;

use App\OldApplicant;
use App\SelectApplicant;
use Illuminate\Console\Command;

class MatchingOldApplicant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'score:old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Matching old applicant';

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
        $oldApplicants = OldApplicant::all();
        $selectApplicants = SelectApplicant::all();

        $this->info('Matching selected applicant to old applicant');
        $match_count = 0;
        foreach($selectApplicants as $applicant) {
            $fname = $applicant->applicant->getDetailValue('f_name');
            $lname = $applicant->applicant->getDetailValue('l_name');

            $match = false;
            foreach ($oldApplicants as $oldApplicant) {
                if($oldApplicant->fname == $fname && $oldApplicant->lname == $lname) {
                    $applicant->oldApplicant()->associate($oldApplicant);
                    $applicant->save();
                    $match = true;
                    break;
                }
            }

            if($match) {
                $match_count++;
                $this->warn('Applicant id: '.$applicant->applicant_id.' matched in old applicant db');
            } else {
                $this->info('Applicant id: '.$applicant->applicant_id.' not matched in old applicant db');
            }
        }
    }
}
