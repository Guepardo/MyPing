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
use App\Status; 
use App\Verify; 

Route::get('/teste', function(){
	// $s = Status::all(); 

	// foreach($s as $b)
	// 		$b->verifies; 

	// return $s; 

	$v = Verify::whereDoesntHave('status', function($query){
			$query->where('status.code','=', '404'); 
			$query->orWhere('status.code','=', '0'); 
		})->
		orderBy('created_at', 'desc')->
		take(5)->
		get(); 


	foreach($v as $n){
		$n->site;
		$n->load('status'); 
	}

	return $v; 
}); 

//Route group to notifications
Route::group(['prefix' => 'n'], function(){
	Route::post('getNotifications'     , 'NotificationController@getNotifications'); 
	Route::post('setNotificationAsSeen', 'NotificationController@setNotificationAsSeen'); 
}); 


//Route group to home
Route::get('/', 'HomeController@index');
Route::group(['prefix' => 'h'], function(){
	Route::post('lastVerifications', 'HomeController@lastVerifications'); 	
	Route::post('indicators'       , 'HomeController@indicators'); 
	Route::post('recentFails'      , 'HomeController@recentFails'); 
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