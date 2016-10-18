<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model{
    protected $table = 'site'; 
    public    $timestamp = true; 

    public function persons(){
    	return $this->belongsToMany('App\Person', 'site_has_person')->
    	withTimestamps();
    }

    public function priority(){
    	return $this->belongsTo('App\Priority'); 
    }
}
