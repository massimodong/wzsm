<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
	protected $fillable = ['name' , 'value'];

	static public function option($name){
		return Option::where('name',$name)->first();
	}
}
