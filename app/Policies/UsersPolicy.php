<?php

namespace App\Policies;

use App\User;
use App\Template;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage the module.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function manage(User $user)
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can manage the module.
     *
     * @param  \App\User $user
     * @param User $userToEdit
     * @return mixed
     */
    public function manageUser(User $user, $userToEdit)
    {
        return $user->isSuperAdmin() || $user->id == $userToEdit;
    }
}
