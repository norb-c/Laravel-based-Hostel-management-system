<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allocate extends Model
{
	public function campus(){
		return $this->belongsTo('App\Campus');
	}
	
	public function hostel(){
		return $this->belongsTo('App\Hostel');
	}
	
	public function user(){
		return $this->belongsTo('App\User');
	}
}