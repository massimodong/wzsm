<?php

namespace App;

use App\User;
use App\Article;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['user_id','content'];
	/**
	 * Get the user that owns the comment.
	 */
	public function user(){
		return $this->belongsTo(User::class);
	}
	/**
	 * Get the article that owns the comment.
	 */
	public function article()
	{
		return $this->belongsTo(Article::class);
	}
}
