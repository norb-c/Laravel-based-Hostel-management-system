<!-- Modal -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col">
						{{Form::open([ 'method' => 'POST', 'id' => 'bed'])}}
						<div class=" form-group row">
							{{Form::label('first', 'Space 1:', ['class' => 'col col-form-label text-md-left'])}}
							<div class="col">
								<input type="number" value = ""  min = "0" name="first" id="first" class="form-control">
							</div>
							{{Form::label('second', 'Space 2:', ['class' => 'col col-form-label text-md-left'])}}
							<div class="col">
								<input type="number" value = ""  min = "0" name="second" id="second" class="form-control">
							</div>
						</div>
						<input type="hidden" name="hidden" class = "hidden" value = "">
						<div class=" form-group row">
							{{Form::label('third', 'Space 3:', ['class' => 'col col-form-label text-md-left'])}}
							<div class="col">
								<input type="number" value = ""  min = "0" name="third" id="third" class="form-control">
							</div>
							{{Form::label('fourth', 'Space 4:', ['class' => 'col col-form-label text-md-left'])}}
							<div class="col">
								<input type="number" value = ""  min = "0" name="fourth" id="fourth" class="form-control">
							</div>
						</div>			
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
					{{Form::submit('Create Room', ['class' => 'btn btn-block btn-success mt-0'])}}
				</div>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>