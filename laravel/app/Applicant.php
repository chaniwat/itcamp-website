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

    public function checks() {
        return $this->hasMany('App\ApplicantQuestionCheck');
    }

    public function evidences() {
        return $this->hasMany('App\ApplicantEvidence');
    }

    public function applicantDetails() {
        return $this->belongsToMany('App\ApplicantDetailKey')->withPivot('answer');
    }

    #endregion

    #region Static method

    public static function getApprovedApplicants() {
        return self::all()->whereIn('state', array('CHECKED', 'COMPLETE', 'SELECT', 'RESERVE', 'FAIL', 'CONFIRM_SELECT', 'CONFIRM_RESERVE', 'CANCEL_SELECT', 'CANCEL_RESERVE'));
    }

    public static function getOnlyCheckedApplicants() {
        return self::all()->whereIn('state', array('CHECKED'));
    }

    public static function getOnlyCompletedApplicants() {
        return self::all()->whereIn('state', array('COMPLETE'));
    }

    public static function getOnlySelectedApplicants() {
        return self::all()->whereIn('state', array('SELECT'));
    }

    public static function getOnlyReservedApplicants() {
        return self::all()->whereIn('state', array('RESERVE'));
    }

    public static function getOnlyConfirmApplicants() {
        return self::all()->whereIn('state', array('CONFIRM_SELECT', 'CONFIRM_RESERVE'));
    }

    public static function getOnlyCancelApplicants() {
        return self::all()->whereIn('state', array('CANCEL_SELECT', 'CANCEL_RESERVE'));
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

    public function getDetailValue($key) {
        $key = $this->applicantDetails->find($key);
        $setting = json_decode($key->field_setting, True);
//        $answer = json_decode($key->pivot->answer, True)["value"];

        if(in_array($key->field_type, ['CHECKBOX', 'SELECT_MULTIPLE'])) {
            $answer = json_decode($key->pivot->answer, True)['value'];
        } else {
            $answer = str_replace('"}', '', str_replace('{"value": "', '', $key->pivot->answer));
        }

        if(in_array($key->field_type, ["TEXT", "FILE"])) {
            return $answer;
        } else if($key->field_type == "SELECT") {
            foreach ($setting["lists"] as $item) {
                if($answer == $item['key']) {
                    return $item['text'];
                }
            }
        }
    }

    public function isChecked() {
        return in_array($this->state, array('CHECKED', 'COMPLETE', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL', 'CONFIRM_SELECT', 'CONFIRM_RESERVE', 'CANCEL_SELECT', 'CANCEL_RESERVE', 'REJECT'));
    }

    public function getAnswerCheckerAmount($section) {
        if(is_string($section)) {
            $section = Section::where("name", $section)->first();
        }

        return $this->checks()->where("section_id", $section->id)->count();
    }

    public function isAnswerCheckedByStaff(Staff $checker) {
        $section = $checker->section;
        $check = $this->checks()->where("section_id", $section->id)->get();

        if ($check->count() >= 0 && $check->count() < $section->checker_amount && $check->where("staff_id", $checker->id)->first() == null) {
            return false;
        }

        return true;
    }

    public function isComplete() {
        return in_array($this->state, array('COMPLETE', 'CONFIRM', 'SELECT', 'RESERVE', 'FAIL', 'CONFIRM_SELECT', 'CONFIRM_RESERVE', 'CANCEL_SELECT', 'CANCEL_RESERVE'));
    }

    public function isSelect() {
        return in_array($this->state, array('SELECT'));
    }

    public function isReserve() {
        return in_array($this->state, array('RESERVE'));
    }

    #endregion

}
