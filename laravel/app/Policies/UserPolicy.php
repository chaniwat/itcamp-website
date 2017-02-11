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
     * Can logged user view account management (ex. view)
     * @param User $user
     * @return bool
     */
    public function view_backend(User $user) {
        if($user->isStaff()) {
            return true;
        }

        return false;
    }
}
