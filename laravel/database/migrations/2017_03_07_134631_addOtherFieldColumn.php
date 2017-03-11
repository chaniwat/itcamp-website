<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherFieldColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->text('field_class')->nullable();
            $table->boolean('other')->default(false);
            $table->string('parent_id')->nullable()->default(NULL);

            $table->foreign('parent_id')
                ->references('id')->on('questions')
                ->onDelete('cascade');
        });

        Schema::table('applicant_detail_keys', function (Blueprint $table) {
            $table->text('field_class')->nullable();
            $table->boolean('other')->default(false);
            $table->string('parent_id')->nullable()->default(NULL);

            $table->foreign('parent_id')
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
        // DO NOTHING
    }
}
