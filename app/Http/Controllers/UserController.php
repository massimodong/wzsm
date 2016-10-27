<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Gate;
use App\User;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function getIndex(){
		return redirect('/users/'.Auth::user()->id);
	}

	public function getId(Request $request,$id){
		$user = User::findOrFail($id);
		$articles = $user->articles;
		return view('users.index',['user'=>$user , 'articles'=>$articles]);
	}

	public function getIdEdit(Request $request,$id){
		$user = User::findOrFail($id);
		$this->authorize('update' , $user);

		return view('users.edit',['user'=>$user]);
	}

	public function putIdProfile(Request $request,$id){
		$user = User::findOrFail($id);
		$this->authorize('update' , $user);

		$user->fullname=$request->fullname;
		$user->description=$request->description;

		if(isset($request->name) && $request->name <> '' && $request->name <> $user->name){
			$this->validate($request,[
					'name' => 'required|min:3|max:255|unique:users,name',
			]);
			$user->name = $request->name;
		}
		
		if(isset($request->password) && $request->password <> ''){
			$this->validate($request,[
				'password' => 'required|confirmed|min:6',
			]);
			$user->password = bcrypt($request->password);
		}

		if(Gate::allows('changeRole' , $user)){
			$user->role = $request->role;
		}

		$user->save();

		return back();
	}
}
