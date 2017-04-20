<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionCheck extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function applicant() {
        return $this->belongsTo('App\Applicant');
    }

    public function section() {
        return $this->belongsTo('App\Section');
    }

    public function staff() {
        return $this->belongsTo('App\Staff');
    }

}
