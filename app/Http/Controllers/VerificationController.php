<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Site; 
use App\Person; 
use App\Priority; 

use Carbon\Carbon; 

class VerificationController extends Controller{
    
    public function index(Request $request){
    	$sites      = Site::all();
    	$persons    = Person::all(); 
    	$priorities = Priority::all(); 
    	
    	// dd($sites); 	

        foreach($sites as $s){
            $s->priority; 

            $diff = Carbon::parse($s->last_seen)->addMinutes($s->priority->value)->diffForHumans(); 

            $s->next_verification = $diff; 
        }
    	
    	return view('sites.index', ['sites' => $sites, 'persons' => $persons, 'priorities' => $priorities]);  
    }


    public function create(Request $request){    	
    	$this->validate($request,[
    		'label' => 'required', 
    		'url'   => 'required', 
            'persons_id' => 'required', 
    		'priority_id' => 'required'
    	]); 

    	$site = new Site(); 

    	$site->label       = $request->label; 
    	$site->url         = $request->url; 
    	$site->priority_id = $request->priority_id; 
        $site->save(); 

        $site->persons()->attach($request->persons_id); 
    	
        return ['status' => true ]; 
    }

    public function delete($id){
        $site = Site::find($id); 

        if(empty($site))
            return redirect('/verification')->with('status', 'This id doesnot exists'); 

        if( count($site->persons) > 0 )
            return redirect('/verification')->with('status', 'This site has relation with some persons'); 

        $site->delete(); 

        return redirect('/verification')->with('status', 'Successful'); 
    }
}
