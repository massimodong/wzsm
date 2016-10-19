<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gate;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
	/*Index
	  */
	public function getIndex(){
		return redirect('home');
		//dunno what to do with this url
		//return view('article.index');
	}

	/*new article
	  */
	public function postIndex(Request $request){
		$article=$request->user()->articles()->create([
			'title'=>'',
			'content'=>'',
		]);
		if(Gate::allows('status',$article)){
			$article->status='accepted';
			$article->save();
		}
		return redirect('/articles/'.$article->id.'/edit');
	}

	/*show the article
	   */
	public function getId($id){
		$article=Article::findOrFail($id);

		$permit=true;
		if($article->status <> 'accepted'){
			$permit=false;
			if(Gate::allows('update',$article)) $permit=true;
		}

		if($permit === false){
			abort(401);
		}
		return view('article.read',['article'=>$article]);
	}

	/*update article
	  */
	public function putId(Request $request,$id){
		$article=Article::findOrFail($id);
		$this->authorize('update',$article);

		$article->title=$request->title;
		$article->content=$request->content;

		if(Gate::allows('status',$article)){
			$article->status=$request->status;
		}

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
