<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
	/**
	* Handle an incoming request.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \Closure  $next
	* @param  string|null  $guard
	* @return mixed
	*/
	public function handle($request, Closure $next, $guard = null)
	{ 
		switch ($guard) {
			case 'admin':
			//check id the person is an admin
			if(Auth::guard($guard)->check()){
				return redirect()->route('admin.dashboard');
			}
			break;
			default:
			//check if its a normal user
			if (Auth::guard($guard)->check()) {
				return redirect('/home');
			}
			break;
		}		
		return $next($request);
	}
}