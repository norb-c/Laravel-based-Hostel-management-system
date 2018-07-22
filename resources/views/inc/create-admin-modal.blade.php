<div class="modal fade" id="create-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title ml-auto" id="exampleModalCenterTitle">Create New Hostel Administrator</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{Form::open(['route' => 'admin.create', 'method' => 'POST'])}}
				<div class=" form-group row">
					{{Form::label('full_name', 'Full Name:', ['class' => 'col-5 col-form-label text-md-left'])}}
					<div class="col">
						{{Form::text('full_name', null, ['class' => 'form-control'])}}
					</div>
				</div>
				<div class=" form-group row">
					{{Form::label('email', 'Email:', ['class' => 'col-5 col-form-label text-md-left'])}}
					<div class="col">
						{{Form::text('email', null, ['class' => 'form-control'])}}
					</div>
				</div>
				<div class=" form-group row">
					{{Form::label('role', 'Role:', ['class' => 'col-5 col-form-label text-md-left'])}}
					<div class="col">
						<select name="role" id="role" class="form-control">
							<option value=""></option>
							<option value="administrator">Administrator</option>
							<option value="moderator">Moderator</option>
						</select>
					</div>
				</div>
				<div class=" form-group row">
					{{Form::label('password', 'Password:', ['class' => 'col-5 col-form-label text-md-left'])}}
					<div class="col">
						{{Form::password('password', ['class' => 'form-control'])}}
					</div>
				</div>
				<div class=" form-group row">
					{{Form::label('conf_password', 'Confirm Password:', ['class' => 'col-5 col-form-label text-md-left'])}}
					<div class="col">
						{{Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'conf_password'])}}
					</div>
				</div>
			</div>
			<div class="create-hostel-footer d-flex">
				<div class="col">
					{{Form::submit('Create Administrator', ['class' => 'btn btn-block btn-success'])}}
					{{Form::close()}}
				</div>
				<div class="col">
					<button type="button" class="btn btn-block btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>
