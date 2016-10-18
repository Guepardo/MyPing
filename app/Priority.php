<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model{
    protected $table = 'priority'; 
    public    $timestamp = true; 

    public function sites(){
    	return $this->hasMany('App\Site'); 
    }
}
