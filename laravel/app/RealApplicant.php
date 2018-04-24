<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealApplicant extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'camp', 'username', 'pname', 'fname', 'lname', 'nickname', 'school', 'state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function selectApplicant() {
        return $this->belongsTo('App\SelectApplicant');
    }
}
