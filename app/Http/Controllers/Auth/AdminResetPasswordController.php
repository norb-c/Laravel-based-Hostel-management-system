<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
//( we are going to be loggin user in after successful reset so we need the Auth and Request)
use Illuminate\Http\Request;
//we will need the password facade
use Password;
use Auth;

class AdminResetPasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/
	
	use ResetsPasswords;
	
	/**
	* Where to redirect users after resetting their password.
	*
	* @var string
	*/
	protected $redirectTo = '/admin';
	
	/** 
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		//we dont need loggd in admin to have access to reset password
		$this->middleware('guest:admin');
	}

	//tell laravel the guard to use when logging in
	protected function guard(){
		return Auth::guard('admin');
	}
	//tell laravel to use admin broker coming from config/auth
	protected function broker(){
		return Password::broker('admins');
	}

	//shows the reset form, the request is coming from the email sent
	public function showResetForm(Request $request, $token = null)
	{
		 return view('auth.passwords.reset-admin')->with(
			  ['token' => $token, 'email' => $request->email]
		 );
	}

}