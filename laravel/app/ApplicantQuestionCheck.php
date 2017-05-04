<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicantQuestionCheck extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'applicant_id', 'section_id', 'staff_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
