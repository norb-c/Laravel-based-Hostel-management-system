@extends('layouts.app')
@section('nav')
	 @include('inc.nav')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">UsersDashboard</div>
					
                <div class="card-body">
                   @component('components.who')
						 @endcomponent
					 </div>
					 {{print_r($hosteller->campus->name)}}
            </div>
        </div>
    </div>
</div>
@endsection
