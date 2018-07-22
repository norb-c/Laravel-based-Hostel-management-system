<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class StudentMessageController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	
	
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function stdStore(Request $request)
	{
	$this->validate($request, [
		'message' => 'required|max:140',
		]);
		$message = new Message;
		$message->user_id = $request->user_id;
		$message->message = $request->message;
		$message->student = 1;
		$message->admin = 0;
		
		$message->save();
	
	$sentmsg = Message::where([
		['user_id', '=', auth()->user()->id],
		['student', '=', 1]
	])->orderBy('created_at', 'desc')->first();
		
		return response()->json($sentmsg);
	}
	
	/**
	* Display the specified resource.
	*
	* @param  \App\StudentMessage  $studentMessage
	* @return \Illuminate\Http\Response
	*/
	public function stdShow($id)
	{
		if($id == auth()->user()->id){
		$sentmsg = Message::where([
			['user_id', '=', $id],
			['sent_del', '=', 0],
			['student', '=', 1]
		])->orderBy('created_at', 'desc')->paginate(10);
			
		$recmsg = Message::where([
			['user_id', '=', $id],
			['rec_del', '=', 0],
			['admin', '=', 1]
		])->orderBy('created_at', 'desc')->paginate(10);
				
		return view('student.message')->withSentmsg($sentmsg)->withRecmsg($recmsg);
		}else{
			return back();
		}
		
	}

	public function stdRead(Request $request){
		Message::find($request->id)->update(['stdview' => 1]);
		return response('success');
	}

	public function stdRecdel(Request $request){
		Message::find($request->id)->update(['rec_del' => 1, 'stdview' => 1]);
		return response('success');
	}

	public function stdSentdel(Request $request){
		Message::find($request->id)->update(['sent_del' => 1]);
		return response('success');
	}

}