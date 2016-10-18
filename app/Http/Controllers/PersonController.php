<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Person; 

class PersonController extends Controller{
   public function index(Request $request){
         $persons = Person::all(); 

         foreach( $persons as $p )
            $p->sites; 
         
   		return view('persons.index',['persons' => $persons]); 
   }

   public function create(Request $request){
   		
   		$this->validate($request,[
   			'name' => 'required',
   			'telegram_id' => 'required'
   		]); 

   		$person = new Person(); 

   		$person->name = $request->name; 
   		$person->telegram_id = $request->telegram_id; 

   		$person->save(); 

   		return [ 'status' => true ]; 
   }
}
