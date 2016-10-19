<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('/',function(){
	return redirect('home');
});

//Home
Route::controller('/home','HomeController');

//Articles
Route::get('/articles','ArticleController@getIndex');
Route::post('/articles','ArticleController@postIndex')->middleware(['auth']);

Route::get('/articles/{id}','ArticleController@getId');
Route::put('/articles/{id}','ArticleController@putId')->middleware(['auth']);

Route::get('/articles/{id}/edit','ArticleController@getIdEdit')->middleware(['auth']);

// Authentication routes...
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('/auth/register', 'Auth\AuthController@getRegister');
Route::post('/auth/register', 'Auth\AuthController@postRegister');


//Admin
Route::controller('/admin','AdminController');
