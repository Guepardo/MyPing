<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Verify; 
use App\Person; 
use App\Notification; 

use Carbon\Carbon; 

class HomeController extends Controller{
	public function index(Request $request){
		return view('index'); 
	}

	public function lastVerifications(Request $request){
		$verifies = Verify::orderBy('created_at','desc')->
		take(5)->
		get(); 

		foreach($verifies as $verify){
			$verify->site;  
			$verify->verification_at = Carbon::parse($verify->created_at)->diffForHumans(Carbon::now()); 
		}

		return ['status' => true, 'msg' => $verifies]; 
	}

	public function indicators(Request $request){
		$verify_count = Verify::count(); 

		$verify_fails = Verify::where('status','404')->
		orWhere('status', '0')->
		count(); 

		$person      = Person::count();  

		$array = [ 'verify_count' => $verify_count, 
		'verify_fails' => $verify_fails, 
		'person'       => $person
		];

		return ['status' => true, 'msg' => $array]; 
	}

	public function recentFails(Request $request){
		$fails = Verify::where('status','404')->
		orWhere('status', '0')->
		orderBy('created_at', 'desc')->
		take(5)->
		get();   	

		foreach($fails as $fail)
			$fail->site;

		return ['status' => true, 'msg' => $fails]; 
	}

	public function getNotifications(Request $request){
		$notifications = Notification::orderBy('created_at', 'desc')->get(); 

		foreach($notifications as $not )
			$not->heppend_at = Carbon::parse($not->created_at)->diffForHumans(Carbon::now()); 
		

		return ['status' => true, 'msg' => $notifications]; 
	}

}
