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

    #region Foreign model

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

    #endregion

    #region Static method (counting)

    private static function createCountBaseSQL() {
        return DB::table('applicant_applicant_detail_key')
            ->select(DB::raw('count(*) as applicant_count'))
            ->where('applicant_detail_key_id', 'sex')
            ->groupBy('answer');
    }

    public static function getApplicantCount() {
        return self::all()->count();
    }

    public static function getMaleCount() {
        $query = self::createCountBaseSQL()->where('answer', '{"value": "male"}')->first();
        return $query != null ? $query->applicant_count : 0;
    }

    public static function getFemaleCount() {
        $query = self::createCountBaseSQL()->where('answer', '{"value": "female"}')->first();
        return $query != null ? $query->applicant_count : 0;
    }

    public static function getCheckedCount() {
        return self::all()->whereIn('state', array('CHECKED', 'COMPLETE', 'SELECT', 'RESERVE', 'FAIL', 'CONFIRM_SELECT', 'CONFIRM_RESERVE', 'CANCEL_SELECT', 'CANCEL_RESERVE', 'REJECT'))->count();
    }

    public static function getApprovedCount() {
        return self::all()->whereIn('state', array('CHECKED', 'COMPLETE', 'SELECT', 'RESERVE', 'FAIL', 'CONFIRM_SELECT', 'CONFIRM_RESERVE', 'CANCEL_SELECT', 'CANCEL_RESERVE'))->count();
    }

    public static function getRejectedCount() {
        return self::all()->whereIn('state', array('REJECT'))->count();
    }

    public static function getCompletedCount() {
        return self::all()->whereIn('state', array('COMPLETE', 'SELECT', 'RESERVE', 'FAIL', 'CONFIRM_SELECT', 'CONFIRM_RESERVE', 'CANCEL_SELECT', 'CANCEL_RESERVE'))->count();
    }

    public static function getSelectedCount() {
        return self::all()->whereIn('state', array('SELECT', 'CONFIRM_SELECT', 'CANCEL_SELECT'))->count();
    }

    public static function getReservedCount() {
        return self::all()->whereIn('state', array('RESERVE', 'CONFIRM_RESERVE', 'CANCEL_RESERVE'))->count();
    }

    public static function getFailedCount() {
        return self::all()->whereIn('state', array('FAIL'))->count();
    }

    #endregion

    #region Accessor & Mutator

    public function setStateAttribute($value) {
        // TODO Case checking (prerequisite or prevent)

        $this->attributes['state'] = $value;
    }

    #endregion

    #region Helper method

    public function isChecked() {
        return in_array($this->state, array('CHECKED', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL', 'CONFIRM_SELECT', 'CONFIRM_RESERVE', 'CANCEL_SELECT', 'CANCEL_RESERVE', 'REJECT'));
    }

    #endregion

}
