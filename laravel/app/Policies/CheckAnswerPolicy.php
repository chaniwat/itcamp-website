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
            $user->isStaff() && $user->section->has_question
        ) {
            return true;
        }

        return false;
    }

    /**
     * Can user check answer
     * @param User $user
     * @return bool
     */
    public function check(User $user) {
        return true;
    }

}
