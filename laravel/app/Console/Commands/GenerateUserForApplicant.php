<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        // TODO Generate username, password into users table
        // TODO insert data into real_applicants
        // TODO associate users <-> applicants
    }

}
