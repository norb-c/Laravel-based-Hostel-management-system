@extends('layouts.app')
@section('nav')
@include('inc.nav')
@endsection


@section('content')
<div class="row">
	<div class="col parent">
		<div class="toggle h-100 w-100">
			<div class="h-100 w-100 ">
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
	</div>
	
	<div class="col-md-5">
		<div class="card">
			<div class="card-header text-center">
				Choose Hostel
			</div>
			<div class="card-body justify-content-center">
				{{Form::open(['id' => 'allocform'])}}
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
							<option value="{{$student->gender}}" ><?= ($student->gender == 1)? 'Male' : 'Female' ?></option>
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
		let name = "{{ $student->name.' '.$student->surname }}",
		email = "{{$student->email}}",
		campus = "{{$student->campus->name}}",
		phone = "{{$student->phone}}",
		reg = "{{$student->regno}}",
		depart = "{{$student->department}}",
		token = "{{Session::token()}}";
		
		//select box manipulation
		let 	campus_id = $('#campus_id'),
		type = $('#type'),
		hostel = $('#hostel_id'),
		floor = $('#floor'),
		room = $('#room_no'),
		selected = $("#floor option[value='x']"),
		submit  = $("input[type='submit']"),
		first = $('#first'),
		second = $('#second'),
		third = $('#third'),
		fourth = $('#fourth'),
		toggle = $('.toggle').detach(),
		disabled,
		hostelText,
		enabled,
		Space;
		
		toggle.css('display', 'block');
		function toggleBed(){
			if(toggle == null || toggle.length == 0){
				toggle = $('.toggle').detach();
			}
		}
		
		hostel.change(function(){
			toggleBed();
			//reset the following
			selected.attr('selected', '');
			room.html("<option value = ''>Select Room Number</option>").attr('disabled','');
			
			submit.attr('disabled', '');
			if(hostel.val()){
				floor.removeAttr('disabled');
			}else{
				//reset room_no and floor
				floor.attr('disabled', '');
				room.html("<option value = ''>Select Room</option>").attr('disabled','');
			}
			//clear the selected attr for reselection
			selected.removeAttr('selected');
			hostelText = $('option:selected', this).text();
		});
		
		floor.change(function(){
			toggleBed();
			let url = "{{route('allocate.getrooms')}}";
			submit.attr('disabled', '');
			room.html("<option value = ''>Select Room Number</option>").attr('disabled','');
			
			let data = {
				campus_id: campus_id.val(),
				type : type.val(),
				hostel_id: hostel.val(),
				floor: floor.val()
			}
			
			
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
		});
		
		room.change(function(){
			toggleBed();
			
			if(room.val()){
				submit.removeAttr('disabled');
			}else{
				submit.attr('disabled', '');
			}
			
		});
		
		//generate bed-spaces
		$('#allocform').submit(function(e){
			e.preventDefault();
			
			let uri = "{{route('allocate.getBed')}}";
			
			let data = {
				campus_id :campus_id.val(),
				type :type.val(),
				hostel_id: hostel.val(),
				floor: floor.val(),
				room_no : room.val()
			}
			
			
			$.ajax({
				method: 'GET',
				url: uri,
				data:data,
				success:function(data){
					if(toggle != null){
						toggle.appendTo($('.parent'));
					}
					toggle = null;
					$('.bed').off('click');
					
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
					enabled = $('a.bed:not(.disabled)');
					
					clickHandler();
					
				}
			});
		});
		
		//disable click on .disableds
		function clickHandler (){
			disabled.click(function(e){
				e.preventDefault();
			});
			
			enabled.click(function(e){
				
				e.preventDefault();
				let urii = "{{route('allocate.check')}}";
				//gets the space selected
				space = $(this).attr('id');
				let da = {
					campus_id:campus_id.val(),
					type:type.val(),
					hostel_id: hostel.val(),
					floor: floor.val(),
					room_no: room.val(),
					space: space
				}
				//checks the room is stil available
				$.ajax({
					method: 'GET',
					url:urii,
					data:da,
					success: function(data){
						if(data > 0){
							//error
							alert('Space has taken please refresh the page');
						}else if(data == 0){
							//add loading effects

							//paystack
							payWithPaystack();
							
						}
					}
				});
			});
		}
		
		function payWithPaystack(){
			var handler = PaystackPop.setup({
				key: 'pk_test_81e179b9b83f22f85a2c30c038cd957dbc21b369',
				email: email,
				amount: 10000,
				ref: ''+Math.floor((Math.random() * 1000000000) + 1), 
				metadata: {
					custom_fields: [{
						display_name: "Full Name",
						variable_name: "full_name",
						value: name
					}, {
						display_name: "Campus",
						variable_name: "campus",
						value:campus
					}, {
						display_name: "Hostel",
						variable_name: "hostel",
						value: hostelText
					},{
						display_name: "Department",
						variable_name: "department",
						value: depart
					},
					{
						display_name: "Registration Number",
						variable_name: "reg_no",
						value: reg
					},{
						display_name: "Phone Number",
						variable_name: "phone_no",
						value: phone
					}]
				},
				callback: function(response){
					let urll = "{{route('allocate.allocate')}}";
					let dat = {
						campus_id:campus_id.val(),
						hostel_id: hostel.val(),
						type:type.val(),
						floor: floor.val(),
						room_no: room.val(),
						space: space,
						receipt:response.reference,
						_token:token
					}
					$.ajax({
						method:'POST',
						url:urll,
						data:dat,
						success: function(data){
							//redirect
							console.log(data);
						}
					})
				},
				onClose: function(){
					alert('window closed');
				}
			});
			handler.openIframe();
		}
	});
</script>


@endsection