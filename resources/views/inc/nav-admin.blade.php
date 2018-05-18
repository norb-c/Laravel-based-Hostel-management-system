<nav class="navbar navbar-expand-md navbar-light navbar-laravel mb-4">
	<div class="container">
		<a class="navbar-brand" href="{{route('admin.dashboard')}}">DashBoard</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="{{route('hostels.index')}}">Hostels</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="{{route('adminmsg.index')}}">Complains</a>
				</li>
			</ul>
			
			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							Hello {{ Auth::user()->name }} <span class="caret"></span>
					</a>
					
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ route('admin.logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</a>
					
					<form id="logout-form" action="{{ route('admin.logout') }}" method="GET" style="display: none;">
						@csrf
					</form>
				</div>
			</li>
		</ul>
	</div>
</div>
</nav>
<script src="{{ asset('js/datatables.min.js') }}"></script>

 
