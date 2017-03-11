<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeApplicantApplicantDetailKeyPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_applicant_detail_key', function (Blueprint $table) {

            /**
             * Note:
             * Question answer - Keep value as JSON (specific by field_type of question)
             */

            $table->unsignedInteger('applicant_id');
            $table->string('applicant_detail_key_id');
            $table->text('answer');

            $table->primary(['applicant_id', 'applicant_detail_key_id'], 'applicant_detail_answer_primary');

            $table->foreign('applicant_id')
                ->references('id')->on('applicants')
                ->onDelete('cascade');
            $table->foreign('applicant_detail_key_id')
                ->references('id')->on('applicant_detail_keys')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('applicant_applicant_detail_key');
    }
}
