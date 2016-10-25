<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Option;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
	public function getIndex(){
	}

	public function getArticles(Request $request){
		$articles = null;
		switch(Option::option('verify_articles')->value){
			case 'accept':
				$articles=Article::where('status','accepted');
				break;
			case 'reject':
				$articles=Article::where('status','<>','rejected');
				break;
			default:
				abort(503);
		}
		$articles = $articles->where('updated_at','<',$request->from)->orderBy('updated_at','desc')->limit(10)->get();

		return response()->json($articles);
	}
}
