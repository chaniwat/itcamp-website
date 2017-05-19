<?php

namespace App\Console\Commands;

use App\Camp;
use App\RealApplicant;
use App\SelectApplicant;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GenerateUserForApplicant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'applicant:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = /** @lang text */
        'Select from select_applicants and generate applicant users';

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
        $applicants = SelectApplicant::all();

        $camps = Camp::all();
        $campIds = $camps->pluck('id')->all();

        $realApplicants = collect([]);

        $campusers = [
            "camp_app" => "appvira",
            "camp_game" => "gamepersky",
            "camp_network" => "networkton",
            "camp_iot" => "iotsecure",
            "camp_datasci" => "datascan"
        ];

        foreach($campIds as $campId) {
            $name = $campusers[$camps->find($campId)->name];

            $this->info("GENERATING camp: ".__('camp.'.$camps->find($campId)->name));

            $i = 1;
            foreach ($applicants->where('state', 'SELECT') as $applicant) {
                if($applicant->applicant->camp_id == $campId) {
                    $this->info(sprintf('SELECT applicant id : %d | %s%03d', $applicant->applicant->id, $name, $i));

                    $data = [
                        "id" => $applicant->applicant->id,
                        "select_applicant_id" => $applicant->id,
                        "camp_id" => $campId,
                        "username" => sprintf('%s%03d', $name, $i++),
                        "pname" => $applicant->applicant->getDetailValue('p_name'),
                        "fname" => $applicant->applicant->getDetailValue('f_name'),
                        "lname" => $applicant->applicant->getDetailValue('l_name'),
                        "nickname" => $applicant->applicant->getDetailValue('nickname'),
                        "school" => $applicant->applicant->getDetailValue('study_school'),
                        "state" => 'SELECT'
                    ];
                    $realApplicants->push($data);

                    $applicant = $applicant->applicant;

                    $password = implode("", explode("-", $applicant->getDetailValue('citizen_numid')));
                    $applicant->user()->associate(User::create([
                        "username" => $data["username"], "password" => Hash::make($password), "type" => "APPLICANT"
                    ]));
                    $applicant->state = "SELECT";

                    $applicant->save();
                }
            }

            foreach ($applicants->where('state', 'RESERVE') as $applicant) {
                if($applicant->applicant->camp_id == $campId) {
                    $this->info(sprintf('RESERVE applicant id : %d | %s%03d', $applicant->applicant->id, $name, $i));

                    $data = [
                        "id" => $applicant->applicant->id,
                        "select_applicant_id" => $applicant->id,
                        "camp_id" => $campId,
                        "username" => sprintf('%s%03d', $name, $i++),
                        "pname" => $applicant->applicant->getDetailValue('p_name'),
                        "fname" => $applicant->applicant->getDetailValue('f_name'),
                        "lname" => $applicant->applicant->getDetailValue('l_name'),
                        "nickname" => $applicant->applicant->getDetailValue('nickname'),
                        "school" => $applicant->applicant->getDetailValue('study_school'),
                        "state" => 'RESERVE'
                    ];
                    $realApplicants->push($data);

                    $applicant = $applicant->applicant;

                    $password = implode("", explode("-", $applicant->getDetailValue('citizen_numid')));
                    $applicant->user()->associate(User::create([
                        "username" => $data["username"], "password" => Hash::make($password), "type" => "APPLICANT", "active" => false
                    ]));
                    $applicant->state = "RESERVE";

                    $applicant->save();
                }
            }

            foreach ($applicants->where('state', 'REJECT') as $applicant) {
                $applicant = $applicant->applicant;

                $this->info(sprintf('REJECT applicant id : %d', $applicant->id));

                $applicant->state = "FAIL";
                $applicant->save();
            }
        }

        foreach ($realApplicants as $realApplicant) {
            $this->info(sprintf('Saving applicant id : %d | camp: %s | state : %s', $realApplicant['id'], $camps->find($realApplicant['camp_id'])->name, $realApplicant['state']));

            $nApplicant = new RealApplicant();
            $nApplicant->selectApplicant()->associate($applicants->find($realApplicant['select_applicant_id']));
            $nApplicant->camp = $camps->find($realApplicant['camp_id'])->name;
            $nApplicant->username = $realApplicant['username'];
            $nApplicant->pname = $realApplicant['pname'];
            $nApplicant->fname = $realApplicant['fname'];
            $nApplicant->lname = $realApplicant['lname'];
            $nApplicant->nickname = $realApplicant['nickname'];
            $nApplicant->school = $realApplicant['school'];
            $nApplicant->state = $realApplicant['state'];
            $nApplicant->save();
        }

    }

}
