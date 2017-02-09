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

    // TODO comment method (what is it?)

    public function manage(User $user) {
        if($user->staff && $user->staff->is_admin) {
            return true;
        }
        return false;
    }
}
