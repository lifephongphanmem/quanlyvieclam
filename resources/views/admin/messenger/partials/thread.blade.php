<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="media alert {{ $class }}">
	<div class="row ">	
		<div class="col-sm-1">
		<input type="checkbox">
		</div>
		<div class="col-sm-3">			
		<h4 class="media-heading">
			<a href="{{URL::to('admessages').'/'. $thread->id}}">{{ $thread->subject }}</a>
			({{ $thread->userUnreadMessagesCount(Auth::id()) }} unread)</h4>
		</div>
		<div class="col-sm-6">	
		<p>
			{{ $thread->latestMessage->body }}
		</p>
		</div>
		<div class="col-sm-2">	
		<p>
			<small><strong>Người gửi:</strong> {{ $thread->creator()->name }}</small>
		</p>
		</div>
	</div>
</div>
