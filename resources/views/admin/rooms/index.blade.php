@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@include('inc.modal')
@endsection

@section('content')
<div class="row">
	
	
	<div class="col-md-7">
		<table class="table-bordered table-striped table">
			<thead class="table-info">
				<th>Floor</th>
				<th>Room Num.</th>
				<th>Bed Space Avail.</th>
				<th>Edit Bed Space</th>
			</thead>
			<tbody>
				@foreach ($rooms as $room)
				<tr >
					@switch($room->floor)
					@case(1)
					<td>First</td>
					@break
					@case(2)
					<td>Second</td>
					@break
					@default
					<td>Third</td>
					@endswitch
					<td>{{$room->room_no}}</td>
					<td>
						<?php
						$bed_count = json_decode($room->bed, true);
						$count = 0;
						foreach($bed_count as $bed => $value){
							if($value){
								$count += 1;
							}
						}
						?>
						<span class="mx-3">{{$count}}</span>
						<button class="btn btn-sm btn-outline-primary btnupd" data-id ="{{$room->id}}">Update</button>  
					</td>
					<td></td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
		
	</div>
	<div class="col-md-5">
		<div class="card">
			<div class="card-header text-center">
				Create Rooms
			</div>
			<div class="card-body d-flex justify-content-center">
				{{Form::open(['route' => 'rooms.store', 'method' => 'POST'])}}
				<div class=" form-group row">
					{{Form::label('campus', 'Campus:', ['class' => 'col-3 col-form-label text-md-left'])}}
					<div class="col">
						<select name="campus_id" id="campus" class="form-control" readonly>
							<option value="{{$hostel->campus->id}}">{{$hostel->campus->name}}</option>
						</select>
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('hostel', 'Hostel:', ['class' => 'col-3 col-form-label text-md-left'])}}
					<div class="col">
						<select name="hostel_id" id="hostel" class="form-control" readonly>
							<option value="{{$hostel->id}}">{{$hostel->name}}</option>
						</select>
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('type', 'Type:', ['class' => 'col-3 col-form-label text-md-left'])}}
					<div class="col">
						<select name="type" id="type" class="form-control" readonly>
							<option value="{{$hostel->type}}"><?= ($hostel->type == 1)? 'Male': 'Female' ?></option>
						</select>
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('floor', 'Floor:', ['class' => 'col-3 col-form-label text-md-left'])}}
					<div class="col">
						<select name="floor" id="floor" class="form-control">
							<option value="x">Select Floor</option>
							<option value="1">First</option>
							<option value="2">Second</option>
							<option value="3">Third</option>
						</select>
					</div>
				</div>
				<div class=" form-group row">
					{{Form::label('room_no', 'Room No.:', ['class' => 'col-3 col-form-label text-md-left'])}}
					<div class="col">
						<select name="room_no" id="room_no" class="form-control">
							<option value="">Select Room Number</option>
						</select>
					</div>
				</div>
				<div class=" form-group row">
					{{Form::label('first', 'Space 1:', ['class' => 'col col-form-label text-md-left'])}}
					<div class="col">
						<input type="number" value = "0" max = "1" name="first" id="first" class="form-control">
					</div>
					{{Form::label('second', 'Space 2:', ['class' => 'col col-form-label text-md-left'])}}
					<div class="col">
						<input type="number" value = "0" max="1" name="second" id="second" class="form-control">
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('third', 'Space 3:', ['class' => 'col col-form-label text-md-left'])}}
					<div class="col">
						<input type="number" value = "0" max="1" name="third" id="second" class="form-control">
					</div>
					{{Form::label('fourth', 'Space 4:', ['class' => 'col col-form-label text-md-left'])}}
					<div class="col">
						<input type="number" value = "0" max="1" name="fourth" id="fourth" class="form-control">
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-md-4"></div>
					<div class="col">
						{{Form::submit('Create Room', ['class' => 'btn btn-block btn-success'])}}
					</div>
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>




<script>
	
	$(function(){
		
		$('#update').on('hidden.bs.modal', function (e) {
			setTimeout(() => {
				$('span').removeClass('count');
			}, 250);
		})
		
		
		$(".btnupd").click(function(){
			let token = "{{Session::token()}}";
			let id = $(this).data('id');
			let url = "{{ route("bed.edit") }}";
			$(this).prev().addClass('count');
			
			
			data = {
				id: id,
				token: token
			}
			
			$.ajax({
				url: url,
				type: 'GET',
				data: data,
				success: function(data){
					$('#first').val(data.first);
					$('#second').val(data.second);
					$('#third').val(data.third);
					$('#fourth').val(data.fourth);
					$('.hidden').val(data.id);
					$('#update').modal('toggle');
				}
				
			});
		});
		
		
		$('#bed').submit(function(e){
			e.preventDefault();
			let id = $('.hidden').val();			
			let url = "{{route('bed.update')}}";
			
			$.ajax({
				url: url,
				type: 'POST',
				data:$('#bed').serialize(),
				success : function(data){
					$('#update').modal('toggle');
					$('span.count').html(data);
				}
			});
			
			
		});
		
		
		
		let floor = $('#floor');
		let room = $('#room_no');
		roomNo();
		
		floor.change(function(){
			$("#floor option[value='x']").remove();
			roomNo();
		});
		
		function roomNo(){
			if(floor.val() == 1){
				$('#room_no option').remove();
				for (let i = 1; i <= 100; i++) {
					room.append("<option value = "+i+">"+i+"</option>");
				}
			}else if(floor.val() == 2){
				$('#room_no option').remove();
				for (let i = 101; i <= 200; i++) {
					room.append("<option value = "+i+">"+i+"</option>");
				}
			}else if(floor.val() == 3){
				$('#room_no option').remove();
				for (let i = 201; i <= 300; i++) {
					room.append("<option value = "+i+">"+i+"</option>");
				}
			}
		}
		
	});
	
</script>
@endsection