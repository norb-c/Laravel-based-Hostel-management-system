@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@include('inc.create-hostel-modal')
@endsection

@section('content')
<div class="row justify-content-between py-3">
	<div class="col">
		<h4 class="text-center m-0 text-danger">All Campuses and Hostels</h4>
	</div>
	<div class="col-3">
		<button class="btn btn-block btn-warning font-weight-bold" data-toggle="modal" data-target="#create-hostel" >Create a New Hostel</button>
	</div>
</div>
<div class="row">
	
	<div class="col">
		<table id = "hostel" class="table table-bordered table-striped table-hover">
			<thead class="std-thead">
				<th>Campus Name</th>
				<th>Hostel Name</th>
				<th>Type</th>
				<th>Room Count</th>
				<th>Operations</th>
			</thead>
			<tbody>
				@foreach ($hostels as $hostel)
				<tr>
					<td>{{$hostel->campus->name}}</td>
					<td>{{$hostel->name}}</td>
					@switch($hostel->type)
					@case(1)
					<td>Male</td>
					@break
					@case(2)
					<td>Female</td>
					@break
					@default
					@endswitch
					<td>{{count($hostel->rooms)}}</td>
					<td class="d-flex justify-content-around">
						<a href="{{route('admin.student.all', $hostel->id)}}" class="btn btn-sm btn-info">View Students</a>	
						<a href="{{route("hostels.show",$hostel->id)}}" class="btn btn-sm btn-primary">View Rooms</a>
						<a href="{{route("report.report",$hostel->id)}}" class="btn btn-sm btn-danger">Hostel Statistics</a>					
					</td>
				</tr> 
				@endforeach
			</tbody>
		</table>
	</div>
	
</div>
<script>
	$(function(){
		$('#hostel').DataTable();
	}); 
</script>
@endsection