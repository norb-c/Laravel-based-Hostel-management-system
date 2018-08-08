@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@endsection

@section('content')
<div class="row">
	
	<div class="col-12">
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
</div>
@endsection