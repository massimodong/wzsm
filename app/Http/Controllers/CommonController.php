<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
	public function redirectToHome(){
		return redirect('/home');
	}
	public function back(){
		return back();
	}
}
