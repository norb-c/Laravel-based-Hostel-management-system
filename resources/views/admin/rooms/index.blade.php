@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
{{-- @include('inc.modal') --}}
@endsection

@section('content')
<div class="row">
	<div class="col-md-7">
			<h4 class="text-center mb-5 mt-2 text-danger">List of Rooms in {{$hostel->name}}</h4>
		<table id = "room" class="table-bordered table-striped table">
			<thead class="table-primary">
				<th>Floor</th>
				<th>Room Num.</th>
				<th>Bed Space Avail.</th>
				<th>View</th>
			</thead>
			<tbody>
				@foreach ($rooms as $room)
				<tr class="<?= ($room->available == 0)? 'bg-danger-lighten': '' ?>">
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
						<span class="mx-3">{{$room->available}}</span>
					</td>
				<td><a href="{{route('rooms.show',$room->id)}}" class="btn btn-block btn-sm btn-outline-primary">View Occupants</a></td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
		
	</div>
	<div class="col-md-5">
		<div class="card mt-4">
			<div class="card-header text-center">
				Create Rooms
			</div>
			<div class="card-body">
				{{Form::open(['route' => 'rooms.store', 'method' => 'POST'])}}
				<div class=" form-group row">
					{{Form::label('campus', 'Campus:', ['class' => 'col-4 col-form-label text-md-left'])}}
					<div class="col">
						<select name="campus_id" id="campus" class="form-control" readonly>
							<option value="{{$hostel->campus->id}}">{{$hostel->campus->name}}</option>
						</select>
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('hostel', 'Hostel:', ['class' => 'col-4 col-form-label text-md-left'])}}
					<div class="col">
						<select name="hostel_id" id="hostel" class="form-control" readonly>
							<option value="{{$hostel->id}}">{{$hostel->name}}</option>
						</select>
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('type', 'Type:', ['class' => 'col-4 col-form-label text-md-left'])}}
					<div class="col">
						<select name="type" id="type" class="form-control" readonly>
							<option value="{{$hostel->type}}"><?= ($hostel->type == 1)? 'Male': 'Female' ?></option>
						</select>
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('floor', 'Floor:', ['class' => 'col-4 col-form-label text-md-left'])}}
					<div class="col">
						<select name="floor" id="floor" class="form-control">
							<option value="">Select Floor</option>
							<option value="1">First</option>
							<option value="2">Second</option>
							<option value="3">Third</option>
						</select>
					</div>
				</div>
				<div class=" form-group row">
					{{Form::label('room_no', 'Room No.:', ['class' => 'col-4 col-form-label text-md-left'])}}
					<div class="col">
						<select name="room_no" id="room_no" class="form-control">
							<option value="">Select Room Number</option>
						</select>
					</div>
				</div> 	   				
				<div class="form-group row">
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
		
		$('#room').DataTable();
		//remove the class for adding avail. room
		$('#update').on('hidden.bs.modal', function (e) {
			setTimeout(() => {
				$('span').removeClass('count');
			}, 250);
		})
		
		//updating the room with user_id
		$(".btnupd").click(function(){
			let token = "{{Session::token()}}";
			let id = $(this).data('id');
			let url = "{{ route("bed.edit") }}";
			//add a class to the element to be updated
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
		
		
		

		//generating room no
		let floor = $('#floor');
		let room = $('#room_no');
		roomNo();
		
		floor.change(function(){
			$("#floor option[value='']").remove();
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