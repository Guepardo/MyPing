<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verify extends Model{
    protected $table = 'verify'; 
    public    $timestamp = true;

    public function status(){
    	return $this->belongsTo('App\Status'); 
    }

    public function site(){
    	return $this->belongsTo('App\Site'); 
    }

    public function notification(){
    	return $this->belongsTo('App\Notification'); 
    }

}
