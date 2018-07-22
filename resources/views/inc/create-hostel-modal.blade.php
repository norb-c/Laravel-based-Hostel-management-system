<!-- create hostel -->
<div class="modal fade" id="create-hostel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title ml-auto" id="exampleModalCenterTitle">Create New Hostel</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div>
					{{Form::open(['route' => 'hostels.store', 'method' => 'POST', 'class' => 'create-hostel'])}}
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
				</div>
			</div>
			<div class="create-hostel-footer d-flex">
				<div class="col">
					{{Form::submit('Create Hostel', ['class' => 'btn btn-block btn-success'])}}
					{{Form::close()}}
				</div>
				<div class="col">
					<button type="button" class="btn btn-block btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>

