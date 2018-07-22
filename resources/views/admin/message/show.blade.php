@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@endsection

@section('content')
<div class="row my-5">
	<div class="col-lg-4 col-md-4">
		<div class="card mb-3 pt-3 overview-card">
			<div class="show-pic-parent">
				<img src="{{asset('/storage/passport/'.$new->allocate->user->passport)}}" alt="{{$new->allocate->user->surname}}" class="show-pic">
			</div>
			<div class="text-center">
				<p class="font-weight-bold"> {{$new->allocate->user->name}} {{$new->allocate->user->surname}} </p>
				<a href="{{route('admin.student.show', $new->user_id)}}" class="btn btn-primary">View Full Profile</a>
			</div>
			<div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item "><span class="mr-4"><i class="fas fa-user-alt"></i></span><span class="text-danger font-weight-bold">{{$new->allocate->user->regno}}</span></li>
					<li class="list-group-item "><span class="mr-4"><i class="fas fa-school"></i></span><span class="text-danger font-weight-bold">{{$new->allocate->campus->name}}</span> </li>
					<li class="list-group-item "><span class="mr-4"><i class="fas fa-home"></i></span><span class="text-danger font-weight-bold">{{$new->allocate->hostel->name}}</span></li>
					<li class="list-group-item "><span class="mr-4"><i class="fas fa-list-ol"></span></i><span class="text-danger font-weight-bold">Room number {{$new->allocate->room_no}}</span></li>
					<li class="list-group-item "><span class="mr-4"><i class="fas fa-warehouse"></i></span><span class="text-danger font-weight-bold">{{$new->allocate->bed}} Bed</span></li>
				</ul>
			</div>
		</div>
	</div>
	@if ($new->admin)
	<div class="col-lg-8 order-lg-2 col-sm-12 col-xs-12 mt-5">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title text-center">Send a New Message</h5>
				{{Form::open(['route' => ['adminmsg.send'], 'method' => 'POST'])}}
				<div class="form-group">
					<input type="hidden" name="user_id" value="{{$new->user_id}}">
					<textarea name="message" id="message" rows="5" class="form-control" placeholder="Send Message"></textarea>
				</div>
				<div class="form-group">
					<input type="submit" value="Send Message" class="btn btn-success float-right">
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
	@else
	<div class="col-lg-8 order-lg-2 col-sm-12 col-xs-12 mt-5">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title text-center">Reply Message</h5><hr>
				<p class="card-text">{{$new->message}}</p><hr>
				{{Form::open(['route' => ['adminmsg.reply'], 'method' => 'POST'])}}
				<div class="form-group">
					<input type="hidden" name="user_id" value="{{$new->user_id}}">
					<input type="hidden" name="id" value="{{$new->id}}">
					<textarea name="message" id="message" rows="5" class="form-control" placeholder="Write a Reply"></textarea>
				</div>
				<div class="form-group">
					<input type="submit" value="Send Reply" class="btn btn-success float-right">
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
	@endif
	
</div>
<div class="row pt-3">
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 m-auto p-3 msg-show-body">
		<h5 class="text-center">Conversation</h5><hr class="m-0 mb-2">
		@foreach ($arr as $old)
		@if (empty($old[1]))
		<div>
			<div class="d-flex justify-content-start">
				<div class="p-2 m-0 msg-show-tab bg-show-1">
					<p class="m-0 p-2">{{$old[0]->message}}</p>
					<p class="font-weight-bold mt-3 m-0 pb-2 text-left"> {{date('M j, h:ia',strtotime($old[0]->created_at))}}</p>
				</div>
			</div>		
			<hr>
		</div>
		@elseif(empty($old[0]))
		<div>
			<div class="d-flex justify-content-end">
				<div class=" p-2 m-0 msg-show-tab bg-show-2">
					<p class="m-0 p-2">{{$old[1]->message}}</p>
					<p class="font-weight-bold mt-3 m-0 pb-2 pl-2 text-right"> {{date('M j, h:ia',strtotime($old[1]->created_at))}}</p>
				</div>
			</div>		
			<hr>
		</div>
		@else
		<div>
			<div class="d-flex justify-content-start">
				<div class="p-2 m-0 msg-show-tab bg-show-1">
					<p class="m-0 p-2">{{$old[0]->message}}</p>
					<p class="font-weight-bold mt-3 m-0 pb-2 text-left"> {{date('M j, h:ia',strtotime($old[0]->created_at))}}</p>
				</div>
			</div>		
			<div class="d-flex justify-content-end">
				<div class=" p-2 m-0 msg-show-tab bg-show-2">
					<p class="m-0 p-2">{{$old[1]->message}}</p>
					<p class="font-weight-bold mt-3 m-0 pb-2 pl-2 text-right"> {{date('M j, h:ia',strtotime($old[1]->created_at))}}</p>
				</div>
			</div>
			<hr>
		</div>
		@endif
		@endforeach
	</div>
</div>

@endsection