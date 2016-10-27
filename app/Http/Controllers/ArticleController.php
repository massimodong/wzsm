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
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s'),
		]);
		if(Gate::allows('status',$article)){
			$article->status='accepted';
			$article->save();
		}
		return redirect('/articles/'.$article->id.'/edit');
	}

	/*show the article
	   */
	public function getId(Request $request,$id){
		$article=Article::findOrFail($id);

		if(!$article->available()){
			abort(401);
		}
	
		if(!in_array($article->id , session('articles_read',[])) ){
			$article->views++;
			$article->save();
			$request->session()->push('articles_read',$article->id);
		}

		$comments = $article->comments;

		return view('article.read',['article'=>$article , 'comments'=>$comments]);
	}

	/*update article
	  */
	public function putId(Request $request,$id){
		$article=Article::findOrFail($id);
		$this->authorize('update',$article);

		$this->validate($request,[
			'top' => 'boolean',
			'image' => 'active_url',
		]);

		if( ($article->title <> $request->title)||
			($article->content <> $request->content) ){
			$article->updated_at=date('Y-m-d H:i:s');
		}

		$article->title=$request->title;
		$article->description=$request->description;
		$article->image=$request->image;
		$article->content=$request->content;

		if(Gate::allows('status',$article)){
			$article->status=$request->status;
		}

		if(Gate::allows('top',$article)){//policy not defined yet,only admin
			$article->top=$request->top;
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

	public function getIdComments($id){
		return redirect('/articles/'.$id);
	}

	public function postIdComments(Request $request,$id){
		$this->validate($request,[
			'content' => 'required|min:5',
		]);

		$article = Article::findOrFail($id);
		$comment = $article->comments()->create([
			'user_id' => Auth::user()->id,
			'content' => $request->content,
		]);

		return redirect('/articles/'.$id.'#comment'.$comment->id);
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

	public function getIdCommentsVote($article_id,$comment_id){
		return redirect('/articles/'.$article_id);
	}
	public function postIdCommentsVote($article_id,$comment_id){
		$comment=Comment::findOrFail($comment_id);
		if($comment->article->id <> $article_id){
			abort(404);
		}

		$article=Article::findOrFail($article_id);
		if(!$article->available()){
			abort(401);
		}

		//Already voted
		if($comment->voting_users()->where('id',Auth::user()->id)->count()){
			abort(401);
		}

		$comment->voting_users()->attach(Auth::user()->id);

		$comment->votes = $comment->voting_users()->count();
		$comment->save();

		return back();
	}

	public function deleteIdCommentsVote($article_id,$comment_id){
		$comment=Comment::findOrFail($comment_id);
		if($comment->article->id <> $article_id){
			abort(404);
		}

		$article=Article::findOrFail($article_id);
		if(!$article->available()){
			abort(401);
		}

		//Not voted
		if($comment->voting_users()->where('id',Auth::user()->id)->count()==0){
			abort(401);
		}

		$comment->voting_users()->detach(Auth::user()->id);

		$comment->votes = $comment->voting_users()->count();
		$comment->save();

		return back();
	}

	public function getIdVote($id){
		return redirect('/articles/'.$id);
	}

	public function postIdVote($id){
		$article=Article::findOrFail($id);

		if(!$article->available()){
			abort(401);
		}

		//Current user has voted
		if($article->voting_users()->where('id',Auth::user()->id)->count()){
			abort(401);
		}

		$article->voting_users()->attach(Auth::user()->id);

		$article->votes = $article->voting_users()->count();
		$article->save();

		return back();
	}

	public function deleteIdVote($id){
		$article=Article::findOrFail($id);

		if(!$article->available()){
			abort(401);
		}

		//Current user has NOT voted
		if($article->voting_users()->where('id',Auth::user()->id)->count()==0){
			abort(401);
		}

		$article->voting_users()->detach(Auth::user()->id);

		$article->votes = $article->voting_users()->count();
		$article->save();

		return back();
	}
}
