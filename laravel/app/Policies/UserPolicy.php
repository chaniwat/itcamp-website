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
     * Can logged user granted for backend management (ex. staff account, environment setting)
     * @param User $user
     * @return bool
     */
    public function view_backend(User $user) {
        if(
            $user->isStaff() &&
            (
                // Bypass admin and web developer
                ($user->staff->is_admin || $user->staff->section->name == 'web_developer')
            )
        ) {
            return true;
        }

        return false;
    }

}
