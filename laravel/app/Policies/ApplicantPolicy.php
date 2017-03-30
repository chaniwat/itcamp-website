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

    private function accountBefore(User $user) {
        if(
            // Current logged user is staff
            $user->isStaff()
        ) {
            $staff = $user->staff;

            if(
                // Current user is admin or web developer or head
            ($staff->is_admin || $staff->section->name == 'web_developer' || $staff->section->name == 'head' )
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Can logged user create new applicant account
     * @param User $user
     * @return bool
     */
    public function create_account(User $user) {
        return $this->accountBefore($user);
    }

    /**
     * Can applicant account be updated by logged user
     * @param User $user
     * @return bool
     */
    public function update_account(User $user) {
        return $this->accountBefore($user);
    }

    /**
     * Can applicant account be deleted by logged user
     * @param User $user
     * @return bool
     */
    public function delete_account(User $user) {
        return $this->accountBefore($user);
    }

    /**
     * Can logged user view applicant account
     * @param User $user
     * @return bool
     */
    public function view_account(User $user) {
        return $this->accountBefore($user);
    }

}
