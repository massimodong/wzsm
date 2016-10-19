<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function getIndex(){
		return redirect('/users/'.Auth::user()->id);
	}

	public function getId($id){
		$user = User::findOrFail($id);
		return view('users.profile',['user'=>$user]);
	}

	public function putId($id){
		$user = User::findOrFail($id);
		//todo
	}
}
