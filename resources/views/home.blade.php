@extends('layouts.app')
@section('nav')
@include('inc.nav')
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<h3 class="h3 text-danger">Notice Board</h3>
		</div>
	</div>
	
	<div class="row mt-3 justify-content-center">
		<div class="col-8 py-2 bg-white notice msg-card">
			<div class="row px-2">
				@foreach ($notices as $notice)
				<div class="col-12  line-notice">
					<h6 class="font-weight-bold text-danger">{{$notice->title}}</h6>
					<div class="row ">
						<div class="col-10">
							<p class="m-0 d-flex py-1 ">{{$notice->notice}}</p>
						</div>
						<div class="col-2 p-0 d-flex align-items-end">
							<span class=" text-faint">{{date('M j, h:ia ',strtotime($notice->created_at))}} </span>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
