<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return bool
     */
    public function authenticate(User $user, $email, $password)
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }
}
