<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{	

	protected $fillable = ['admview', 'stdview', 'replied', 'rec_del', 'sent_del'];
	public function allocate()
	{
		return $this->hasOne('App\Allocate', 'user_id', 'user_id');
	}
	
}