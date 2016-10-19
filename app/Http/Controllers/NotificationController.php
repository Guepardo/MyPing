<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Notification; 
use Carbon\Carbon; 

class NotificationController extends Controller{

   public function getNotifications(Request $request){
		$notifications = Notification::where('seen', 0)->orderBy('created_at', 'desc')->get(); 
		foreach($notifications as $not ){
			$not->heppend_at = Carbon::parse($not->created_at)->diffForHumans(Carbon::now()); 
			$not->verify->site->persons;
			$not->verify->status; 
		}
		return ['status' => true, 'msg' => $notifications]; 
	}

	public function setNotificationAsSeen(Request $request){
		$this->validate($request,[
			'id' => 'required'
		]); 

		$notification = Notification::find($request->id); 
		$notification->seen = true; 
		$notification->save(); 

		return ['status' => true ]; 
	}
}
