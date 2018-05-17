<div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="exampleModalLabel">New Complain</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{Form::open(['method' => 'POST','id' => 'msg']) }}
				<div class="form-group">
					<label for="message-text" class="col-form-label font-weight-bold">Your Complain: 
						<span class="text-danger"><span class="count"> 140</span> Characters</span>
					</label>
					<textarea class="form-control" id="message-text" rows="3" name="message"></textarea>
				</div>
				<input type="hidden" value="{{Auth::user()->id}}" name = "user_id">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<input type="submit" value="Send Complain" class="btn btn-success">
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>