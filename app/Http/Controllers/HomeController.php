<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Option;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function about(){
		return view('about');
	}
	public function getIndex(){
		$articles=null;
		switch(Option::option('verify_articles')->value){
			case 'accept':
				$articles=Article::where('status','accepted')->where('top',true)->get();
				break;
			case 'reject':
				$articles=Article::where('status','<>','rejected')->where('top',true)->get();
				break;
			default:
				abort(503);
		}

		return view('home',['articles'=>$articles]);
	}
}
