<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicantDetailKey extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'description', 'field_type', 'field_setting'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
