<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('inc.head')
<body>
	<div id="app">
		@if (Route::getCurrentRoute()->uri() === '/')
		
		@include('inc.slide')
		
		@else
		
		@yield('nav')
		
		@include('inc.alert')
		
		@endif
		
		<div class="container mb-5">
			<div class="row result-parent">
			</div>
			@yield('content')
			
		</div>
		
	</div>
</body>
</html>
