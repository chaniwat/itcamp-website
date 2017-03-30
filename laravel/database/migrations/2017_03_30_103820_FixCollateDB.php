<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixCollateDB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Log::info('Updating answer/applicant_detail value collation');

        DB::statement('ALTER TABLE `answers` CHANGE `answer` `answer` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;');
        DB::statement('ALTER TABLE `applicant_applicant_detail_key` CHANGE `answer` `answer` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;');

        Log::info('Updating collation complete');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
