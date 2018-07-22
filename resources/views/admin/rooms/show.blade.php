	@extends('layouts.app')
	@section('nav')
	@include('inc.nav-admin')
	@endsection
	
	@section('content')
	<div class="row">
		<div class="col-lg-9">
			<?php 
			$i = 0;
			foreach ($occupants as $occupant):?>
			<div class="row my-2">
				<div class="col-lg-8 order-lg-2">
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a href="" data-target="#personal<?=$i?>" data-toggle="tab" class="nav-link active">Personal Profile</a>
						</li>
						<li class="nav-item">
							<a href="" data-target="#school<?=$i?>" data-toggle="tab" class="nav-link">School Profile</a>
						</li>
						<li class="nav-item">
							<a href="" data-target="#messages<?=$i?>" data-toggle="tab" class="nav-link">Messages</a>
						</li>
						<li class="nav-item">
							<a href="" data-target="#edit<?=$i?>" data-toggle="tab" class="nav-link">Edit</a>
						</li>
					</ul>
					<div class="tab-content py-4">
						<div class="tab-pane active" id="personal<?=$i?>">
							<div class="row">
								<div class="col-md-6 col-lg-8">
									<h6 class = "font-weight-font-weight- text-danger">Full Name</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$occupant->user->name}} {{$occupant->user->surname}}</p>
									<h6 class = "font-weight-bold  text-danger">Email</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded email">{{$occupant->user->email}}</p>
									<h6 class = "font-weight-bold  text-danger">Gender</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded "><?= ($occupant->user->gender == 1) ? 'Male':'Female'?></p>
									<h6 class = "font-weight-bold  text-danger">Phone Number</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$occupant->user->phone}}</p>
									<h6 class = "font-weight-bold  text-danger">Address</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$occupant->user->address}}</p>
									<h6 class = "font-weight-bold  text-danger">State</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$occupant->user->state}}</p>
									<h6 class = "font-weight-bold  text-danger">Next of Kin Name</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$occupant->user->nok}}</p>
									<h6 class = "font-weight-bold  text-danger">Next of Kin Phone Number</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$occupant->user->nokno}}</p>
									<h6 class = "font-weight-bold  text-danger">Account Created on</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded ">{{date('M j, Y h:ia',strtotime($occupant->user->created_at))}}</p>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="school<?=$i?>">
							<div class="row">
								<div class="col-md-6 col-lg-8">
									<h6 class = "font-weight-bold  text-danger">Department</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$occupant->user->department}}</p>
									<h6 class = "font-weight-bold  text-danger">Registration Number</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$occupant->user->regno}}</p>
									<h6 class = "font-weight-bold  text-danger">Bed Location</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded ">{{$occupant->bed}}</p>
									<h6 class = "font-weight-bold  text-danger">Room Allocated on</h6>
									<p class="bg-secondary text-white p-1 pl-2 rounded ">{{date('M j, Y h:ia ',strtotime($occupant->created_at))}}</p>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="messages<?=$i?>">
							<table class="table table-hover table-striped">
								<tbody>                                    
									<tr>
										<td>
											<span class="float-right font-weight-bold">3 hrs ago</span> Here is your a link to the latest summary report from the..
										</td>
									</tr>
									<tr>
										<td>
											<span class="float-right font-weight-bold">Yesterday</span> There has been a request on your account since that was..
										</td>
									</tr>
								</tbody> 
							</table>
						</div>					
						<div class="tab-pane" id="edit<?=$i?>">
							{!!Form::open(['action' => ['RoomController@update', $occupant->user->id], 'method' => 'PUT'] )!!}
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">First name</label>
								<div class="col-lg-9">
									<input class="form-control" type="text" value="{{$occupant->user->name}}" name="name">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Last name</label>
								<div class="col-lg-9">
									<input class="form-control" type="text" value="{{$occupant->user->surname}}" name="surname">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Email</label>
								<div class="col-lg-9">
									<input class="form-control" type="email" value="{{$occupant->user->email}}" name="email">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Department</label>
								<div class="col-lg-9">
									<input class="form-control" type="text" value="{{$occupant->user->department}}" name="department">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Registration Number</label>
								<div class="col-lg-9">
									<input class="form-control" type="number" value="{{$occupant->user->regno}}" name="regno">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Phone Number</label>
								<div class="col-lg-9">
									<input class="form-control" type="text" value="{{$occupant->user->phone}}" name="phone">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Address</label>
								<div class="col-lg-9">
									<input class="form-control" type="text" value="{{$occupant->user->address}}" name="address">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">State</label>
								<div class="col-lg-9">
									<input class="form-control" type="text" value="{{$occupant->user->state}}" name="state">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Next of Kin Name</label>
								<div class="col-lg-9">
									<input class="form-control" type="text" value="{{$occupant->user->nok}}" name="nok"> 
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Next of Kin Number</label>
								<div class="col-lg-9">
									<input class="form-control" type="text" value="{{$occupant->user->nokno}}" name="nokno">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label"></label>
								<div class="col-lg-9">
									{{Form::submit('Save Changes',['class' =>'btn btn-warning font-weight-bold btn-block'])}}
									{!!Form::close()!!}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 order-lg-1 text-center py-3">
					<img src="/storage/passport/{{$occupant->user->passport}}" class="mx-auto img-fluid img-circle d-block" alt="avatar">
					<h6 class="mt-2">Upload a different photo</h6>
					{!!Form::open(['action' => ['RoomController@updatephoto', $occupant->user->id],'method' => 'PUT','enctype' => 'multipart/form-data'] )!!}
					<label class="custom-file">
						<input type="file" id="file" class="custom-file-input" name="passport">
						<span class="custom-file-control">Choose file</span>
					</label>
					{{Form::submit('Save Photo',['class' =>'btn btn-warning font-weight-bold btn-block mt-2'])}}
					{!!Form::close()!!}
				</div>
			</div>
			<?php
			$i += 1;
			endforeach ?>
		</div>
		<div class="col-lg-3">
			@if (count($occupants))
			<div class="sticky-top caps">
				<div class="card-header bg-secondary text-white">
					<h5 class="text-center">Room Details</h5>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
						<span class="font-weight-bold text-danger">Campus :</span>
						<span class="font-weight-bold pl-2">{{$occupants[0]->campus->name}}</span>
					</li>
					<li class="list-group-item">
						<span class="font-weight-bold text-danger">Hostel :</span>
						<span class="font-weight-bold pl-2">{{$occupants[0]->hostel->name}}</span>
					</li>
					<li class="list-group-item">
						<span class="font-weight-bold text-danger">Floor :</span>
						<span class="font-weight-bold pl-2">{{$occupants[0]->floor}}</span>
					</li>
					<li class="list-group-item">
						<span class="font-weight-bold text-danger">Room Number :</span>
						<span class="font-weight-bold pl-2">{{$occupants[0]->room_no}}</span>
					</li>
				</ul>
			</div>
			@endif
		</div>
		
	</div>
	
	@endsection