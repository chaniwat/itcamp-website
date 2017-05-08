<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $rememberTokenName = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isStaff()
    {
        return $this->type == 'STAFF';
    }

    public function isApplicant()
    {
        return $this->type == 'APPLICANT';
    }

    public function staff() {
        return $this->hasOne('App\Staff');
    }

    public function applicant() {
        return $this->hasOne('App\Applicant');
    }

    public function getIsAdminAttribute()
    {
        if($this->isStaff() && ($this->staff->is_admin || in_array($this->staff->section->name, ['web_developer', 'head']))) {
            return true;
        }

        return false;
    }

}
