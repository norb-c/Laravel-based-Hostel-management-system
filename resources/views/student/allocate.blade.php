@extends('layouts.app')
@section('nav')
@include('inc.nav')
@endsection
@section('content')

<div class="row">
	<div class="col bg-ash ">
		<a href="#" class="first">
			<div class="d-inline-block bg-success h-25 w-25 m-3 ">
				<h1 class="text-light d-inline-block center-me">A</h1>
			</div>
		</a>
		<a href="#" class="second">
			<div class="d-inline-block bg-success h-25 w-25 m-3 ">
				<h1 class="text-light d-inline-block center-me">B</h1>
			</div>
		</a>
		<a href="#" class="third">
			<div class="d-inline-block bg-success h-25 w-25 m-3 ">
				<h1 class="text-light d-inline-block center-me">C</h1>
			</div>
		</a>
		<a href="#" class="fourth">
			<div class="d-inline-block bg-success h-25 w-25 m-3 ">
				<h1 class="text-light d-inline-block center-me">D</h1>
			</div>
		</a>
	</div>
	
	<div class="col-md-5">
		<div class="card">
			<div class="card-header text-center">
				Choose Hostel
			</div>
			<div class="card-body justify-content-center">
				{{Form::open(['id' => 'allocate'])}}
				<div class=" form-group row">
					{{Form::label('campus_id', 'Campus:', ['class' => 'col-3 col-form-label text-md-left'])}}
					<div class="col">
						<select name="campus_id" id="campus_id" class="form-control" readonly>
							<option value="{{$student->campus->id}}">{{$student->campus->name}}</option>
						</select>
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('type', 'Type:', ['class' => 'col-3 col-form-label text-md-left'])}}
					<div class="col">
						<select name="type" id="type" class="form-control" readonly>
							<option value="{{$student->type}}"><?= ($student->gender == 1)? 'Male' : 'Female' ?></option>
						</select>
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('hostel_id', 'Hostel:', ['class' => 'col-3 col-form-label text-md-left'])}}
					<div class="col">
						<select name="hostel_id" id="hostel_id" class="form-control" >
							<option value="">Select Hostel</option>
							@foreach ($hostels as $hostel)
							<option value="{{$hostel->id}}">{{$hostel->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class=" form-group row">
					{{Form::label('floor', 'Floor:', ['class' => 'col-3 col-form-label text-md-left'])}}
					<div class="col" >
						<select name="floor" id="floor" class="form-control" disabled>
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
						<select name="room_no" id="room_no" class="form-control" disabled>
							<option value="">Select Room Number</option>
						</select>
					</div>
				</div>
				
				<div class="form-group row mt-5">
					<div class="col-3"></div>
					<div class="col">
						<input type="submit" value="Show Available Bed Space" class="btn btn-block btn-success" disabled>
					</div>
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>
</div>

<script>
	
	$(function(){
		
		
		//select box manipulation
		
		let hostel = $('#hostel_id');
		let floor = $('#floor');
		let room = $('#room_no');
		let selected = $("#floor option[value='x']")
		let submit  = $("input[type='submit']");
		
		hostel.change(function(){
			//reset the floor option
			selected.attr('selected', '');
			if(hostel.val()){
				floor.removeAttr('disabled');
			}else{
				//reset room_no and floor
				floor.attr('disabled', '');
				room.html("<option value = ''>Select Room</option>").attr('disabled','');
			}
			selected.removeAttr('selected');
		});
		
		floor.change(function(){
			let url = "{{route('allocate.getfloor')}}";
			let data = {
				hostel_id: hostel.val(),
				floor: floor.val()
			}
			
			room.html("<option value = ''>Select Room</option>").attr('disabled','');
			$.ajax({
				method: 'GET',
				url:url,
				data: data,
				success: function(data){
					room.removeAttr('disabled');
					$.each(data, function(key, value){
						room.append('<option value = '+value+ '>'+value+'</option>');
					});
				}
			});
			
			room.change(function(){
				if(room.val()){
					submit.removeAttr('disabled');
				}else{
					submit.attr('disabled', '');
				}
			});
			
		});
		
		
		$('#allocate').submit(function(e){
			e.preventDefault();
			let uri = "{{route('allocate.getBed')}}";
			data = {
				hostel_id: hostel.val(),
				floor: floor.val(),
				room_no: room.val(),
			}
			$.ajax({
				method: 'GET',
				url: uri,
				data:data,
				success:function(data){
					
				}
			});
		});
		
		
	});
</script>


@endsection