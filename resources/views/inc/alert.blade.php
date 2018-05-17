@if (count($errors))
	 @foreach ($errors->all() as $error)
		<div class="alert alert-danger alert-dismissable">
	<a class="panel-close close" data-dismiss="alert">×</a>{{$error}}
</div>
	 @endforeach
@endif

@if (session('success'))
<div class="alert alert-success alert-dismissable">
	<a class="panel-close close" data-dismiss="alert">×</a>{{session('success')}}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissable">
	<a class="panel-close close" data-dismiss="alert">×</a>{{session('error')}}
</div>
@endif

