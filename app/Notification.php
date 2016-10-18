<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model{
   protected $table = 'notification'; 
   public    $timestamp = true;

   public function verification(){
   		return $this->hasOne('App\Verify'); 
   }

   public function priority(){
   		return $this->belongsTo('App\Priority'); 
   }

   public function persons(){
   		return $this->belongsToMany('App\Person')->
   		withTimestamps(); 
   }
}
