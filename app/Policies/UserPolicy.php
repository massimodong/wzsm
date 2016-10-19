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
    }

    public function before($user,$ability){
	    if($user->role === 'admin'){
	    	return true;
	    }
    }

    public function update(User $user,User $me){
	    return $user->id === $me->id;
    }

    public function changeRoll($user,$ability){
    	return $user->role === 'admin';
    }
}
