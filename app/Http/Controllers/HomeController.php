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
			$verify->status;
			$verify->verification_at = Carbon::parse($verify->created_at)->diffForHumans(Carbon::now()); 
		}

		return ['status' => true, 'msg' => $verifies]; 
	}

	public function indicators(Request $request){
		$verify_count = Verify::count(); 

		$verify_fails = Verify::whereHas('status', function($query){
			$query->where('code', '404'); 
			$query->orWhere('code', '0'); 
		})->count(); 

		$person      = Person::count();  

		$array = [ 'verify_count' => $verify_count, 
		'verify_fails' => $verify_fails, 
		'person'       => $person
		];

		return ['status' => true, 'msg' => $array]; 
	}

	public function recentFails(Request $request){
		$fails = Verify::whereHas('status', function($query){
			$query->where('code', '404'); 
			$query->orWhere('code', '0'); 
		})->
		orderBy('created_at', 'desc')->
		take(5)->
		get(); 

		foreach($fails as $fail){
			$fail->site;
			$fail->load('status'); 
		}

		return ['status' => true, 'msg' => $fails]; 
	}
}
