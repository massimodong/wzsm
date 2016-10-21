<?php

namespace App\Policies;

use App\User;
use App\Option;
use Illuminate\Auth\Access\HandlesAuthorization;

class OptionPolicy
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

    public function before($user,$ability){
    	if($user->role === 'admin'){
		return true;
	}
    }

    public function update(User $user,Option $option){
	    return $user->role === 'admin';
    }
}
