<?php

namespace App\Http\Controllers;

use App\Hostel;
use App\Campus;
use App\Room;
use Illuminate\Http\Request;

class HostelController extends Controller
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
	
		$hostel = Hostel::orderBy('campus_id')->get();
		$campus = Campus::all();
		return view('admin.hostel.index')->with(
			['hostels' => $hostel, 'campuses' => $campus]);
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
			'name' => 'required',
			'campus' => 'required',
			'type' => 'required'
			]);
			
			$campus_id = Campus::find($request->campus);

			$hostels = new Hostel;
			$hostels->name = $request->name;
			$hostels->type = $request->type;
			$hostels->campus()->associate($campus_id);

			$hostels->save();
			return redirect()->route('hostels.index')->with('success', 'Hostel successfully created');
		}
		
		/**
		* Display the specified resource.
		*
		* @param  \App\Hostel  $hostel
		* @return \Illuminate\Http\Response
		*/
		public function show(Hostel $hostel)
		{
			$campus_id = $hostel->campus_id;
			$hostel_id = $hostel->id;

			$rooms = Room::where([
				['campus_id', '=', $campus_id],
				['hostel_id', '=', $hostel_id]
		  ])->orderBy('floor', 'desc')->get();
			
		  
			return view('admin.rooms.index')->withHostel($hostel)->withRooms($rooms);
		}
		
		/**
		* Show the form for editing the specified resource.
		*
		* @param  \App\Hostel  $hostel
		* @return \Illuminate\Http\Response
		*/
		public function edit(Hostel $hostel)
		{
			//
		}
		
		/**
		* Update the specified resource in storage.
		*
		* @param  \Illuminate\Http\Request  $request
		* @param  \App\Hostel  $hostel
		* @return \Illuminate\Http\Response
		*/
		public function update(Request $request, Hostel $hostel)
		{
			
		}
		
		/**
		* Remove the specified resource from storage.
		*
		* @param  \App\Hostel  $hostel
		* @return \Illuminate\Http\Response
		*/
		public function destroy(Hostel $hostel)
		{
			// $hostel->delete();
			// return redirect()->route('hostels.create')->with('success', 'Deleted successfully');
		}
	}