@extends('layouts.app')
@section('content')



<div class="row justify-content-between">
	<div class="col-md-5">
		<p>
			Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam nesciunt 
			atque incidunt porro. Dolores provident officiis quaerat sit nulla. Sunt molestiae 
			corrupti ipsam sapiente at repellat incidunt veritatis ab, praesentium magnam eius, 
			blanditiis saepe, ducimus laudantium optio quam placeat. Alias veniam qui aspernatu
			r maiores nemo asperiores molestiae fuga voluptas commodi voluptatibus fugit doloremque 
			<div class="form-group">
			<a href="{{route('register')}}" class="btn btn-lg btn-primary d-block">Register</a>
			</div>
		</p>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">{{ __('Login') }}</div>
			
			<div class="card-body">
				<form method="POST" action="{{ route('login') }}">
					@csrf
					
					<div class="form-group row">
						<label for="regno" class="col-sm-4 col-form-label text-md-right">{{ __('Reg. Number') }}</label>
						
						<div class="col-md-6">
							<input id="regno" type="number" class="form-control{{ $errors->has('regno') ? ' is-invalid' : '' }}" name="regno" value="{{ old('regno') }}" required autofocus>
							
							@if ($errors->has('regno'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
						
						<div class="col-md-6">
							<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
							
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
							<button type="submit" class="btn btn-primary">
								{{ __('Login') }}
							</button>
							
							<a class="btn btn-link" href="{{ route('password.request') }}">
								{{ __('Forgot Your Password?') }}
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection