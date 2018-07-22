@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@include('inc.create-notice-modal')
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-between py-3">
		<div class="col">
			<h4 class="text-center m-0 text-danger">All Notifications</h4>
		</div>
		<div class="col-3">
			<button class="btn btn-block btn-warning font-weight-bold" data-toggle="modal" data-target="#create-notice" >Create a New Notification</button>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<table class="table table-bordered hover">
				<thead class="std-thead">
					<th>Notice</th>
					<th>Hostel Name</th>
					<th>Uploaded By</th>
					<th>Created On</th>
					<th>Operation</th>
				</thead>
				<tbody>
					@foreach ($notices as $notice)
					<tr>
						<td>{{$notice->notice}}</td>
						<td>{{$notice->hostel->name}}</td>
						<td>{{$notice->administrator}}</td>
						<td>{{date('M j, Y h:ia ',strtotime($notice->created_at))}}</td>
						<td>
							<form action="{{ route('admin.notifydelete', $notice->id) }}" method="DELETE">
								@csrf
								<button type="submit" class="btn btn-sm btn-danger">Delete</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection