<?php

namespace App\Http\Controllers;

use App\Room;
use Session;

use Illuminate\Http\Request;

class RoomController extends Controller
{
	
	public function __construct(){
		$this->middleware('auth:admin');
	}
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		
	}
	
	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		
		
	}
	
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$this->validate($request, [
			'floor'	=> 'required',
			'room_no'=> 'required|unique:rooms,room_no',
			'first' 	=> 'required',
			'second' 	=> 'required',
			'third' 	=> 'required',
			'fourth' 	=> 'required'
			]);
			
			$room = new Room;
			
			$bed_arr = [
				'first' => $request->first,
				'second'=> $request->second,
				'third' => $request->third,
				'fourth'=> $request->fourth
			];
			
			$bed_json = json_encode($bed_arr);
			
			$room->campus_id = $request->campus_id;
			$room->hostel_id = $request->hostel_id;
			$room->type 	  = $request->type;
			$room->floor	  = $request->floor;
			$room->room_no   = $request->room_no;
			$room->bed       = $bed_json;
			
			$room->save();
			return redirect()->route('hostels.show', $request->hostel_id)->with('success', 'Rooms Successfully Created');
			
		}
		
		/**
		* Display the specified resource.
		*
		* @param  \App\Room  $room
		* @return \Illuminate\Http\Response
		*/
		public function show(Room $room)
		{
			//
		}
		
		/**
		* Show the form for editing the specified resource.
		*
		* @param  \App\Room  $room
		* @return \Illuminate\Http\Response
		*/
		public function edit(Room $room)
		{
			
		}
		
		public function bedEdit(Request $request){
			$room = Room::find($request->id);
			
			$data = json_decode($room->bed, true);
			$newData = $data['id'] = $request->id;
			return response()->json($data);
		}
		
		public function bedUpdate(Request $request){
			
			$this->validate($request,[
				'first' => 'required',
				'second'=> 'required',
				'third' => 'required',
				'fourth'=> 'required'	
			]);
				
				$room = Room::find($request->hidden);
				
				$bed_arr = [
					'first' => $request->first,
					'second'=> $request->second,
					'third' => $request->third,
					'fourth'=> $request->fourth
				];
				$count = 0;
				foreach ($bed_arr as $bed) {
					if($bed){
						$count += 1;
					}
				}
				
				$bed_json = json_encode($bed_arr);
				
				$room->bed = $bed_json;
				$room->save();
				return response($count);
			}
			
			
			
			/**
			* Update the specified resource in storage.
			*
			* @param  \Illuminate\Http\Request  $request
			* @param  \App\Room  $room
			* @return \Illuminate\Http\Response
			*/
			public function update(Request $request, Room $room)
			{
				//
			}
			
			/**
			* Remove the specified resource from storage.
			*
			* @param  \App\Room  $room
			* @return \Illuminate\Http\Response
			*/
			public function destroy(Room $room)
			{
				//
			}
		}