@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@endsection

@section('content')
<?php
$floor = '';
if($std->floor == 1){
	$floor = 'First';
}elseif($std->floor == 2){
	$floor = 'Second';
}else{
	$floor = 'Third';
}

?>
@section('content')
<div class="row my-2">
	<div class="col-lg-8 order-lg-2">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a href="" data-target="#personal" data-toggle="tab" class="nav-link active">Personal Profile</a>
			</li>
			<li class="nav-item">
				<a href="" data-target="#school" data-toggle="tab" class="nav-link">School Profile</a>
			</li>
			<li class="nav-item">
				<a href="" data-target="#edit" data-toggle="tab" class="nav-link">Edit</a>
			</li>
		</ul>
		<div class="tab-content py-4">
			<div class="tab-pane active" id="personal">
				<div class="row">
					<div class="col-md-6 col-lg-8">
						<h6 class = "font-weight-font-weight- text-danger ">Full Name</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->user->name}} {{$std->user->surname}}</p>
						<h6 class = "font-weight-bold  text-danger">Email</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded email">{{$std->user->email}}</p>
						<h6 class = "font-weight-bold  text-danger">Gender</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded "><?= ($std->user->gender == 1) ? 'Male':'Female'?></p>
						<h6 class = "font-weight-bold  text-danger">Phone Number</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->user->phone}}</p>
						<h6 class = "font-weight-bold  text-danger">Address</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->user->address}}</p>
						<h6 class = "font-weight-bold  text-danger">State</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->user->state}}</p>
						<h6 class = "font-weight-bold  text-danger">Next of Kin Name</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->user->nok}}</p>
						<h6 class = "font-weight-bold  text-danger">Next of Kin Phone Number</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->user->nokno}}</p>
						<h6 class = "font-weight-bold  text-danger">Account Created on</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{date('M j, Y h:ia',strtotime($std->user->created_at))}}</p>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="school">
				<div class="row">
					<div class="col-md-6 col-lg-8">
						<h6 class = "font-weight-bold  text-danger">Department</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->user->department}}</p>
						<h6 class = "font-weight-bold  text-danger">Registration Number</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->user->regno}}</p>
						<h6 class = "font-weight-bold  text-danger">Campus</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->campus->name}}</p>
						<h6 class = "font-weight-bold  text-danger">Hostel</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->hostel->name}}</p>
						<h6 class = "font-weight-bold  text-danger">Floor</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$floor}}</p>
						<h6 class = "font-weight-bold  text-danger">Room Number</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->room_no}}</p>
						<h6 class = "font-weight-bold  text-danger">Bed Location</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->bed}}</p>
						<h6 class = "font-weight-bold  text-danger">Receipt</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$std->receipt}}</p>
						<h6 class = "font-weight-bold  text-danger">Room Allocated on</h6>
						<p class="bg-secondary text-white p-1 pl-2 rounded ">{{date('M j, Y h:ia ',strtotime($std->created_at))}}</p>
					</div>
				</div>
			</div>				
			<div class="tab-pane" id="edit">
				<div class="row">
					<div class="col-md-6 col-lg-9">
						{!!Form::open(['action' => ['RoomController@update', $std->user->id], 'method' => 'PUT'] )!!}
						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-control-label">First name</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" value="{{$std->user->name}}" name="name">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-control-label">Last name</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" value="{{$std->user->surname}}" name="surname">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-control-label">Email</label>
							<div class="col-lg-8">
								<input class="form-control" type="email" value="{{$std->user->email}}" name="email">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-control-label">Department</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" value="{{$std->user->department}}" name="department">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-control-label">Registration Number</label>
							<div class="col-lg-8">
								<input class="form-control" type="number" value="{{$std->user->regno}}" name="regno">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-control-label">Phone Number</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" value="{{$std->user->phone}}" name="phone">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-control-label">Address</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" value="{{$std->user->address}}" name="address">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-control-label">State</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" value="{{$std->user->state}}" name="state">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-control-label">Next of Kin Name</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" value="{{$std->user->nok}}" name="nok"> 
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-control-label">Next of Kin Number</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" value="{{$std->user->nokno}}" name="nokno">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-form-label form-control-label"></label>
							<div class="col-lg-8">
								{{Form::submit('Save Changes',['class' =>'btn btn-warning font-weight-bold btn-block'])}}
								{!!Form::close()!!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 order-lg-1 text-center py-3">
		<img src="/storage/passport/{{$std->user->passport}}" class="mx-auto img-fluid img-circle d-block" alt="avatar">
		<h6 class="mt-2">Upload a different photo</h6>
		{!!Form::open(['action' => ['RoomController@updatephoto', $std->user->id],'method' => 'PUT','enctype' => 'multipart/form-data'] )!!}
		<label class="custom-file">
			<input type="file" id="file" class="custom-file-input" name="passport">
			<span class="custom-file-control">Choose file</span>
		</label>
		{{Form::submit('Upload Photo',['class' =>'btn btn-info font-weight-bold btn-block mt-2'])}}
		{!!Form::close()!!}
	</div>
</div>

@endsection