@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@endsection

@section('content')
<div class="row mt-5">
	<div class="col-lg-4 col-md-4 caps">
		<div class="card mb-3">
			<div class="card-header text-center font-weight-bold">
				School Profile
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item "><span class="font-weight-bold"> Name:</span> {{$msg->allocate->user->name}} {{$msg->allocate->user->surname}}</li>
				<li class="list-group-item "><span class="font-weight-bold">Reg Num.: </span> {{$msg->allocate->user->regno}}</li>
				<li class="list-group-item "> <span class="font-weight-bold"> Campus:</span> {{$msg->allocate->campus->name}}</li>
				<li class="list-group-item "> <span class="font-weight-bold">Hostel: </span> {{$msg->allocate->hostel->name}}</li>
				<li class="list-group-item "> <span class="font-weight-bold">Room Num.: </span> {{$msg->allocate->room_no}}</li>
				<li class="list-group-item "> <span class="font-weight-bold">Bed Location: </span> {{$msg->allocate->bed}}</li>
			</ul>
		</div>
		<a href="#" class="btn btn-block btn-primary font-weight-bold">View Full Profile >>></a>
	</div>
	
	<div class="col-lg-8 order-lg-2 mt-5">
		<div class="card w-75">
			<div class="card-body">
				<h5 class="card-title">Message</h5><hr>
				<p class="card-text">{{$msg->message}}</p><hr>
				{{Form::open(['route' => ['adminmsg.reply'], 'method' => 'POST'])}}
				<div class="form-group">
				<input type="hidden" name="user_id" value="{{$msg->user_id}}">
				<input type="hidden" name="id" value="{{$msg->id}}">
					<textarea name="message" id="message" rows="5" class="form-control" placeholder="Write a Reply"></textarea>
				</div>
				<div class="form-group">
					<input type="submit" value="Send" class="btn btn-success float-right">
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>
@endsection