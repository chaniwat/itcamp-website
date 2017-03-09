<?php

namespace App\Policies;

use App\ApplicantDetailKey;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantQuestionPolicy
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
        if(
            // Current logged user is staff
            $user->isStaff()
        ) {
            $staff = $user->staff;

            if(
                // Current user is admin or web developer
                ($staff->is_admin || $staff->section->name == 'web_developer')
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Can logged user create new applicant question
     * @return bool
     */
    public function create() {
        return true;
    }

    /**
     * Can logged user make given applicant question
     * @return bool
     */
    public function make() {
        return true;
    }

    /**
     * Can applicant question be updated by logged user
     * @return bool
     */
    public function update() {
        return true;
    }

    /**
     * Can applicant question be deleted by logged user
     * @return bool
     */
    public function delete() {
        return true;
    }

    /**
     * Can logged user view question (ex. view)
     * @return bool
     */
    public function view() {
        return true;
    }

}
