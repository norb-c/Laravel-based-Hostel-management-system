<?php

namespace App\Http\Controllers;

use App\Room;
use Session;
use App\Allocate;
use App\User;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class RoomController extends Controller
{
	
	public function __construct(){
		$this->middleware('auth:admin');
		$this->middleware('auth')->only(['update', 'updatephoto']);

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
			]);
			
			$room = new Room;
			
			//generate available room
			$available = 4;
			$x = ['first','second','third','fourth'];
			foreach($x as $a){
				if($request->$a){
					$available -= 1;
				}
			}
			
			$bed_arr = [
				'first' => '0',
				'second'=> '0',
				'third' => '0',
				'fourth'=> '0',
			];
			
			$bed_json = json_encode($bed_arr);
			
			
			$room->campus_id = $request->campus_id;
			$room->hostel_id = $request->hostel_id;
			$room->type 	  = $request->type;
			$room->floor	  = $request->floor;
			$room->room_no   = $request->room_no;
			$room->available = $available;
			$room->bed       = $bed_json;
			
			$room->save();
			return redirect()->route('hostels.show', $request->hostel_id)->with('success', 'Room Successfully Created');
			
		}
		
		/**
		* Display the specified resource.
		*
		* @param  \App\Room  $room
		* @return \Illuminate\Http\Response
		*/
		public function show(Room $room)
		{
			$arr = json_decode($room->bed);
			$arr2 = [];
			foreach ($arr as $key => $value) {
				if($value){
					array_push($arr2,$value);
				}
			}
			
			$occupant = Allocate::whereIn('user_id', $arr2)->get();
			return view('admin.rooms.show')->withOccupants($occupant);
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
			$data['id'] = $request->id;
			return response()->json($data);
		}
		
		public function bedUpdate(Request $request){
			
			$this->validate($request,[
				'first' => 'required',
				'second'=> 'required',
				'third' => 'required',
				'fourth'=> 'required'
				]);
				
				
				//find room by id
				$room = Room::find($request->hidden);
				//get the previous bed deatils and convert it to array
				$prev_bed = json_decode($room->bed,true);
				
				$available = 4;
				$x = ['first','second','third','fourth'];
				foreach($x as $a){
					if($request->$a){
						$available -= 1;
					}
				}
				
				$arr = [];
				$arr['first'] = $request->first;
				$arr['second'] = $request->second;
				$arr['third'] = $request->third;
				$arr['fourth'] = $request->fourth;
				
				$room->bed = json_encode($arr);
				$room->available = $available;
				$room->save();
				
				return response()->json($available);
			}
			
			
			
			/**
			* Update the specified resource in storage.
			*
			* @param  \Illuminate\Http\Request  $request
			* @param  \App\Room  $room
			* @return \Illuminate\Http\Response
			*/
			public function update(Request $request, $id)
			{
				
				$this->validate($request,[
					'name' => 'required|string|max:30',
					'surname' => 'required|string|max:30',
					'email' => 'required|email|unique:users,email,'.$id,
					'department' => 'required|string|max:50',
					'regno' => 'required|numeric|unique:users,regno,'.$id,		
					'phone' => 'required|numeric',
					'address' => 'required|string|max:255',
					'state' => 'required|string|max:30',
					'nok' => 'required|string|max:255',
					'nokno' => 'required|numeric',
					]);
					$user = User::find($id);
					
					$user->update($request->all());
					
					return back()->with('success','Updated Successfully');
				}
				
				public function updatephoto(Request $request, $id){
					$this->validate($request, [
						'passsport' => 'image|max:1999'
					]);


					$user = User::find($id);

					if($request->hasFile('passport')){

						Storage::delete('public/passport/'.$user->passport);

						$file = $request->file('passport');
						$filenameWithExt = $file->getClientOriginalName();
						$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
						$extension = $file->extension();
						$fileNameToStore = $filename.'_'.time().'.'.$extension;
						//upload image
						$path = $file->storeAs('public/passport',$fileNameToStore);
						$user->update(['passport' => $fileNameToStore]);
					}
				
					return back()->with('success','Passport Updated Successfully');
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