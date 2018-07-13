<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
	
	//TO GET ALL THE HOSTELS OR STUDENT IN A CAMPUS
	//GET THE CAMPUS AND FIND ALL THE HOSTELS OR STUDENT INSIDE
	public function hostels(){
		//campus has many hostels
		return $this->hasMany('App\Hostel');
	}
	
	// public function students(){
	// 	return $this->hasMany('App\User');
	// }
}