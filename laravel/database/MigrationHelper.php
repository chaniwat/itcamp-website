<?php

namespace App\Migration\Helper;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrationHelper
{

    public static function findSectionByName($name) {
        if(!Schema::hasTable('sections'))
        {
            throw new \Exception('No sections table found. (Please run migration first)');
        }

        return DB::table('sections')->select('id')->where('name', $name)->value('id');
    }


}