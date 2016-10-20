<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Article;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
		$this->middleware('admin');
	}

	public function getIndex(){
		return view('admin.index');
	}

	public function getUsers(){
		$users = User::all();
		return view('admin.users',['users'=>$users]);
	}

	public function getArticles(){
		$articles = Article::all();
		return view('admin.articles',['articles'=>$articles]);
	}

}
