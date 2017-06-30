@extends('layouts.master')

@section('title')
	Social Network - Home
@endsection

@section('content')
	<div class="col-md-3">
		<div id="profile_pic">
			<img class="img-responsive" src="uploads/images/profile_pic/{{Auth::user()->id}}.jpg" alt="profile picture">
		</div>

		<br>

		<div>
			<ul class="list-group">
  			<li class="list-group-item list-group-item-info"><a href="{{ url('/messages') }}">Messages</a><span class="badge">12</span></li>
  			<li class="list-group-item list-group-item-info"><a href="{{ url('/friendRequest') }}">Friend Requests</a><span class="badge">{{ $friendRequest->count() }}</span></li>
			</ul>
		</div>
	</div>
	<div class="col-md-6">

		<div class="form-group {{ $errors->has('post') ? 'has-error' : '' }}">
			<input type="hidden" name="user_id" value="1">
			<textarea id="post_body" class="form-control" name="post" placeholder="Write Post" rows="8"></textarea>
			@if($errors->has('post'))
				<span class="help-block">
					{{ $errors->first('post') }}
				</span>
			@endif
		</div>
		<button type="submit" id="post_btn" class="btn btn-primary btn-lg pull-right">Post</button>

		<br><br><hr><br><br>	
		
		<!-- display all posts -->
		<div id="posts"></div>

		<br><br>


		<script>
			var userId = "{{ Auth::user()->id }}";
			var token = "{{ Session::token() }}";
			var urlPost = "{{ url('/addPost') }}";
			var urlComment = "{{ url('/addComment') }}";
			var urlDisplayPosts = "{{ url('/posts') }}";
		</script>

		<script type="text/javascript" src="{{ url('js/main.js') }}"></script>
	</div>
@endsection