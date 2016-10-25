<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $fillable = ['name'];


	/**
	 * Get the user the owns the image
	 */
	public function user(){
		return $this->belongsTo(User::class);
	}

	/**
	 * Get the storing path of this image
	 */

	public function getPath(){
		return '/'.$this->user_id.'/'.$this->name;
	}

	/**
	 * Get the url of this image
	 */

	public function getUrl(){
		return env('IMAGES_BASEURL').$this->getPath();
	}
}
