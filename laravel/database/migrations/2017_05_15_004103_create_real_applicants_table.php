<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('select_applicant_id');
            $table->string('camp');
            $table->string('username');
            $table->text('pname');
            $table->text('fname');
            $table->text('lname');
            $table->text('nickname');
            $table->text('school');
            $table->enum('state', ['SELECT', 'RESERVE']);

            $table->foreign('select_applicant_id')
                ->references('id')->on('select_applicants')
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
        Schema::dropIfExists('real_applicants');
    }
}
