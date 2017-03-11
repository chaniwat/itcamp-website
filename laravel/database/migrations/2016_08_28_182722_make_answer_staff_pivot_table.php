<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeAnswerStaffPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_staff', function (Blueprint $table) {
            $table->unsignedInteger('answer_id');
            $table->unsignedInteger('staff_id');
            $table->double('score');

            $table->primary(['answer_id', 'staff_id']);

            $table->foreign('answer_id')
                ->references('id')->on('answers');
            $table->foreign('staff_id')
                ->references('id')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answer_staff');
    }
}
