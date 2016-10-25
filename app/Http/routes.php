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

Route::any('/','CommonController@redirectToHome');

//Home
Route::controller('/home','HomeController');

//Articles
Route::get('/articles','ArticleController@getIndex');
Route::post('/articles','ArticleController@postIndex')->middleware(['auth']);

Route::get('/articles/{id}','ArticleController@getId');
Route::put('/articles/{id}','ArticleController@putId')->middleware(['auth']);
Route::delete('/articles/{id}','ArticleController@deleteId')->middleware(['auth']);

Route::get('/articles/{id}/edit','ArticleController@getIdEdit')->middleware(['auth']);

Route::get('articles/{id}/vote','ArticleController@getIdVote'); //redirect to the article
Route::post('articles/{id}/vote','ArticleController@postIdVote')->middleware(['auth']);
Route::delete('articles/{id}/vote','ArticleController@deleteIdVote')->middleware(['auth']);

Route::get('articles/{id}/comments','ArticleController@getIdComments'); //redirect to the article
Route::post('/articles/{id}/comments','ArticleController@postIdComments')->middleware(['auth']);
Route::delete('articles/{article_id}/comments/{comment_id}','ArticleController@deleteIdComment')->middleware(['auth']);

Route::get('articles/{article_id}/comments/{comment_id}/vote','ArticleController@getIdCommentsVote'); //redirect to the article
Route::post('articles/{article_id}/comments/{comment_id}/vote','ArticleController@postIdCommentsVote')->middleware(['auth']);
Route::delete('articles/{article_id}/comments/{comment_id}/vote','ArticleController@deleteIdCommentsVote')->middleware(['auth']);

// Authentication routes...
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('/auth/register', 'Auth\AuthController@getRegister');
Route::post('/auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmailWithCaptcha');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//Users
Route::get('/users','UserController@getIndex')->middleware(['auth']);

Route::get('/users/{id}','UserController@getId');

Route::put('/users/{id}/profile','UserController@putIdProfile')->middleware(['auth']);

//Images
Route::resource('images','ImageController');

//Admin
Route::controller('/admin','AdminController');
