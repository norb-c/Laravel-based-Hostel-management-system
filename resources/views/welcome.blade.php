@extends('layouts.app')
@section('content')

<div class="row justify-content-between">
	<div class="col-md-6 bg-white msg-card pb-3">
		<div class="row head-color">
			<div class="col-2 mt-3 mb-2">
				<img src="{{asset('image/logo.png')}}" alt="logo" class="img-logo">
			</div>
			<div class="col-9 line mb-2">
				<h3 class="text-center h3 text-shadow mt-3">Nnamdi Azikiwe Hostel Management Portal</h3>
			</div>
		</div>
		<div>
			<h6 class="font-weight-bold text-danger">Welcome to Nnamdi Azikiwe University hostel portal. For new applicatants take the steps listed below.</h6>
			<ul>
				<li>Click Register and put in your Details.Remember to choose the campus where you are</li>
				<li>Select from the available hostel, floor, and bed spaces</li>	
				<li>Make payments, an email will be sent to you which will contain your room details.</li>
			</ul>
		</div>
		<h6 class="text-danger text-center font-weight-bold">Already Registered ?, Login instead</h6>
		<div class="row">
			<div class="col-12">
				<a href="{{route('register')}}" class="btn btn-shadow btn-primary d-block">Register</a>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card card-shadow">
			<div class="card-header">
				<h3 class="deep-grey-text text-center">Log in</h3>
			</div>
			
			<div class="card-body">
				<form method="POST" action="{{ route('login') }}">
					@csrf
					
					<div class="form-group row">
						<label for="regno" class="col-sm-4 col-form-label text-md-right">{{ __('Reg. Number') }}</label>
						
						<div class="col-md-6">
							<input placeholder="Your Registration Number" id="regno" type="number" class="form-control{{ $errors->has('regno') ? ' is-invalid' : '' }}" name="regno" value="{{ old('regno') }}" required autofocus>
							
							@if ($errors->has('regno'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('regno') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
						
						<div class="col-md-6">
							<input placeholder = "Your Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
							
							@if ($errors->has('password'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-md-6 offset-md-4">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
								</label>
							</div>
						</div>
					</div>
					
					<div class="form-group row mb-0">
						<div class="col-md-8 offset-md-4">
							<div class="row">
								<div class="col-12">
									<button type="submit" class="btn-shadow btn btn-block btn-success">
										{{ __('Login') }}
									</button>
								</div>
								<div class="col-12 mr-3">
									<a class="btn btn-link text-danger" href="{{ route('password.request') }}">
										{{ __('Forgot Your Password?') }}
									</a>
								</div>
							</div>							
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection