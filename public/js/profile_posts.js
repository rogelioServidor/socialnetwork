$(document).ready(function(){
	doRun();
});


var newPost = '';
var comment = '';
var newComment = '';
var postId = 0;

function doRun(){

	$('#profile_posts').load(urlProfilePostsDisplay);

	$('#post_btn').on('click',function(){
		$.ajax({

			method:'POST',
			url:urlPost,
			data:{post:$('#post_body').val(), user_id:userId, _token:token}

		})
		.done(function(){
			$('#post_body').val('');
			$('#posts').load(urlProfilePostsDisplay);
		});
	});

}