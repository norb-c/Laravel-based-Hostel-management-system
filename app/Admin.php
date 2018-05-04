<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
	use Notifiable;
	//after configuring our auth in config, we define a new guard called admin
	protected $guard ='admin';
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/   
	protected $fillable = [
		//mass asignable
		'name', 'email', 'password', 'job_title'
	];
	
	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'password', 'remember_token',
	];

	//make new notification for admin to be able to send email, we ran php artisan  make:notification AdminResetPasswordNotification
	public function sendPasswordResetNotification($token)
	{
		 $this->notify(new AdminResetPasswordNotification($token));
	}
}