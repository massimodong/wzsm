<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function getIndex(){
		$articles=Article::where('status','accepted')->get();
		return view('home',['articles'=>$articles]);
	}
}
