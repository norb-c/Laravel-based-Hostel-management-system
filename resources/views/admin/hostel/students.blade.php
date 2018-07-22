@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@endsection

@section('content')
<div class="row">
	<div class="col-md-3 order-lg-2">
		<div class="card mt-5">
			<div class="card-header">
				<h5 class="text-center m-0 p-0">Hostel Details</h5>
			</div>
			<div class="sticky-top">
				<ul class="list-group list-group-flush">
					<li class="list-group-item "><i class="fas fa-school"></i><span>{{$details->campus->name}}</span></li>
					<li class="list-group-item "><i class="fas fa-home"></i><span>{{$details->name}}</span></li>
					<li class="list-group-item ">
						@if ($details->type = 1)
						<i class="fas fa-male"></i><span>Male</span>
						@else
						<i class="fas fa-female"></i><span>Female</span>
						@endif
					</li>
					<li class="list-group-item "><i class="fas fa-list-ol"></i> {{count($students)}} Students Total</li>
					<li class="list-group-item "><i class="fas fa-registered"></i><span>{{$rumno}} Rooms Total</span></li>
				</ul>
			</div>
			<li class="list-group-item "><a href="{{route('report.report', $details->id)}}" class="btn btn-block btn-primary">View Full Hostel Details</a></li>
		</div>
	</div>
	<div class="col-md-9 order-lg-1">
	<h4 class="text-center text-danger mb-4">List of Students in {{$details->name}}</h4>
		<table id = "students" class="table table-bordered table-striped table-hover">
			<thead class = "std-thead">
				<th>Name</th>
				<th>Reg. Number</th>
				<th>Receipt No.</th>
				<th>Room Number</th>
				<th>Action</th>
			</thead>
			<tbody>
				@foreach ($students as $std)
				<tr>
					<td>{{$std->user->name}} {{$std->user->surname}}</td>
					<td>{{$std->user->regno}}</td>
					<td>{{$std->receipt}}</td>
					<td class="text-center">{{$std->room_no}}</td>
					<td class="d-flex justify-content-between">
						<a href="{{route('admin.student.show', $std->user_id)}}" class="btn btn-sm btn-info">View Profile</a>
						<a href="#" class="btn btn-sm btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<script>
	$(function(){
		$('#students').DataTable();
	});
	
</script>
@endsection