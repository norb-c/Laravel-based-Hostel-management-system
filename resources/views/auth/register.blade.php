@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">{{ __('Register') }}</div>
			
			<div class="card-body">
				<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
					@csrf
					
					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
						
						<div class="col-md-6">
							<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autofocus>
							
							@if ($errors->has('name'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>
						
						<div class="col-md-6">
							<input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" >
							
							@if ($errors->has('surname'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('surname') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
						
						
						<div class="col-md-6">
							<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >
							
							@if ($errors->has('email'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="regno" class="col-md-4 col-form-label text-md-right">{{ __('Registration Number') }}</label>
						
						<div class="col-md-6">
							<input id="regno" type="number" class="form-control{{ $errors->has('regno') ? ' is-invalid' : '' }}" name="regno" value="{{ old('regno') }}" >
							
							@if ($errors->has('regno'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('regno') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
						
						<div class="col-md-6">
							<select class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" id="gender" name="gender" value="{{ old('gender') }}"  }}> 
								<option value=" "></option>
								<option value="1">Male</option>
								<option value="2">Female</option>
							</select>
							@if ($errors->has('gender'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('gender') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="campus_id" class="col-md-4 col-form-label text-md-right">{{ __('Campus') }}</label>
						
						<div class="col-md-6">
							<select class="form-control{{ $errors->has('campus_id') ? ' is-invalid' : '' }}" id="campus_id" name="campus_id" value="{{ old('campus_id') }}"  }}> 
								<option value=" "></option>
								<option value="1">Main Campus Ifite</option>
								<option value="2">Nnewi Campus</option>
								<option value="3">Agulu Campus</option>
							</select>
							@if ($errors->has('campus_id'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('campus_id') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>
						
						<div class="col-md-6">
							<input id="department" type="text" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" value="{{ old('department') }}" >
							
							@if ($errors->has('department'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('department') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
						
						<div class="col-md-6">
							<input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" >
							
							@if ($errors->has('phone'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('phone') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State of Origin') }}</label>
						
						<div class="col-md-6">
							<input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}" >
							
							@if ($errors->has('state'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('state') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Home Address') }}</label>
						
						<div class="col-md-6">
							<input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" >
							
							@if ($errors->has('address'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('address') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="nok" class="col-md-4 col-form-label text-md-right">{{ __("Next of Kin's Name") }}</label>
						
						<div class="col-md-6">
							<input id="nok" type="text" class="form-control{{ $errors->has('nok') ? ' is-invalid' : '' }}" name="nok" value="{{ old('nok') }}" >
							
							@if ($errors->has('nok'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('nok') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="nokno" class="col-md-4 col-form-label text-md-right">{{ __("Next of Kin's Phone Number") }}</label>
						
						<div class="col-md-6">
							<input id="nokno" type="text" class="form-control{{ $errors->has('nokno') ? ' is-invalid' : '' }}" name="nokno" value="{{ old('nokno') }}" >
							
							@if ($errors->has('nokno'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('nokno') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="row form-group">
						
						<label for="passport" class="col-md-4 col-form-label text-md-right">{{ __("Passport") }}</label>
						
						<div class="col-md-6">
							<input id="passport" type="file" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" value="{{ old('passport') }}" >
							
							@if ($errors->has('passport'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('passport') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					
					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
						
						<div class="col-md-6">
							<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
							
							@if ($errors->has('password'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif
						</div>
					</div>
					
					<div class="form-group row">
						<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
						
						<div class="col-md-6">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
						</div>
					</div>
					
					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary btn-block">
								{{ __('Register') }}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
