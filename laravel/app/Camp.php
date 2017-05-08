<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Camp extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function section() {
        return $this->belongsTo('App\Section');
    }

    public function applicants() {
        return $this->hasMany('App\Applicant');
    }

    private function createCountBaseSQL() {
        return DB::table('applicant_applicant_detail_key')
            ->join('applicants', 'applicants.id', '=', 'applicant_applicant_detail_key.applicant_id')
            ->join('camps', 'camps.id', '=', 'applicants.camp_id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $this->id)
            ->groupBy('camps.id');
    }

    public function getApplicantCount() {
        return $this->applicants->count();
    }

    public function getApplicantMaleCount() {
        $query = $this->createCountBaseSQL()
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "male"}')
            ->first();
        return $query != null ? $query->applicant_count : 0;
    }

    public function getApplicantFemaleCount() {
        $query = $this->createCountBaseSQL()
            ->where('applicant_detail_key_id', 'sex')
            ->where('answer', '{"value": "female"}')
            ->first();
        return $query != null ? $query->applicant_count : 0;
    }

    public function getApplicantApprovedCount() {
        $query = DB::table('camps')
            ->join('applicants', 'applicants.camp_id', '=', 'camps.id')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('camps.id', $this->id)
            ->groupBy('camps.id')
            ->whereIn('applicants.state', array('CHECKED', 'COMPLETE', 'SELECT', 'RESERVE', 'FAIL', 'CONFIRM_SELECT', 'CONFIRM_RESERVE', 'CANCEL_SELECT', 'CANCEL_RESERVE'))
            ->first();
        return $query != null ? $query->applicant_count : 0;
    }

}
