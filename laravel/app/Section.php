<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'has_question', 'is_camp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function staffs() {
        return $this->hasMany('App\Staff');
    }

    public function camp() {
        return $this->hasOne('App\Camp');
    }

    public function questions() {
        return $this->hasMany('App\Question');
    }
}
