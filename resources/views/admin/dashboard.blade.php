@extends('layouts.app')
@section('nav')
	 @include('inc.nav-admin')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin DashBoard</div>

                <div class="card-body">
						  @component('components.who')
						  @endcomponent
                </div>
				</div>
				@foreach ($hostellers as $hosteller)
					 <p>{{$hosteller->user->email}}</p>
				@endforeach
        </div>
    </div>
</div>
@endsection
