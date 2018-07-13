@extends('layouts.app')
@section('nav')
@include('inc.nav-admin')
@endsection

@section('content')
<div class="row">
	@foreach($campus as $camp)
		Name: {{$camp->name}} <br>
		@foreach ($camp->hostels as $hostel)
			 Hostel: {{$hostel->name}} <br>
		@endforeach
	@endforeach


</div>
@endsection