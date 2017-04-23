<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckAnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
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

            if (
                // Current logged user is admin
                $staff->is_admin ||
                // Current logged user's section has question
                $staff->section->has_question ||
                // Current user is web developer or knowledge
                $staff->section->name == 'web_developer' || $staff->section->name == 'knowledge'
            ) {
                return null;
            }
        }

        return false;
    }

    /**
     * Can user check answer
     * @param User $user
     * @return bool
     */
    public function view_check_answer(User $user) {
        return true;
    }

    /**
     * Can current user view overall of answer checking
     * @param User $user
     * @return bool
     */
    public function view_overall_answer(User $user) {
        $staff = $user->staff;

        if(
            // Current user is admin or web developer or head or knowledge
            ($staff->is_admin || $staff->section->name == 'web_developer' || $staff->section->name == 'head' || $staff->section->name == 'knowledge')
        ) {
            return true;
        }

        return false;
    }

}
