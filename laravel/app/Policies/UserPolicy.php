<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Staff account before
     * @param User $user current logged user
     * @return bool
     */
    public function accountStaffBefore(User $user) {
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
     * @param User $user current logged user
     * @return bool
     */
    public function create_staff_account(User $user) {
        return $this->accountStaffBefore($user);
    }

    /**
     * Can applicant account be updated by logged user
     * @param User $user current logged user
     * @return bool
     */
    public function update_staff_account(User $user) {
        return $this->accountStaffBefore($user);
    }

    /**
     * Can applicant account be deleted by logged user
     * @param User $user current logged user
     * @return bool
     */
    public function delete_staff_account(User $user) {
        return $this->accountStaffBefore($user);
    }

    /**
     * Can logged user view applicant account
     * @param User $user current logged user
     * @return bool
     */
    public function view_staff_account(User $user) {
        return $this->accountStaffBefore($user);
    }

    /**
     * Applicant account before.
     * @param User $user current logged user
     * @return bool
     */
    private function accountApplicantBefore(User $user) {
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
     * @param User $user current logged user
     * @return bool
     */
    public function create_applicant_account(User $user) {
        return $this->accountApplicantBefore($user);
    }

    /**
     * Can applicant account be updated by logged user
     * @param User $user current logged user
     * @return bool
     */
    public function update_applicant_account(User $user) {
        return $this->accountApplicantBefore($user);
    }

    /**
     * Can applicant account be deleted by logged user
     * @param User $user current logged user
     * @return bool
     */
    public function delete_applicant_account(User $user) {
        return $this->accountApplicantBefore($user);
    }

    /**
     * Can logged user view applicant account
     * @param User $user current logged user
     * @return bool
     */
    public function view_applicant_account(User $user) {
        return $this->accountApplicantBefore($user);
    }

}
