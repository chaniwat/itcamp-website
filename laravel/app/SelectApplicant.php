<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectApplicant extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'head_score', 'subhead_score', 'recreation_score', 'camp_score', 'subhead_no_q', 'state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function isOldApplicant() {
        return isset($this->old_applicant_id);
    }

    public function oldApplicant() {
        return $this->belongsTo('App\OldApplicant');
    }

    public function applicant() {
        return $this->belongsTo('App\Applicant');
    }
}
