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
    public function before(User $user, $ability) {
        return null;
    }

    /**
     * Can current logged user update applicant state
     * @param User $user Current logged user
     * @return bool
     */
    public function update_state(User $user) {
        if(
            // Current logged user is staff
            $user->isStaff()
        ) {
            $staff = $user->staff;

            if(
                // Current user is admin or web developer or head or sub head or register
                ($staff->is_admin || in_array($staff->section->name, ['web_developer', 'head', 'sub_head', 'register']))
            ) {
                return true;
            }
        }

        return false;
    }



}
