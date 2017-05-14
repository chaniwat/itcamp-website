<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicantEvidence extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file', 'state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function applicant() {
        return $this->belongsTo('App\Applicant');
    }

}
