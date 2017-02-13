<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {

            /**
             * Note:
             * Question answer - Keep value as JSON (specific by field_type of question)
             */

            $table->increments('id');
            $table->unsignedInteger('applicant_id');
            $table->string('question_id');
            $table->text('answer');

            $table->unique(['applicant_id', 'question_id']);

            $table->foreign('applicant_id')
                ->references('id')->on('applicants')->onDelete('cascade');
            $table->foreign('question_id')
                ->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answers');
    }
}
