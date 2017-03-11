<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantDetailKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_detail_keys', function (Blueprint $table) {

            /**
             * Note:
             * Question field_setting - Keep value as JSON (specific by field_type)
             */

            $table->string('id')->primary();
            $table->text('description')->nullable();
            $table->enum('field_type', ['TEXT', 'TEXTAREA', 'PASSWORD', 'EMAIL', 'NUMBER', 'DATE', 'RADIO', 'CHECKBOX', 'SELECT', 'SELECT_MULTIPLE', 'FILE']);
            $table->text('field_setting')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('applicant_detail_keys');
    }
}
