<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gate;
use Auth;

use App\Article;
use App\Comment;
use App\Option;

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

		$readable=false;

		switch(Option::option('verify_articles')->value){
			case 'accept':
				$readable=$article->status === 'accepted';
				break;
			case 'reject':
				$readable=$article->status <> 'rejected';
				break;
			default:
				abort(503);
		}

		if(Gate::allows('update',$article)){
			$readable=true;
		}

		if(!$readable){
			abort(401);
		}

		$comments = $article->comments;

		return view('article.read',['article'=>$article , 'comments'=>$comments]);
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

	public function deleteId(Request $request,$id){
		$article=Article::findOrFail($id);
		$this->authorize('update',$article);

		$article->delete();

		return redirect('/home');
	}

	/*editpage
	  */
	public function getIdEdit($id){
		$article=Article::findOrFail($id);
		$this->authorize('update',$article);
		return view('article.edit',['article'=>$article]);
	}

	public function postIdComments(Request $request,$id){
		$this->validate($request,[
			'content' => 'required|min:5',
		]);

		$article = Article::findOrFail($id);
		$article->comments()->create([
			'user_id' => Auth::user()->id,
			'content' => $request->content,
		]);

		return back();
	}

	public function deleteIdComment(Request $request,$article_id,$comment_id){
		$comment=Comment::findOrFail($comment_id);
		if($comment->article->id <> $article_id){
			abort(404);
		}
		$this->authorize('update',$comment);

		$comment->delete();

		return back();
	}
}
