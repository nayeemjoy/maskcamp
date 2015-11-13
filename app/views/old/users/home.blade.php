@extends('layouts.default')
@section('title')
	Users Area
@stop
@section('content')
	<div class="container">
		<div style="float:left; padding:20px;">
			@if($user->sex == "male")
				<img src="images/man.jpg" style="width:50mm;">
			@else
				<img src="images/woman.jpg" style="width:50mm;">
			@endif
			<h2>Hello {{Session::get('username')}}</h2>
		</div>
		<div style="float:left;width:150mm; padding:10px;">
			<h3>Write Somethig.</h3>
			<div>
				{{Form::text('post','',['id' => 'post'])}}
				{{Form::submit('Post', ['id'=>'post_button'])}}
			</div>
			<div>
			<h2>Recent Posts.</h2>
			<div id="posts">
				@foreach($posts as $post)
					<div id="post_{{$post->post_id}}">
						<div>
							<div>
								@if($post->sex == "male")
									<img src="images/man.jpg" style="float:left;width:10mm;">
								@else
									<img src="images/woman.jpg" style="float:left;width:10mm;">
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
										<img src="images/man.jpg" style="float:left;width:10mm;">
									@else
										<img src="images/woman.jpg" style="float:left;width:10mm;">
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
				@endforeach
			</div>
			<h2>Your Post.</h2>
			<div id="posts_of_yours">
				@foreach($posts_of_yours as $post)
					<div id="post_{{$post->post_id}}">
						<div>
							<div>
								@if($post->sex == "male")
									<img src="images/man.jpg" style="float:left;width:10mm;">
								@else
									<img src="images/woman.jpg" style="float:left;width:10mm;">
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
										<img src="images/man.jpg" style="float:left;width:10mm;">
									@else
										<img src="images/woman.jpg" style="float:left;width:10mm;">
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
				@endforeach
			</div>
			</div>	
			<a href="logout" class="btn">Log Out</a>
		</div>
		<div style="clear:both;"></div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#post_button').click(function(){
				$.ajax({
					url:"/users/post/"+encodeURIComponent($('#post').val()),
					success:function(result){
					if(result != "false"){
				   		$('#posts_of_yours').prepend(result);
				   		$('#post').val("");	
				   	}
				}});

				return false;
			});
			$('#posts,#posts_of_yours').on('click','.like_button', function(){
				var post_id = $(this).attr('data-post-id');
				if($.trim($(this).html()) == "Like"){
					$.ajax({
						url:"/users/like/"+post_id+"/1",
						postId: post_id,
						like: $(this),
						success:function(result){
						if(result != "false"){
					   		this.like.html('Unlike');
							$('#like_'+this.postId).html(result);
					   	}
					}});
				}
				else
				{

					$.ajax({
						url:"/users/unlike/"+post_id+"/1",
						postId: post_id,
						like: $(this),
						success:function(result){
						if(result != "false"){
					   		this.like.html('Like');
							$('#like_'+this.postId).html(result);
					   	}
					}});

				}
				return false;
			});
			$('#posts,#posts_of_yours').on('click','.likeForComment', function(){
				var comment_id = $(this).attr('data-comment-id');
				if($.trim($(this).html()) == "Like"){
					$.ajax({
						url:"/users/like/"+comment_id+"/2",
						commentId: comment_id,
						like: $(this),
						success:function(result){
						if(result != "false"){
					   		this.like.html('Unlike');
							$('#likeComment_'+this.commentId).html(result);
					   	}
					}});
				}
				else
				{

					$.ajax({
						url:"/users/unlike/"+comment_id+"/2",
						commentId: comment_id,
						like: $(this),
						success:function(result){
						if(result != "false"){
					   		this.like.html('Like');
							$('#likeComment_'+this.commentId).html(result);
					   	}
					}});

				}
				return false;
			});
			$('#posts,#posts_of_yours').on('click','.dislike_button',function(){
				var post_id = $(this).attr('data-post-id');
				if($.trim($(this).html()) == "Dislike"){
					$.ajax({
						url:"/users/dislike/"+post_id+"/1",
						postId: post_id,
						like: $(this),
						success:function(result){
						if(result != "false"){
					   		this.like.html('Undislike');
							$('#dislike_'+this.postId).html(result);
					   	}
					}});
				}
				else
				{
					
					$.ajax({
						url:"/users/undislike/"+post_id+"/1",
						postId: post_id,
						like: $(this),
						success:function(result){
						if(result != "false"){
					   		this.like.html('Dislike');
							$('#dislike_'+this.postId).html(result);
					   	}
					}});

				}
				return false;
			});
			$('#posts,#posts_of_yours').on('click','.dislikeForComment', function(){
				var comment_id = $(this).attr('data-comment-id');
				if($.trim($(this).html()) == "Dislike"){
					$.ajax({
						url:"/users/dislike/"+comment_id+"/2",
						commentId: comment_id,
						like: $(this),
						success:function(result){
						if(result != "false"){
					   		this.like.html('Undislike');
							$('#dislikeComment_'+this.commentId).html(result);
					   	}
					}});
				}
				else
				{

					$.ajax({
						url:"/users/undislike/"+comment_id+"/2",
						commentId: comment_id,
						like: $(this),
						success:function(result){
						if(result != "false"){
					   		this.like.html('Dislike');
							$('#dislikeComment_'+this.commentId).html(result);
					   	}
					}});

				}
				return false;
			});
			$('#posts,#posts_of_yours').on('click','.comments_button',function(){
				var comments = "#comments_"+$(this).attr('data-post-id');
				$(comments).slideDown(300);
				return false;
			});
			$('#posts,#posts_of_yours').on("keypress",'.comment_button', function(event){
				if(event.which == 13){
					var comment = encodeURIComponent($(this).val());
					var post_id = $(this).attr('data-post-id');
					$.ajax({
					url:"/users/comment/"+comment+"/"+post_id,
					post : post_id,
					com: $(this),
					success:function(result){
						if(result != "false"){
							$('#comments_'+this.post+' > .comment_button').after(result);
							this.com.val("");
					   	}
					}});	
				}
			});
		});
	</script>
@stop