<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gate;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
	public function getIndex(){
		return view('article.index');
	}
	public function postIndex(Request $request){
		$article=$request->user()->articles()->create([
			'title'=>'',
			'content'=>'',
		]);
		return redirect('/articles/'.$article->id.'/edit');
	}

	/*show the article
	   */
	public function getId($id){
		$article=Article::find($id);
		return view('article.read',['article'=>$article]);
	}

	/*update article
	  */
	public function putId(Request $request,$id){
		$article=Article::findOrFail($id);
		$this->authorize('update',$article);

		$article->title=$request->title;
		$article->content=$request->content;
		$article->save();

		return redirect('/articles/'.$article->id.'/edit');
	}

	/*editpage
	  */
	public function getIdEdit($id){
		$article=Article::findOrFail($id);
		$this->authorize('update',$article);
		return view('article.edit',['article'=>$article]);
	}
}
