<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\AllocatsSendEmail;
use App\Allocate;
use App\User;
use App\Room;
use App\Hostel;


class AllocateController extends Controller
{
	
	public function __construct(){
		$this->middleware('auth');
	}
	
	public function index(){
		$std_id = auth()->user()->id;
		$std = User::find($std_id);
		
		//find available hostel by campus and gender 
		$availables = Room::where([
			['type', '=', $std->gender],
			['campus_id', '=', $std->campus_id],
			])->groupBy('hostel_id')->having('available', '>', 0)->get();
		return view('student.allocate')->withStudent($std)->withAvailables($availables);
			
	}
		
		
	public function getRooms(Request $request){
		$type = $request->type;
		$campus_id = $request->campus_id;
		$hostel_id  = $request->hostel_id;
		$floor = $request->floor;
		
		$rooms = Room::where([
			['campus_id', '=', $campus_id],
			['hostel_id', '=', $hostel_id],
			['floor', '=', $floor],
			['type', '=', $type],
			['available', '>', 0]
			])->orderBy('room_no', 'asc')->pluck('room_no');

		return response()->json($rooms);
	}
			
	public function getBed(Request $request){
		$type = $request->type;
		$campus_id = $request->campus_id;
		$hostel_id  = $request->hostel_id;
		$floor = $request->floor;
		$room_no = $request->room_no;
		
		$bed = Room::where([
			['campus_id', '=', $campus_id],
			['hostel_id', '=', $hostel_id],
			['floor', '=', $floor],
			['type', '=', $type],
			['room_no', '=', $room_no],
			['available', '>', 0]
			])->first();
			$space = json_decode($bed->bed);

		return response()->json($space);
	}
				
	public function check(Request $request){
		$type = $request->type;
		$campus_id = $request->campus_id;
		$hostel_id  = $request->hostel_id;
		$floor = $request->floor;
		$space = $request->space;
		$room_no = $request->room_no;
		
		$bedrow = Room::where([
			['campus_id', '=', $campus_id],
			['hostel_id', '=', $hostel_id],
			['type', '=', $type],
			['floor', '=', $floor],
			['room_no', '=', $room_no],
			['available', '>', 0]
			])->first();
		
		$bedarr = json_decode($bedrow->bed);
		$spac = '';
		foreach ($bedarr as $key => $value) {
			if($key == $space){
				$spac = $value;
			}
		}
		return response()->json($spac);
	}


	public function allocate(Request $request){

		$allocate = new Allocate;
		
		$allocate->type = $request->type;
		$allocate->floor = $request->floor;
		$allocate->room_no = $request->room_no;
		$allocate->bed = $request->space;
		$allocate->receipt = $request->receipt;
		$user_id = auth()->user()->id;

		$allocate->user()->associate($user_id);
		$allocate->campus()->associate($request->campus_id);
		$allocate->hostel()->associate($request->hostel_id);
		$allocate->save();

		//updating the rooms table, bed colum with user_id

		$bedrow = Room::where([
			['campus_id', '=', $request->campus_id],
			['hostel_id', '=', $request->hostel_id],
			['type', '=', $request->type],
			['floor', '=', $request->floor],
			['room_no', '=', $request->room_no],
			['available', '>', 0]
			])->first();

		//space the user chooses	
		$space = $request->space;

		$oldbed = json_decode($bedrow->bed);
		$newbed = array();


		//inserts the user_id to the space he chooses
		foreach ($oldbed as $key => $value) {
			if($key == $space){
				$newbed[$key] = $user_id;
			}else{
				$newbed[$key] = $value;
			}
		}
		$bed_json = json_encode($newbed);
		$bedrow->decrement('available', 1, ['bed' => $bed_json]);

		// send email
		$mail = Allocate::where('user_id', $user_id)->first();
		
		//queues the email for sending in background
		AllocatsSendEmail::dispatch($mail);

		return response()->json('');
	}
}