<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Article;
use App\Option;

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

	public function getGeneral(){
		return view('admin.general');
	}

	public function getUsers(){
		$users = User::all();
		return view('admin.users',['users'=>$users]);
	}

	public function getArticles(){
		$articles = Article::all();
		return view('admin.articles',['articles'=>$articles]);
	}

	public function putOptions(Request $request){
		$options=[
			'site_name',
			'verify_articles',
		];

		$cnt_opts=count($options);

		for($i=0;$i<$cnt_opts;$i++){
			if( isset($request[$options[$i]]) && $request[$options[$i]]<>'' ){
				Option::where('name',$options[$i])->update(['value'=>$request[$options[$i]]]);
			}
		}

		return back();
	}

}
