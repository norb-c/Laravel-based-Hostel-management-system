@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@endsection

@section('content')
<div class="row">
	<div class="col-12 mb-4 mt-2">
		<h4 class="text-center text-danger">List of Students in the {{$details->name}} and Hostel Statistics</h4>
	</div>
	<div class="col-8">
		
		<table id = "students" class="table table-bordered table-striped table-hover">
			<thead class = "std-thead">
				<th>Name</th>
				<th>Reg. Number</th>
				<th>Room Number</th>
				<th>Action</th>
			</thead>
			<tbody>
				@foreach ($students as $student)
				<tr>
					<td>{{$student->user->name}} {{$student->user->surname}}</td>
					<td>{{$student->user->regno}}</td>
					<td>{{$student->room_no}}</td>
					<td class="d-flex justify-content-between">
						<a href="{{route('admin.student.show', $student->user_id)}}" class="btn btn-sm btn-info">View Profile</a>
						<a href="#" class="btn btn-sm btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach				
			</tbody>
		</table>
	</div>
	
	<div class="col-4">
		<div class="card mt-3">
			<div class="card-header">
				<h5 class="text-center m-0 p-0">Hostel Details</h5>
			</div>
			<div class="sticky-top">
				<ul class="list-group list-group-flush">
					<li class="list-group-item d-flex justify-content-between"><h6>Campus Name</h6><h5>{{$details->campus->name}}</h5></li>
					<li class="list-group-item d-flex justify-content-between"><h6>Hostel Name</h6><h5>{{$details->name}}</h5></li>
					<li class="list-group-item d-flex justify-content-between">
						<h6>Type</h6>
						@if ($details->type = 1)
						<h5>Male</h5>
						@else
						<h5>Female</h5>
						@endif
					</li>
					<li class="list-group-item d-flex justify-content-between"><h6>Total No. of Students</h6><h5>{{count($students)}}</h5></li>
					<li class="list-group-item d-flex justify-content-between"><h6>Total No. of Rooms</h6><h5>{{ $roomCount}}</h5></li>
					<li class="list-group-item d-flex justify-content-between"><h6>Total No. of Rooms Available</h6><h5>{{ $room_avail}}</h5></li>
					<li class="list-group-item d-flex justify-content-between"><h6>Fully Occupied Rooms</h6><h5>{{ $room_unavail}}</h5></li>
					<li class="list-group-item d-flex justify-content-between"><h6>Total No. Available Bed space</h6><h5>{{ $bed_avail}}</h5></li>
					<li class="list-group-item "><a href="{{route('hostels.show', $details->id)}}" class=" font-weight-bold btn btn-block btn-warning">View Rooms</a></li>
				</ul>
			</div>
		</div>
	</div>
	
</div>
<script>
	$(function(){
		$('#students').DataTable();
	});
</script>
@endsection
