<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
			if(Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password])){
				//if succcesful attempt to redirect to their intended location
				return redirect()->intended(route('admin.dashboard'));
			}
			//if unsuccessful, redirect back to the login with the form data
			return redirect()->back()->withInput($request->only('email', 'remember'));
		}
		//logout for adimn
		public function logout()
		{
			Auth::guard('admin')->logout();
			
			// $request->session()->invalidate();
			
			return redirect('/');
		}
	}