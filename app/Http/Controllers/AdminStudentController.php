<?php

namespace App\Http\Controllers;

use App\Allocate;
use App\Hostel;
use App\Room;
use App\User;
use App\Notice;

use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
	public function __construct(){
		$this->middleware('auth:admin');
	}
	
	public function allStudents($id){
		
		$details = Hostel::where('id', $id)->first();
		$students  = Allocate::where('hostel_id', $id)->paginate(50);
		$no_rooms = Room::where('hostel_id', $id)->count();
		return view('admin.hostel.students')->withStudents($students)->withDetails($details)->withRumno($no_rooms);
	}
	
	public function showStudent($id){
		$std = Allocate::where('user_id', $id)->first();
		return view('admin.stdprofile')->withStd($std);
	}
	
	public function searchStudent(Request $request){
		if($request->ajax()){
			$users = User::where('name', 'like', '%'.$request->name.'%')
			->orwhere('surname', 'like', '%'.$request->name.'%')->get();
			if(count($users)){
				return response()->json($users);
			}else{
				$users = [];
				return response($users);
			}
			
		}
		return response('http');
	}
	public function notifyIndex(){
		$notices = Notice::all();
		$hostels = Hostel::all();
		return view('admin.notifications')->with([
			'notices' => $notices,
			'hostels'=> $hostels
			]);
		}
		
	public function notifyCreate(Request $request){
			$this->validate($request, [
				'title' => 'required',
				'notice' => 'required',
			]);
				
			$notice = new Notice;
			$notice->title = $request->title;
 			$notice->notice = $request->notice;
			$notice->hostel()->associate($request->hostel_id);
			$notice->administrator = $request->name;
			$notice->save();
			return redirect()->route('admin.notifyindex')->with('success', 'Successfully sent to Students');
	}
			
		public function notifyDelete($id){
			$notice = Notice::find($id)->delete();
			return redirect()->route('admin.notifyindex')->with('success', 'Successfully Deleted');
		}
	}