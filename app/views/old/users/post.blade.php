<div id="post_{{$post->post_id}}">
	<div>
		<div>
			@if($post->sex == "male")
				<img src="http://localhost:8000/images/man.jpg" style="float:left;width:10mm;">
			@else
				<img src="http://localhost:8000/images/woman.jpg" style="float:left;width:10mm;">
			@endif
			<p style="float:left;padding:10px;"><strong><a href="#">Anonymous</a>  Said: </strong> {{$post->post}}</p>
			<div style="clear:both;"></div>
		</div>
		<div style="padding:10px;">
			<a href="#" data-post-id="{{$post->post_id}}" class="like_button">
				@if(Like::wherePostId($post->post_id)->whereUserId(Session::get('username'))->whereLikeType('1')->get()->count())
				{{'Unlike'}}
				@else
				{{'Like'}}
				@endif
				</a>
				<a href="#" data-post-id="{{$post->post_id}}" class="dislike_button">
					@if(Dislike::wherePostId($post->post_id)->whereUserId(Session::get('username'))->whereDislikeType('1')->get()->count())
						{{'Undislike'}}
					@else
						{{'Dislike'}}
					@endif
				</a>
				<a href="#" data-post-id="{{$post->post_id}}" class="comments_button">Comments</a><br/>
				<p class="likeNumber">
					<span id="like_{{$post->post_id}}">{{Like::wherePostId($post->post_id)->whereLikeType('1')->get()->count()}}</span>
					Liked - 
				</p>
				<p class="dislikeNumber">
					<span id="dislike_{{$post->post_id}}">{{Dislike::wherePostId($post->post_id)->whereDislikeType('1')->get()->count()}}</span>
					Disliked
				</p>
		</div>
	</div>
	
	<div id="comments_{{$post->post_id}}" class="comments">
		{{Form::text('','',['class'=>'comment_button','data-post-id' => $post->post_id])}}
		<?php $comments = Comment::join('users','comments.user_id','=','users.user_id')->wherePostId($post->post_id)->orderBy('comment_id','desc')->get();?>
		@foreach($comments as $comment)
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
		@endforeach
	</div>
</div>