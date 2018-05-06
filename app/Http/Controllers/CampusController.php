<?php

namespace App\Http\Controllers;

use App\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
	public function __construct(){
		$this->middleware('auth:admin');
	}
	
	
	
	
}