<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Article;
use App\Comment;
use App\Image;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','fullname', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get all of the article for the user.
     */
    public function articles(){
	    return $this->hasMany(Article::class);
    }

    /**
     *Get all of the comments for the user
     */
    public function comments(){
	    return $this->hasMany(Comment::class);
    }

    /**
     * get the articles the user had voted
     */
    public function voted_articles(){
	    return $this->belongsToMany('App\Article','votearticles','user_id','article_id');
    }

    /**
     * get comments the user had voted
     */
    public function voted_comments(){
	    return $this->belongsToMany('App\Comment','votecomments','user_id','comment_id');
    }

    /**
     * Get all of the images for the users
     */
    public function images(){
	    return $this->hasMany(Image::class);
    }

    /**
     * Get gravatar url
     */
    public function gravatar(){
	    return "https://gravatar.com/avatar/".md5( strtolower( trim( $this->email ) ) );
    }
}
