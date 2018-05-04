

@if (Auth::guard('web')->check())
<p class="text-success">
	You are <strong>Logged in </strong>as a <strong>USER</strong>
</p>
@else
<p class="text-danger">
	You are <strong>Logged Out USER</strong>
</p>

@endif

@if (Auth::guard('admin')->check())
<p class="text-success">
	You are <strong>Logged in </strong>as an <strong>ADMIN</strong>
</p>
@else
<p class="text-danger">
	You are <strong>Logged Out as an ADMIN</strong>
</p>

@endif