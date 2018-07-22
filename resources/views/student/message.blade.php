@extends('layouts.app')
@section('nav')
@include('inc.nav')
@include('inc.msg-modal')
@endsection

@section('content')
<div class="row">
	<div class="col-lg-3 col-md-3">
		<div class="my-4">
			<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#message">Make new Complain</button>
		</div>
	</div>
	
	<div class="col-lg-9 order-lg-2">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a href="" data-target="#sent" data-toggle="tab" class="nav-link active">Sent Complains</a>
			</li>
			<li class="nav-item">
				<a href="" data-target="#recieved" data-toggle="tab" class="nav-link">Replies</a>
			</li>
		</ul>
		<div class="tab-content py-4">
			<div class="tab-pane active" id="sent">
				<table class="table table-striped">
					<tbody class="sent">
						@if (count($sentmsg))
						@foreach ($sentmsg as $msg)
						<tr>
							<td class=" p-0 px-3">
								<input type="hidden" name="id" value = "{{$msg->id}}">
								<div class="row">
									<div class="col-1 p-0 text-center align-self-center">
										<a href="#" class="btn-sm btn text-danger sentdel"><i class="fas fa-trash"></i></a>
									</div>
									<div class="col p-2">
										{{$msg->message}}
										<span class="float-right font-weight-bold text-danger">{{date('M j, h:ia ',strtotime($msg->created_at))}}</span>
									</div>
								</div>
							</td>
						</tr>
						@endforeach
						@else
						<tr class="holder">
							<td class="text-danger font-weight-bold">
								The complains you made will show up here.
							</td>
						</tr>
						@endif
						
					</tbody> 
				</table>
				{{$sentmsg->links()}}
			</div>
			<div class="tab-pane" id="recieved">
				<table class="table table-striped">
					<tbody class="recieve">
						@if (count($recmsg))
						@foreach ($recmsg as $msg)
						<tr>
							<td class="notify-parent p-0 px-3">
								@if ($msg->stdview == 0)
								<span class="badge badge-pill badge-danger notify-std">!</span>
								@endif
								<input type="hidden" name="id" value = "{{$msg->id}}">
								
								<div class="row">
									<div class="col-1 p-0 text-center align-self-center">
										<a href="#" class="btn-sm btn text-danger recdel"><i class="fas fa-trash"></i></a>
									</div>
									<div class="col p-2">
										@if ($msg->stdview == 1)
										{{$msg->message}}
										@else
										{{$msg->message}} <button  class="btn btn-sm btn-success ml-3 read">Mark as Read</button>
										@endif					
										<span class="float-right font-weight-bold text-danger">{{date('M j, h:ia ',strtotime($msg->created_at))}}</span>
									</div>
								</div>
							</td>
						</tr>
						@endforeach
						@else
						<tr>
							<td class="text-danger font-weight-bold">
								Replies to your complains will show up here.
							</td>
						</tr>
						@endif
					</tbody> 
				</table>
				{{$recmsg->links()}}
			</div>
		</div>
	</div>
</div>
<script>
	$(function(){
		let token = "{{Session::token()}}";
		
		$('#message-text').keydown(function(){
			let value =  $('#message-text').val();
			let remain = 140 - value.length;
			$('.count').html(remain);
		});
		
		
		$('#msg').submit(function(e){
			let msgval = $('#message-text').val();;
			e.preventDefault();
			$('#message').modal('toggle');
			let url = "{{route('stdmsg.store')}}";
			
			if(msgval.length > 140){
				alert('Message too long');
				return false;
			}
			
			let data = $('#msg').serialize();
			$('#message-text').val('');
			
			$.ajax({
				method: 'POST',
				url:url,
				data:data,
				success: function(data){
					if($('.holder').length == 1){
						$('.holder').remove();
					}
					deleteNew(data);
				},
				error: function(){
					console.log('Error Occured');
				}
			});
		});
		
		$('.read').click(function(e){
			let readbtn = $(this);
			let alert = readbtn.parents('.row').siblings('span');
			let id = readbtn.parents('.row').siblings('input').val();
			let uri = "{{route('stdmsg.read')}}";
			
			let dat = {
				id:id,
				_token: token,
			};
			
			$.ajax({
				method:'POST',
				url:uri,
				data:dat,
				success: function(data){
					readbtn.remove();
					alert.remove();
				},
				error:function(){
					alert('An error Ocurred');
				}
			});
		});
		
		$('.sentdel').click(function(e){
			e.preventDefault();
			
			let uri = "{{route('stdmsg.sentdel')}}";
			let parents = $(this).parents('tr');
			let id = $(this).parents('.row').siblings('input').val();
			let dat = {
				id:id,
				_token: token,
			}
			
			$.ajax({
				method: 'POST',
				url:uri,
				data:dat,
				success: function(data){
					parents.remove();
					if($('.sent').children().length == 0){
						$('.sent').html("<tr><td class='text-danger font-weight-bold'>The complains you made will show up here.</td></tr>");
					}
				},
				error: function(){
					alert('An error Occurred');
				}
			});
		});
		
		$('.recdel').click(function(e){
			e.preventDefault();
			let parents = $(this).parents('tr');
			let id = $(this).parents('.row').siblings('input').val();
			let dat = {
				id:id,
				_token: token,
			}
			
			let uri = "{{route('stdmsg.recdel')}}";
			$.ajax({
				method: 'POST',
				url:uri,
				data:dat,
				success: function(data){
					parents.remove();
					if($('.recieve').children().length == 0){
						$('.recieve').html("<tr><td class='text-danger font-weight-bold'>Replies to your complains will show up here.</td></tr>");
					}
				},
				error: function(){
					alert('An error Occurred');
				}
			});
		});
		
		function deleteNew(data){
			$('.sent').prepend("<tr><td class='p-0 px-3'><div class='row'><div class='col-1 p-0 text-center align-self-center'><a href='' class='btn-sm btn text-danger delnew'><i class='fas fa-trash'></i></a></div><div class='col p-2'>"+data.message+"<span class='float-right font-weight-bold text-success'>Just Now</span></div></div></td></tr>");
			
			$('.delnew').click(function(e){
				e.preventDefault();
				let uri = "{{route('stdmsg.sentdel')}}";
				let parents = $(this).parents('tr');

				let dat = {
					id:data.id,
					_token: token,
				}
				
				$.ajax({
					method: 'POST',
					url:uri,
					data:dat,
					success: function(data){
						parents.remove();
						if($('.sent').children().length == 0){
							$('.sent').html("<tr><td class='text-danger font-weight-bold'>The complains you made will show up here.</td></tr>");
						}
					},
					error: function(){
						alert('An error Occurred');
					}
				});
			});
		}
		
	});
	
</script>
@endsection
