<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{	
	public function allocate()
	{
		return $this->hasOne('App\Allocate', 'user_id', 'user_id');
	}
	
}