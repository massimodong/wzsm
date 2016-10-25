<?php

namespace App\Policies;

use App\User;
use App\Image;

use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
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

    public function update(User $user,Image $image){
	    return $user->id === $image->user_id;
    }
}
