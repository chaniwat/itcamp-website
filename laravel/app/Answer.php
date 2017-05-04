<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function applicant() {
        return $this->belongsTo('App\Applicant');
    }

    public function question() {
        return $this->belongsTo('App\Question');
    }

    public function staffs() {
        return $this->belongsToMany('App\Staff')->withPivot('score')->withTimestamps();
    }
}
