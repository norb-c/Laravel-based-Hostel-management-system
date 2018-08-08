@if (count($errors))
@foreach ($errors->all() as $error)
<div class="alert alert-danger alert-dismissable">
	<a class="panel-close close" data-dismiss="alert">×</a>{{$error}}
</div>
@endforeach
@endif

@if (session('success'))
<script>
	$(function(){
		var msg = "{{session('success')}}";
		toastr.success(msg);
	});
</script>
@endif
@if (session('error'))
<script>
	$(function(){
		var msg = "{{session('error')}}";
		toastr.success(msg);
	});
</script>
@endif

