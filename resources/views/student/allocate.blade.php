@extends('layouts.app')
@section('nav')
@include('inc.nav')
@endsection
@section('content')

<div class="row">
	<div class="col">
		<div class="bed-none h-100 w-100">
			<a href="" id = "first" class="bed d-inline-block bg-success h-25 w-25 m-3">
				<h1 class="text-center text-light">A</h1>
			</a>
			<a href="" id = "second" class="bed d-inline-block bg-success h-25 w-25 m-3">
				<h1 class="text-center text-light">B</h1>
			</a>
			<a href="" id = "third" class="bed d-inline-block  bg-success h-25 w-25 m-3">
				<h1 class="text-center text-light">C</h1>
			</a>
			<a href="" id = "fourth" class="bed d-inline-block bg-success h-25 w-25 m-3">
				<h1 class="text-center text-light">D</h1>
			</a>
		</div>
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
		let first = $('#first');
		let second = $('#second');
		let third = $('#third');
		let fourth = $('#fourth');
		let bed = $('.bed-none');
		let disabled;
		let notDisabled;
		let Space;
		
		
		
		hostel.change(function(){
			bed.removeClass('bed-display');
			bed.addClass('bed-none');
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
			bed.removeClass('bed-display');
			bed.addClass('bed-none');
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
				bed.removeClass('bed-display');
				bed.addClass('bed-none');
				if(room.val()){
					submit.removeAttr('disabled');
				}else{
					submit.attr('disabled', '');
				}
			});
			
		});
		
		
		//generate bed-spaces
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
					bed.removeClass('bed-none');
					bed.addClass('bed-display');
					
					if(data.first > 0){
						first.addClass('disabled');
						first.removeClass('bg-success');
					}else{
						first.removeClass('disabled');
						first.addClass('bg-success');
					}
					if(data.second > 0){
						second.addClass('disabled');
						second.removeClass('bg-success');
					}else{
						second.removeClass('disabled');
						second.addClass('bg-success');
					}
					if(data.third > 0){
						third.addClass('disabled');
						third.removeClass('bg-success');
					}else{
						third.removeClass('disabled');
						third.addClass('bg-success');
					}
					if(data.fourth > 0){
						fourth.addClass('disabled');
						fourth.removeClass('bg-success');
					}else{
						fourth.removeClass('disabled');
						fourth.addClass('bg-success');
					}
					disabled = $('.disabled');
					notDisabled = $('a.bed:not(.disabled)');
					clickHandler();
					
				}
			});
		});
		//disable click on .disableds
		function clickHandler (){
			disabled.click(function(e){
				e.preventDefault();
			});

			notDisabled.click(function(e){
				e.preventDefault();
				//gets the space selected
				space = $(this).attr('id');
			});
		}
		
	});
</script>


@endsection