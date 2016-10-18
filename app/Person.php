<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model{
    protected $table     = 'person'; 
    public    $timestamp = true; 

    public function sites(){
    	return $this->belongsToMany('App\Site', 'site_has_person')->
    	withTimestamps();
    }
}
