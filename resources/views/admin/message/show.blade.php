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
				<h5 class="card-title">Card title</h5>
				<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
			</div>
		</div>
	</div>
</div>
@endsection