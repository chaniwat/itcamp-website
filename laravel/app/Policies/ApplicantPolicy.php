<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Determined if logged user can pass to check policies (before check all policies)
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability) {
        return true;
    }
}
