<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	public function hostel(){
		return $this->belongsTo('App\Hostel');
	}
}