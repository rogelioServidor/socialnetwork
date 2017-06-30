@extends('layouts.master')

@section('title')
	Friend Request
@endsection

@section('content')
	<h3>Friend Request</h3>
	<hr>
	<table id="friend_request_tbl">
		@forelse($friendRequests as $friendRequest)
		<tr>
		<td>
		<h4>
			<a href="{{ url('profile/'.$friendRequest->users->id) }}">
			<img src="uploads/images/profile_pic/{{$friendRequest->users->id}}.jpg" class="requester_pic">
			</a>{{ $friendRequest->users->firstname }} {{ $friendRequest->users->lastname }}
		</h4>
		</td>
		<td>
		<button type="submit" class="btn btn-info rel_btn" data-user1="{{$friendRequest->user1}}" data-user2="{{$friendRequest->user2}}" data-action="{{$friendRequest->action_user_id}}" data-status="2">Confirm</button>
		</td>
		</tr>
		@empty
			<p>No Friend Request</p>
		@endforelse
	</table>

	<script>
		var urlUpdateRel = "{{ url('/updateRel') }}";
		var token = "{{ Session::token() }}";
		var userId = " {{ Auth::user()->id }} ";
	</script>
	<script src="{{ url('js/update_rel.js') }}"></script>

@endsection

