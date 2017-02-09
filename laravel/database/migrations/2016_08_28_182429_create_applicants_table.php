<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {

            /**
             * Note:
             * Applicant State
             *      PENDING - Wait for review applicant form
             *      CHECKED - Complete review applicant form / ready for question check
             *      COMPLETE - Complete question check
             *      SELECT - Selected for join event
             *      RESERVE - Selected as reserve
             *      FAIL - Fail to pass in reserve or join (scoring question)
             *      REJECT - Applicant form invalid or cancel or immediately reject!
             */

            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('camp_id');
            $table->enum('state', ['PENDING', 'CHECKED', 'COMPLETE', 'SELECT', 'RESERVE', 'FAIL', 'REJECT'])->default('PENDING');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('camp_id')
                ->references('id')->on('camps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('applicants');
    }
}
