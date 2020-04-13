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
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * *Policy to check if the user is authorized to edit his/her profile
     *
     */
    public function edit(User $currentUser, User $user)
    {
        return $currentUser->is($user);
    }
}
