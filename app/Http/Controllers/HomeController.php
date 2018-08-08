<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allocate;
use App\Notice;

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
		if($hosteller){
			// $count = Message::where([
				// 	['user_id', '=', $user_id],
				// 	['admin', '=', 1]
				// ])->count();
				// View::share('count', $count);
				$hostel_id = $hosteller->hostel_id;
				$notices = Notice::where('hostel_id', $hostel_id)->orderBy('created_at', 'desc')->get();

				return view('home')->withNotices($notices);
			}
			return redirect()->route('allocate.index');
		}
		
		public function showProfile($id){
			if($id == auth()->user()->id){
				$student = Allocate::where('user_id', $id)->first();
				return view('student.profile')->with('student', $student);
			}else{
				return back();
			}
			
		}
		
	}