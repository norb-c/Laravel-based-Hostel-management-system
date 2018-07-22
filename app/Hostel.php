<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
	public function campus(){
		return $this->belongsTo('App\Campus');
	}
		public function rooms(){
		//hostel has many rooms
		return $this->hasMany('App\Room');
	}
}