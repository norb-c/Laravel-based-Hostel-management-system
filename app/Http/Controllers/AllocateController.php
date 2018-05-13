<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
		
		//find hostel by campus and gender
		$hostel = Hostel::where([
			['type', '=', $std->gender],
			['campus_id', '=', $std->campus_id]
			])->get();
			
			return view('student.allocate')->withStudent($std)->withHostels($hostel);
			
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
			}