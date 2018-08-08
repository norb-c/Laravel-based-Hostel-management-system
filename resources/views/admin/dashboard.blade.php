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
					<h3 class="text-center">Hostels, Rooms &amp; Students</h3>
				</div>
				
			</a>
			<a href="{{route('adminmsg.index')}}" class="row dash align-items-center" style="background-color:#e65100;">
				<div class="col-12">
					<p class="text-center"><i class="fas fa-comments test"></i></p>
				</div>
				<div class="col-12">
					<h3 class="text-center">Messages</h3>
				</div>
			</a>
			<a href="{{route('report.index')}}" class="row dash align-items-center" style="background-color:#3F729B;">
				<div class="col-12">
					<p class="text-center"><i class="fas fa-chart-bar test"></i></p>
				</div>
				<div class="col-12">
					<h3 class="text-center">Statistics &amp; Reports</h3>
				</div>
				
			</a>
			<a href="{{route('admin.notifyindex')}}" class="row dash align-items-center" style="background-color:#4B515D;">
				<div class="col-12">
					<p class="text-center"><i class="fas fa-user test"></i></p>
				</div>
				<div class="col-12">
					<h3 class="text-center">Notifications</h3>
				</div>
			</a>
			
			<a href="{{route('admin.admins')}}" class="row dash align-items-center" style="background-color: #007E33">
				<div class="col-12">
					<p class="text-center"><i class="fas fa-users test"></i></p>
				</div>
				<div class="col-12">
					<h3 class="text-center">Hostel Administrators</h3>
				</div>
				
			</a>
			
			<a href="{{ route('admin.logout') }}" class="row dash align-items-center bg-danger"
			onclick="event.preventDefault();
			document.getElementById('logout-form').submit();">
			<div class="col-12">
				<p class="text-center"><i class="fas fa-power-off test"></i></p>
			</div>
			<div class="col-12">
				<h3 class="text-center">Logout</h3>
			</div>
			<form id="logout-form" action="{{ route('admin.logout') }}" method="GET" style="display: none;">
				@csrf
			</form>
		</a>
	</div>
	
</div>
</div>

@endsection
