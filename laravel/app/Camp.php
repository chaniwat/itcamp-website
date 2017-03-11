<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
