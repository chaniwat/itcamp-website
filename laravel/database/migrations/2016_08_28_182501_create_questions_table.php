<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {

            /**
             * Note:
             * Question field_setting - Keep value as JSON (specific by field_type)
             */

            $table->string('id')->primary();
            $table->unsignedInteger('section_id');
            $table->integer('priority')->default(0);
            $table->text('question');
            $table->text('description')->nullable();
            $table->enum('field_type', ['TEXT', 'TEXTAREA', 'PASSWORD', 'EMAIL', 'NUMBER', 'DATE', 'RADIO', 'CHECKBOX', 'SELECT', 'SELECT_MULTIPLE', 'FILE']);
            $table->text('field_setting')->nullable();

            $table->foreign('section_id')
                ->references('id')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
