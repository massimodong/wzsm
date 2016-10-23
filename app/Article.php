<?php

namespace App;

use Gate;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable=['title' , 'content'];

	/**
	 * Get the user that owns the article.
	 */
	public function user(){
		return $this->belongsTo(User::class);
	}

	/**
	 * Get all of the comments for the article
	 */
	public function comments(){
		return $this->hasMany(Comment::class);
	}

	/**
	 * Get the users voting this article
	 */

	public function voting_users(){
		return $this->belongsToMany('App\User','votearticles','article_id','user_id');
	}

	/**
	 * Decide if the article is available according
	 * to the settings and the current user
	 */
	public function available(){
		if(Gate::allows('update',$this)){
			return true;
		}

		switch(Option::option('verify_articles')->value){
			case 'accept':
				return $this->status === 'accepted';
			case 'reject':
				return $this->status <> 'rejected';
			default:
				abort(503);
		}
	}

}
