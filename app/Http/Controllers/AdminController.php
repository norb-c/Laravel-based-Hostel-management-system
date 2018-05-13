<?php

namespace App\Http\Controllers;
use App\Allocate;

use Illuminate\Http\Request;

class AdminController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$hostellers = Allocate::all();
        return view('admin.dashboard')->withHostellers($hostellers);
    }
}