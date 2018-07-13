@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="dash-parent">
			<a href="{{route('hostels.index')}}" class="row dash align-items-center" style="background-color:#2BBBAD;">
				<div class="col-12">
					<p class="text-center"><i class="fas fa-home test"></i></p>
				</div>
				<div class="col-12">
					<h3 class="text-center">Hostels</h3>
				</div>
				
			</a>
			<a href="{{route('adminmsg.index')}}" class="row dash align-items-center" style="background-color:#e65100;">
				<div class="col-12">
					<p class="text-center"><i class="fas fa-home test"></i></p>
				</div>
				<div class="col-12">
					<h3 class="text-center">Messages</h3>
				</div>
			</a>
			<a href="#" class="row dash align-items-center">
				<div class="col-12">
					<p class="text-center"><i class="fas fa-home test"></i></p>
				</div>
				<div class="col-12">
					<h3 class="text-center">Lorem, ipsum.</h3>
				</div>
				
			</a>
			<a href="#" class="row dash align-items-center" style="background-color:#4B515D;">
				<div class="col-12">
					<p class="text-center"><i class="fas fa-home test"></i></p>
				</div>
				<div class="col-12">
					<h3 class="text-center">Profile</h3>
				</div>
				
			</a>
			<a href="{{route('report.index')}}" class="row dash align-items-center" style="background-color:#3F729B;">
				<div class="col-12">
					<p class="text-center"><i class="fas fa-home test"></i></p>
				</div>
				<div class="col-12">
					<h3 class="text-center">Statistics &amp; Report</h3>
				</div>
				
			</a>
			<a href="#" class="row dash align-items-center">
				<div class="col-12">
					<p class="text-center"><i class="fas fa-home test"></i></p>
				</div>
				<div class="col-12">
					<h3 class="text-center">Lorem, ipsum.</h3>
				</div>
				
			</a>
		</div>
		
	</div>
</div>
@endsection
