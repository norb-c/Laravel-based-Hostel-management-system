@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@endsection

@section('content')
<div class="row">
	<div class="col mt-5 ">
		@foreach ($msgs as $msg)
		<div class="row msg-card my-1 new">
			<div class="col-1  p-2 pr-0 notify-parent">
				<img src="{{asset('/storage/passport/'.$msg->allocate->user->passport)}}" class="circle" alt="">
				@if (!$msg->admview)
				<span class="badge badge-pill badge-danger notify">1</span>
				@endif
			</div>
			<div class="col py-2">
				<div>
					<h6 class="font-weight-bold">
						{{$msg->allocate->user->name}} {{$msg->allocate->user->surname}}
						<span class="badge badge-pill badge-primary">{{$msg->allocate->hostel->name}}</span>
					</h6>
					<p class="msg-hint d-inline-block">{{substr($msg->message, 0,100)}}...
						@if ($msg->admview)
						<i class="fas fa-check-circle text-success"></i>
						@endif
					</p>
				</div>
			</div>
			<div class="col-2 align-self-center">
				<a href="{{route('adminmsg.show', [$msg->id, $msg->user_id])}}" class="btn btn-sm btn-primary">View</a>
				<a href="{{route('adminmsg.destroy', $msg->id)}}" class="btn btn-sm btn-danger">Delete</a>
			</div>
		</div>
		@endforeach
	</div>
	{{-- {{$msgs->links()}} --}}
</div>

@endsection
