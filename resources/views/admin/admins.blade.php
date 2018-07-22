@extends('layouts.app')
@section('nav')
@include('inc.create-admin-modal')
@include('inc.nav-admin')
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-between py-3">
		<div class="col">
			<h4 class="text-center m-0 text-danger">All Hostel Administrators</h4>
		</div>
		<div class="col-3">
			<button class="btn btn-block btn-warning font-weight-bold" data-toggle="modal" data-target="#create-admin" >Create New Administrator</button>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<table id ="adm" class="table table-bordered table-hover table-striped">
				<thead class="std-thead ">
					<th>Full Name</th>
					<th>Role</th>
					<th>Email</th>
					<th>Operations</th>
					<th>Created On</th>
				</thead>
				<tbody>
					@foreach ($admins as $admin)
					<tr class="admin">
						<td>{{$admin->name}}</td>
						<td>{{$admin->job_title}}</td>
						<td>{{$admin->email}}</td>
						<td class="d-flex justify-content-between">
							@if (Auth()->user()->id != $admin->id)
							<a href="#" class="btn btn-sm btn-danger">Remove Admin</a>	
							@endif
							<a href="#" class="btn btn-sm btn-info">View Profile</a>					
						</td>
						<td>{{date('M j, h:ia ',strtotime($admin->created_at))}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(function(){
		$('#adm').DataTable();
	});
</script>
@endsection