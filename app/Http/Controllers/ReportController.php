<?php

namespace App\Http\Controllers;

use App\Campus;
use App\Allocate;
use App\Hostel;
use App\Room;

use Illuminate\Http\Request;

class ReportController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
	public function index(){
		$campus = Campus::all();
		return view('admin.report.index')->withCampus($campus);
	}
	
	public function report($id){
		$students = Allocate::where('hostel_id', $id)->get();
		$details = Hostel::where('id', $id)->first();
		$rooms = Room::where('hostel_id', $id)->get();
		$roomCount = count($rooms);
		$bed_avail = 0;
		$room_avail = 0;
		$room_unavail = 0;
		foreach ($rooms as $room) {
			if($room->available > 0){
				$bed_avail += $room->available;
				$room_avail++;
			}
			if($room->available == 0){
				$room_unavail++;
			}
			
		}
		
		
		return view('admin.report.report')->with(
			['students'=>$students, 'details' => $details,
			'roomCount' => $roomCount, 'bed_avail'=> $bed_avail,
			'room_avail' =>$room_avail, 'room_unavail' =>$room_unavail]);
		}
	}