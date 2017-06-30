@forelse($posts as $post)
  <div class="media">
  <div class="media-left media-top">
    <img src="/uploads/images/profile_pic/{{$user->id}}.jpg" class="media-object post_pic">
  </div>
  <div class="media-body">
    <h4 class="media-heading">{{ $user->firstname }} {{ $user->lastname }}<small class="pull-right"><i>Posted {{ $post->created_at->diffForHumans() }}</i></small></h4>
    <p>{{ $post->post }}</p>

    <br>
    @foreach($post->comments as $comment)
		<div class="media">
			<div class="media-left media-top">
			<a href="{{ url('profile/'.$comment->user->id) }}">
				<img src="/uploads/images/profile_pic/{{$comment->user->id}}.jpg" class="media-object post_pic">
			</a>
			</div>
			<div class="media-body">
			<h4 class="media-heading">{{ $comment->user->firstname }} {{ $comment->user->lastname }}<small class="pull-right"><i>{{ $comment->created_at->diffForHumans() }}</i></small></h4>
			<p>{{ $comment->comment }}</p>

			<br>
			</div>
		</div>
	@endforeach
  </div>

  <div class="form-group col-md-11 col-md-offset-1 comment_box">
	<textarea class="form-control" placeholder="Comment" rows="2"></textarea>
	<div>
		<br>
		<button type="submit" class="btn btn-success enter_btn" data-postid="{{ $post->id }}">Enter</button>
	</div>
  </div>

</div>

<br>
<br>
@empty
	<p>Zero Post.</p>
@endforelse

<script src="{{ url('/js/profile_post_comment.js') }}"></script>