<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
	protected $table = 'notice';
	
	public function hostel(){
		return $this->belongsTo('App\Hostel');
	}
}