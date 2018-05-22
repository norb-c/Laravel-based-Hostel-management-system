<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
	public function __construct(){
		$this->middleware('auth:admin');
	}
	
	public function adminindex(){
		$msg = Message::where([
			['student','=', 1],
			['replied', '<', 1]
			])->orderBy('created_at', 'desc')->paginate(15);
			return view('admin.message.index')->withMsgs($msg);
		}
		
		public function adminshow($id, $user_id){

			$msg = Message::where([
				['id', '=', $id],
				['user_id', '=', $user_id]
			])->first();
			$msg->update(['admview' => 1]);
			
			return view('admin.message.show')->with('msg', $msg);
		}

		public function adminreply(Request $request){
			$this->validate($request, ['message' => 'required']);

			$msgID = $request->id;

			$message = new Message;
			$message->user_id = $request->user_id;
			$message->message = $request->message;
			$message->admin = 1;
			$message->student = 0;
			//we will use the replied to get the message for admin to view his replies and to who
			$message->replied = $msgID;

			$message->save();

			//set the message replied to, to 1 so we can't see it in the index;
			$replied = Message::where(['id' => $msgID])->first();

			$replied->update(['replied' => $msgID]);
	


			return redirect()->route('adminmsg.index')->with('success', 'Message sent Successfullly');
		}


		public function viewReply(){
			return view('admin.message.viewreply');
		}

		public function admindestroy(){

		}
		
	
}