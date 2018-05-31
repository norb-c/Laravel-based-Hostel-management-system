<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		  'name','surname', 'email','regno','gender','campus_id','department',
		  'phone','state','address','nok','nokno','passport', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
	 ];
	 

	 public function campus(){
		return $this->belongsTo('App\Campus');
	 }

	 public function allocUser(){
		return $this->belongsTo('App\Allocate', 'id', 'user_id');
	}
}