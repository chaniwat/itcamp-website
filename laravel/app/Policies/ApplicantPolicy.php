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
        return true;
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
                // Current user is admin or web developer or head
                ($staff->is_admin || $staff->section->name == 'web_developer' || $staff->section->name == 'head' || $staff->section->name == 'register' )
            ) {
                return true;
            }
        }

        return false;
    }



}
