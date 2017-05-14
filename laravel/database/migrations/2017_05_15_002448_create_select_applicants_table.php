<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('select_applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('applicant_id');
            $table->double('head_score');
            $table->double('subhead_score');
            $table->double('recreation_score');
            $table->double('camp_score');
            $table->boolean('subhead_no_q');
            $table->unsignedInteger('old_applicant_id')->nullable();

            $table->foreign('applicant_id')
                ->references('id')->on('applicants')
                ->onDelete('cascade');
            $table->foreign('old_applicant_id')
                ->references('id')->on('old_applicants')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('select_applicants');
    }
}
