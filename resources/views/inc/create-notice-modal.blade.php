<div class="modal fade" id="create-notice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title ml-auto" id="exampleModalCenterTitle">Notification</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{Form::open(['route' => 'admin.notifycreate', 'method' => 'POST', 'class' => 'create-hostel'])}}
				
				<div class=" form-group">
					<label for="title" class="col-form-label font-weight-bold">Title: 
					</label>
					{{Form::text('title', null, ['class' => 'form-control'])}}
				</div>
				
				<div class="form-group">
					<label for="message-text" class="col-form-label font-weight-bold">Notification: 
					</label>
					<textarea class="form-control" id="notice" rows="3" name="notice"></textarea>
				</div>
				
				<div class=" form-group row">
					<div class="col">
						<select name="hostel_id" id="hostel" class="form-control">
							<option value="">Select Hostel</option>
							@foreach ($hostels as $hostel)		
							<option value="{{$hostel->id}}">{{$hostel->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<input type="hidden" value="{{Auth::user()->name}}" name = "name">
			</div>
			<div class="create-hostel-footer d-flex">
				<div class="col">
					{{Form::submit('Send Notice', ['class' => 'btn btn-block btn-success'])}}
					{{Form::close()}}
				</div>
				<div class="col">
					<button type="button" class="btn btn-block btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
			
		</div>
	</div>
</div>