<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreApplicantState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE applicants 
                  CHANGE COLUMN state state 
                  ENUM('PENDING','CHECKED','COMPLETE','SELECT','RESERVE','FAIL',
                  'CONFIRM_SELECT','CONFIRM_RESERVE','CANCEL_SELECT','CANCEL_RESERVE','REJECT')
                  DEFAULT 'PENDING' NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DO nothing
    }
}
