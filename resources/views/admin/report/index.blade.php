@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@endsection

@section('content')
<div class="row">
	
	<div class="col-9">
		<table id = "campus" class="table table-bordered table-striped ">
			<thead class="std-thead">
				<th>Name</th>
				<th>Hostels</th>
			</thead>
			<tbody>
				
				@foreach ($campus as $camp)
				<tr class="rep-tr">
					<td class="text-center my-auto">
						<h5 class="mt-3 mb-0" >{{$camp->name}}</h5>
					</td>
					<td>
						@foreach ($camp->hostels as $hostel)
						@if ($hostel->name)
						<div class="row justify-content-between px-3 rep-hostel">
							<h5 class="d-inline mt-3 mb-0 rep-h5">{{$hostel->name}}</h5>
							<span class="d-inline-block mt-2">
								<a href="{{route('report.report', $hostel->id)}}" class="btn btn-primary">View Reports</a>
							</span>
						</div>
						@else
						No hostels in this Campus 
						@endif
						@endforeach
						
					</td>
				</tr>
				
				@endforeach
				
				
				
			</tbody>
		</table>
		
	</div>
	<div class="col-3">
		<div class="card">
			<div class="card-header">
				<h5 class="text-center m-0 p-0">Overview</h5>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">Cras justo odio</li>
				<li class="list-group-item">Dapibus ac facilisis in</li>
				<li class="list-group-item">Vestibulum at eros</li>
			</ul>
		</div>
	</div>
	
</div>
@endsection