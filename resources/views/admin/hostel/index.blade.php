@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@endsection

@section('content')

<div class="row">
	
	
	<div class="col-md-8">
		<table id = "hostel" class="table table-bordered table-striped">
			<thead>
				<th>#</th>
				<th>Name</th>
				<th>Campus</th>
				<th>Type</th>
				<th>Operations</th>
			</thead>
			<tbody>
				@foreach ($hostels as $hostel)
				<tr>
					<td>{{$hostel->id}}</td>
					<td>{{$hostel->name}}</td>
					<td>{{$hostel->campus->name}}</td>
					@switch($hostel->type)
					@case(1)
					<td>Male</td>
					@break
					@case(2)
					<td>Female</td>
					@break
					@default
					@endswitch
					<td>
						<div class="row">
							<div class="col-md-6">
								<a href="{{route("hostels.show",$hostel->id)}}" class="btn btn-block btn-sm btn-primary">Rooms</a>							
							</div>
							<div class="col-md-6">
								{{Form::open(['action' => ['HostelController@destroy',$hostel->id], 'method' => 'DELETE'])}}
								{{Form::submit('Delete', ['class' => 'btn btn-sm btn-block btn-danger '])}}
								{{Form::close()}}
							</div>
						</div>
					</td>
				</tr> 
				@endforeach
			</tbody>
		</table>
	</div>
	
	<div class="col-md-4">
		<div class="card">
			<div class="card-header text-center">
				Create a New Hostel
			</div>
			<div class="card-body d-flex justify-content-center">
				{{Form::open(['route' => 'hostels.store', 'method' => 'POST'])}}
				<div class=" form-group row">
					{{Form::label('name', 'Name:', ['class' => 'col-md-4 col-form-label text-md-left'])}}
					<div class="col">
						{{Form::text('name', null, ['class' => 'form-control'])}}
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('campus', 'Campus:', ['class' => 'col-md-4 col-form-label text-md-left'])}}
					<div class="col">
						<select name="campus" id="campus" class="form-control">
							<option value="">Select Campus</option>
							@foreach ($campuses as $campus)		
							<option value="{{$campus->id}}">{{$campus->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('type', 'Type:', ['class' => 'col-md-4 col-form-label text-md-left'])}}
					<div class="col">
						<select name="type" id="type" class="form-control">
							<option value="">Select Type</option>	
							<option value="1">Male</option>
							<option value="2">Female</option>
						</select>
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-4"></div>
					<div class="col">
						{{Form::submit('Create Hostel', ['class' => 'btn btn-block btn-success'])}}
					</div>
				</div>
				{{Form::close()}}
			</div>
		</div>
		
	</div>
</div>
@endsection

<script>

</script>