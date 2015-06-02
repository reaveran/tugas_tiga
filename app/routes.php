<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::resource('comments', 'CommentsController');
Route::resource('articles', 'ArticlesController');
Route::get('/', function()
{
	return View::make('hello');
});

Route::post('articles/import', "ArticlesController@importUserList");
Route::post('articles/download', "ArticlesController@download");
Route::post('articles/download2', "ArticlesController@download2");
