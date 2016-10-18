<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use Carbon\Carbon; 
use Telegram\Bot\Api; 


//Route group to home
Route::get('/', 'HomeController@index');
Route::group(['prefix' => 'h'], function(){
	Route::post('lastVerifications', 'HomeController@lastVerifications'); 	
	Route::post('indicators'       , 'HomeController@indicators'); 
	Route::post('recentFails'      , 'HomeController@recentFails'); 
	Route::post('getNotifications' , 'HomeController@getNotifications'); 
}); 

Route::get('/login','AuthController@index'); 


//Route group to verification
Route::get('/verification', 'VerificationController@index'); 
Route::group(['prefix' => 'v'], function(){
	Route::post('create', 'VerificationController@create'); 
}); 


//Route group to persons
Route::get('/team', 'PersonController@index'); 
Route::group(['prefix' => 'p'], function(){
	Route::post('/create', 'PersonController@create'); 
}); 