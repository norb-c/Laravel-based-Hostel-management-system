<nav class="navbar navbar-expand-md navbar-light navbar-laravel mb-4">
	<div class="container">
		<a class="navbar-brand" href="{{route('admin.dashboard')}}">Home</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">
				<li class="nav-item ">
					<a class="nav-link" href="{{route('hostels.index')}}">Hostels</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="{{route('adminmsg.index')}}">Messages</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="{{route('report.index')}}">Stats &amp; Reports</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="{{route('admin.admins')}}">Adminstrators</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="{{route('admin.notifyindex')}}">Notifications</a>
				</li>
			</ul>
			
			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search Students by Name" aria-label="Search">
					<button class="btn btn-search my-2 my-sm-0"><i class="fas fa-search"></i></button>
				</form>
				<!-- Authentication Links -->
				<li class="nav-item dropdown ml-3">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						Welcome {{ Auth::user()->name }} <span class="caret"></span>
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
<script>
	$(function(){
		
		let token = "{{Session::token()}}";
		let search = $("input[type='search']");
		let url = "{{route('admin.student.search')}}";
		
		search.keyup(function () {
			
			let nametrim = $.trim(search.val());
			
			if(nametrim.length > 2){
				ajaxsearch(nametrim, url);
			}else if(nametrim.length == 0){
				$('.result-child').remove();
			}
			clickfunction();
		});
		
		$('.btn-search').click(function(e){
			e.preventDefault();
			let nametrim = $.trim(search.val());
			
			if(nametrim.length > 0){
				ajaxsearch(nametrim, url);
			}
		});
		
		function ajaxsearch(nametrim, url){
			let data = {
				name: nametrim,
				_token: token
			}
			
			$.ajax({
				method: 'POST',
				url: url,
				data: data,
				success: function (data) {
					if(data.length == 0){
						$('.result-parent')
						.html("<div class='col-md-6 offset-md-6 result-child'><div class='card'><ul class='list-group list-group-flush'><li class='list-group-item'>No Student Found</li></ul></div></div>");
					}else{
						let result = [];
						result.push("<div class='col-md-6 offset-md-6 result-child'>",
							"<div class='card'><ul class='list-group list-group-flush'>");
								for(let i = 0; i < data.length; i++){
									result.push("<a href ='/admin/student/show/"+data[i].id+"' class='list-group-item'><li><i class = 'fas fa-users'></i>",
										"<span class ='result-name'>"+ data[i].name +" "+ data[i].surname +"</span><span class='result-xtra'>",
											+ data[i].regno +"</span></li></a>",)
										}
										result.push("</ul></div></div>");
										$('.result-parent').html(result.join(''));
									}
								}
							});
						}
						
						function clickfunction(){
							$(".container").click(function(){
								search.val('');
								$('.result-child').remove();
							});
						}
					});
				</script>