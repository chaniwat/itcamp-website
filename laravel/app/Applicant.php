<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Applicant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function camp() {
        return $this->belongsTo('App\Camp');
    }

    public function answers() {
        return $this->hasMany('App\Answer');
    }

    public function applicantDetails() {
        return $this->belongsToMany('App\ApplicantDetailKey')->withPivot('answer');
    }

    private static function createCountBaseSQL() {
        return DB::table('applicant_applicant_detail_key')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('applicant_detail_key_id', 'sex')
            ->groupBy('answer');
    }

    public static function getApplicantCount() {
        return Applicant::all()->count();
    }

    public static function getMaleCount() {
        $query = Applicant::createCountBaseSQL()->where('answer', '{"value": "male"}')->first();
        return $query != null ? $query->applicant_count : 0;
    }

    public static function getFemaleCount() {
        $query = Applicant::createCountBaseSQL()->where('answer', '{"value": "female"}')->first();
        return $query != null ? $query->applicant_count : 0;
    }

    public static function getCheckedCount() {
        return Applicant::all()->whereIn('state', array('CHECKED', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL', 'REJECT'))->count();
    }

    public static function getApprovedCount() {
        return Applicant::all()->whereIn('state', array('CHECKED', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL'))->count();
    }

}
