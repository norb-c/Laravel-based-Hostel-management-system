<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
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
    public function stdstore(Request $request)
    {
		$this->validate($request, [
			'message' => 'required|max:140',
		]);
			$message = new Message;
			$message->message = $request->message;
			$message->student = 1;
			$message->admin = 0;
			$message->user()->associate($request->user_id);

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
    public function stdshow($id)
    {
		$sentmsg = Message::where([
			['user_id', '=', $id],
			['student', '=', 1]
		])->orderBy('created_at', 'desc')->paginate(10);

		$recmsg = Message::where([
			['user_id', '=', $id],
			['admin', '=', 1]
		])->orderBy('created_at', 'desc')->paginate(10);

		return view('student.message')->withSentmsg($sentmsg)->withRecmsg($recmsg);
    }

   
}