<div class="comment">
	<div>
		@if($comment->sex == "male")
			<img src="http://localhost:8000/images/man.jpg" style="float:left;width:10mm;">
		@else
			<img src="http://localhost:8000/images/woman.jpg" style="float:left;width:10mm;">
		@endif
		<p style="float:left;padding:10px;"><strong><a href="#">Anonymous</a>  Comment: </strong> {{{$comment->comment}}}}</p>
		<div style="clear:both;"></div>
	</div>
	<a href="#" data-comment-id="{{$comment->comment_id}}" class="likeForComment">
		@if(Like::wherePostId($comment->comment_id)->whereUserId(Session::get('username'))->whereLikeType('2')->get()->count())
		{{'Unlike'}}
		@else
		{{'Like'}}
		@endif
	</a>
	<a href="#" data-comment-id="{{$comment->comment_id}}" class="dislikeForComment">
		@if(Dislike::wherePostId($comment->comment_id)->whereUserId(Session::get('username'))->whereDislikeType('2')->get()->count())
			{{'Undislike'}}
		@else
			{{'Dislike'}}
		@endif
	</a><br/>
	<p class="likeNumber">
		<span id="likeComment_{{$comment->comment_id}}">{{Like::wherePostId($comment->comment_id)->whereLikeType('2')->get()->count()}}</span>
		Liked - 
	</p>
	<p class="dislikeNumber">
		<span id="dislikeComment_{{$comment->comment_id}}">{{Dislike::wherePostId($comment->comment_id)->whereDislikeType('2')->get()->count()}}</span>
		Disliked
	</p>
</div>