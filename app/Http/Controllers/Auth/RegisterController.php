<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/
	
	use RegistersUsers;
	
	/**
	* Where to redirect users after registration.
	*
	* @var string
	*/
	protected $redirectTo = '/home';
	
	private $_fileNameToStore;
	
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('guest');
	}
	
	/**
	* Get a validator for an incoming registration request.
	*
	* @param  array  $data
	* @return \Illuminate\Contracts\Validation\Validator
	*/
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|string|max:30',
			'surname' => 'required|string|max:30',
			'email' => 'required|email|unique:users',
			'regno' => 'required|numeric|unique:users',
			'gender' => 'required|numeric',
			'campus_id' => 'required',
			'department' => 'required|string|max:50',
			'phone' => 'required|numeric',
			'state' => 'required|string|max:30',
			'address' => 'required|string|max:255',
			'nok' => 'required|string|max:255',
			'nokno' => 'required|numeric',
			'passport'=> 'image|max:1999',
			'password' => 'required|min:6',
			'password' => 'required|min:6|confirmed',
			]);
		}
		
		public function register(Request $request)
		{
	
			if($request->hasFile('passport')){
				$file = $request->file('passport');
				$filenameWithExt = $file->getClientOriginalName();
				$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
				$extension = $file->extension();
				$this->_fileNameToStore = $filename.'_'.time().'.'.$extension;
				
				$storeFile =  $this->fileName();

				//upload image
				$path = $file->storeAs('public/passport',$storeFile );
			}
			

			$this->validator($request->all())->validate();
	
			event(new Registered($user = $this->create($request->all(), $storeFile)));
			
			$this->guard()->login($user);
			
			return $this->registered($request, $user)
			?: redirect($this->redirectPath());
		}
		/**
		* Create a new user instance after a valid registration.
		*
		* @param  array  $data
		* @return \App\User
		*/
		protected function create(array $data, $storeFile)
		{

			return User::create([
				'name' => $data['name'],
				'surname' => $data['surname'],
				'email' => $data['email'],
				'regno' => $data['regno'],
				'gender' => $data['gender'],
				'campus_id' => $data['campus_id'],
				'department' => $data['department'],
				'phone' => $data['phone'],
				'state' => $data['state'],
				'address' => $data['address'],
				'nok' => $data['nok'],
				'nokno' => $data['nokno'],
				'passport' => $storeFile,
				'password' => Hash::make($data['password']),
				]);
			}
			
			protected function fileName(){
				return $this->_fileNameToStore;
			}
			
			
			/**
			* The user has been registered.
			*
			* @param  \Illuminate\Http\Request  $request
			* @param  mixed  $user
			* @return mixed
			*/
			protected function registered(Request $request, $user)
			{
				//
			}
			
			
			
		}