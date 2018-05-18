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
			['replied', '=', 0]
			])->orderBy('created_at', 'desc')->paginate(15);
			return view('admin.message.index')->withMsgs($msg);
		}
		
		public function adminshow($id, $user_id){
			$msg = Message::where([
				['id', '=', $id],
				['user_id', '=', $user_id]
			])->first();
			
			
			return view('admin.message.show')->with('msg', $msg);
		}
		public function admindestroy(){
			
		}
		
	
}