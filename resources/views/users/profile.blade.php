@extends('layouts.master')

@section('title')
	Profile
@endsection

@section('content')
<div class="col-md-3">
	<div id="profile_pic">
		<img class="img-responsive" src="/uploads/images/profile_pic/{{$user->id}}.jpg" alt="profile picture">
	</div>

	<br>

	<a class="btn btn-primary" href="{{ url('/messages') }}">Send Message</a>
</div>

<div class="col-md-9">
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
	<div id="profile_posts"></div>

	<br><br>
</div>

<script>
	var userId = "{{ Auth::user()->id }}";
	var token = "{{ Session::token() }}";
	var urlPost = "{{ url('/addPost') }}";
	var urlComment = "{{ url('/addComment') }}";
	var urlProfilePostsDisplay = "{{ url('/profileposts/'.$user->id) }}";
</script>

<script type="text/javascript" src="{{ url('js/profile_posts.js') }}"></script>
@endsection