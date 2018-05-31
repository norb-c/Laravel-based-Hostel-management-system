<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use DB;

class AdminMessageController extends Controller
{
	public function __construct(){
		$this->middleware('auth:admin');
	}
	
	public function adminindex()
	{
		$message = new Message;
		$query = DB::select("SELECT * FROM messages WHERE (user_id, created_at) IN (SELECT user_id, MAX(created_at) FROM messages GROUP BY user_id) ORDER BY admview ASC, created_at DESC");
		$msg = $message->hydrate($query);

		return view('admin.message.index')->withMsgs($msg);
	}
	
	
	public function adminshow($id, $user_id)
	{
		
		$newmsg = Message::where([
			['id', '=', $id],
			['user_id', '=', $user_id]
			])->first();
			
			
			//gets the message the student sends
			$old = Message::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
			
			$arr = [];
			foreach ($old as $oldmsg) {
				//if the message is coming from a student
				if(!$oldmsg->admin){
					//get replied msg along with the sent msg 
					$rep = Message::where('replied', $oldmsg->id)->get();
					//if msg has not been replied, push only the recieved msg
					if(count($rep)){
						//get the student message with admin replies
						array_push($arr, $rep);
					}else{
						//multiple unreplied message sent by student
						array_push($arr, ['0' => $oldmsg]);
					}
				}else{
					//gets the lone message the admin sends
					$sent = Message::where([
						['id', '=', $oldmsg->id],
						['replied', '=', 0]
					])->get();
					//insert only the ones with values as the loops runs
					if(count($sent)){
						array_push($arr, ['1' => $oldmsg]);
					}
					
				}
				
			}
			return view('admin.message.show')->with('new', $newmsg)->with('arr', $arr);
		}
		
		//send message
		public function adminsend(Request $request){
			
			$this->validate($request, ['message' => 'required']);
			
			$message = new Message;
			$message->user_id = $request->user_id;
			$message->message = $request->message;
			$message->student = 0;
			$message->admin = 1;
			$message->admview = 1;
			
			$message->save();
			$id = $message->id;
			
			return redirect()->route('adminmsg.show',[$id, $request->user_id]);
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
		
		public function admindestroy(){
			
		}
		
		
	}