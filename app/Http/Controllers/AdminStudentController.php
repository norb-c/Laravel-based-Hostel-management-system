<?php

namespace App\Http\Controllers;

use App\Allocate;
use App\Hostel;
use App\Room;
use App\User;
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
}