<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allocate;

class HomeController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	/**
	* Show the application dashboard.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$user_id = auth()->user()->id;
		$hosteller = Allocate::where('user_id', $user_id)->first();
		// if($hosteller){
		// 	return view('home')->with('hosteller', $hosteller);
		// }
		return redirect()->route('allocate.index');
	}
}