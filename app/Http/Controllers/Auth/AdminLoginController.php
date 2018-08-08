<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
//we need the auth facade
use Auth;

class AdminLoginController extends Controller
{	
	//only admin that are not currently logged in should have access to this
	public function __construct(){
		$this->middleware('guest:admin', ['except' => ['logout']]);
	}
	
	public function showLoginForm(){
		return view('auth.admin-login');
	}
	
	public function login(Request $request){
		//validate the form data
		$this->validate($request,[
			'email' => 'required|email',
			'password' => 'required|min:6'
		]);
			
			//attempt to log the user in
		if(Auth::guard('admin')->attempt($this->credentials($request))){
				//if succcesful attempt to redirect to their intended location
			return redirect()->intended('/admin')->with('success', 'Your are Logged in as an Administrator');
		}

			//if unsuccessful, redirect back to the login with the form data
		return $this->sendFailedLoginResponse($request);
	}

	protected function sendFailedLoginResponse(Request $request)
	{
		throw ValidationException::withMessages([
			  $this->username() => [trans('auth.failed')],
		]);
	}

		protected function credentials(Request $request)
		{
			 return $request->only($this->username(), 'password');
		}

		public function username()
		{
			 return 'email';
		}

		//logout for admin
		public function logout()
		{
			Auth::guard('admin')->logout();
			
			// $request->session()->invalidate();
			
			return redirect('/admin/login');
		}

		
	}