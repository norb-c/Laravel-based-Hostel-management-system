<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{

	
	public function hostels(){
		//user has many posts
		return $this->hasMany('App\Hostel');
	}

	public function students(){
		return $this->hasMany('App\User');
	}
}