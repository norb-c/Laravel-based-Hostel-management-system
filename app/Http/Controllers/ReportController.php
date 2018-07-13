<?php

namespace App\Http\Controllers;

use App\Campus;
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
	
	
}