@extends('layouts.app')
@section('nav')
@include('inc.nav')
@include('inc.msg-modal')
@endsection

@section('content')
<div class="row">
	<div class="col-lg-3 col-md-3">
		<div class="my-4">
			<button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#message">Make new Complain</button>
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
				<table class="table table-hover table-striped">
					<tbody class="sent">
						@if (count($sentmsg))
						@foreach ($sentmsg as $msg)
						<tr>
							<td>
								{{$msg->message}}<span class="float-right font-weight-bold text-danger">{{date('M j, Y h:ia ',strtotime($msg->created_at))}}</span>
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
				<table class="table table-hover table-striped">
					<tbody>
						@if (count($recmsg))
						@foreach ($recmsg as $msg)
						<tr>
							<td>
								<div>{{$msg->message}}</div><span class="float-right font-weight-bold text-danger">{{date('M j, Y h:ia ',strtotime($msg->created_at))}}</span>
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
					$('.sent').prepend("<tr><td>"+data.message+"<span class='float-right font-weight-bold text-success'>Just Now</span></td></tr>");
				},
				error: function(){
					console.log('Error Occured');
				}
			});
		});
		
	});
</script>
@endsection
