<nav class="navbar navbar-expand-md navbar-light navbar-laravel mb-4">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/home') }}">
			{{ config('app.name', 'Laravel') }}
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">
				
			</ul>
			
			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@guest
				<li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
				<li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
				@else
				<a href="{{route('stdmsg.show',Auth::user()->id)}}" class="nav-link">Complains</a>
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						Hello {{ Auth::user()->name }} <span class="caret"></span>
					</a>
					
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a href="{{route('profile.show',Auth::user()->id)}}" class="dropdown-item">Profile</a>
						<a href="" class="dropdown-item">Change Password</a>
						<a class="dropdown-item" href="{{ route('user.logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</a>
					<form id="logout-form" action="{{ route('user.logout') }}" method="GET" style="display: none;">
						@csrf
					</form>
				</div>
			</li>
			@endguest
		</ul>
	</div>
</div>
</nav>
<script defer src="{{asset('js/fontawesome-all.min.js')}}"></script>