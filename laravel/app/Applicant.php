<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
