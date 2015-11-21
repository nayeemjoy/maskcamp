<?php 
	use Emojione\Emojione;

	/**
	* 
	*/
	class AjaxsController extends \BaseController
	{
		public function processComment($comment){
			$now = Carbon::parse($comment->created_at);
			$user = User::find($comment->user_id);
			$url = Picture::find($user->picture);
			$url = $url->url;
			$text = htmlentities($comment->comment);
			$text = preg_replace('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i','<a target="_blank" href="$1">$1</a>',nl2br($text));
			$text = Emojione::shortnameToImage($text);
			if(Auth::check()){
				$liked = CommentLike::whereCommentId($comment->id)->whereUserId(Auth::user()->id)->get()->count();
				$disliked = CommentDislike::whereCommentId($comment->id)->whereUserId(Auth::user()->id)->get()->count();
			}
			else{
				$liked = 0;
				$disliked = 0;
			}

			$data = array(
			 	'id' => $comment->id,
				'user' =>$comment->user_id,
				'comment' => $text,
				'post_id' => $comment->post_id, /*27-May-Ehsan*/
				'ago' => $now->diffForHumans(),
				'img' => asset($url),///*19-May-2015 Ehsan*/
				'like' => CommentLike::whereCommentId($comment->id)->get()->count(),
				'dislike' => CommentDislike::whereCommentId($comment->id)->get()->count(), 
				'liked' => $liked,
				'disliked' =>  $disliked
			);
			return  $data;
		}
		
		public function getComments($id)
		{
			$time = Input::get('time');
			try {
				$comments = Comment::wherePostId($id)->where('created_at', '<' ,$time)->orderBy('id','desc')->skip(Input::get('off'))->take(4)->get();
				$i = 0;
				foreach ($comments as $comment) {
					// Comment Process
						$data['comments'][$i++] = $this->processComment($comment);

						// 
			 	}
			 	$data['length'] = sizeof($comments);
				return json_encode($data);
			} catch (Exception $e) {
				
			}
			return 'false';	
		}
		public function createComment($id){
			$data = Input::all();
			$validator = Validator::make($data,Comment::$rules);
			if($validator->passes()){
				$data = Input::all();
				$comment = new Comment;
				$comment->comment = $data['comment'];
				$comment->post_id = $id;
				$comment->user_id = Auth::user()->id;
				$comment->created_at = Carbon::now();
				if(Auth::user()->disable == '2'){
					return 'false';
				}
				try {
					if($comment->save()){
						DB::table('notifications')->where('type', '3')->where('post_id',$comment->post_id)->update(array('seen' => 0,'updated_at' => Carbon::now()));
						// Comment Process
						// Edited
						$notification = Notification::whereUserId($comment->user_id)->wherePostId($comment->post_id)->first();
						if($notification){
							$notification->seen = 2;
							$notification->comment = Comment::wherePostId($comment->post_id)->get()->count();
							
							
							$notification->save();
						}
						else
						{
							$notification = new Notification;
							$notification->user_id = $comment->user_id;
							$notification->type = 3;
							$notification->seen = 2;
							$notification->comment = Comment::wherePostId($comment->post_id)->get()->count();
							$notification->post_id = $comment->post_id;
							$notification->created_at = Carbon::now();
							$notification->updated_at = Carbon::now();
							$notification->save();
						}
						// Edited
							$data = $this->processComment($comment);

						// 
						return json_encode($data);
					}
				} catch (Exception $e) {
					
				}
			
			}

			return 'false';
		}
		public function createPost(){
			$data = Input::all();
			$validator = Validator::make($data,Post::$rules);
			if($validator->passes()){
				try {
					$post = new Post;
					$post->post = $data['post'];
					$post->user_id = Auth::user()->id;
					$post->created_at = Carbon::now();
					$post->feeling = $data['feel'];
					$post->type = $data['type']; ///////////////////06-May-2015-Ehsan
					if(isset($data['hideName'])){
						$post->hide_name = $data['hideName'];
					}
					if($post->type == 2)
					{
						$campus = UserCampus::whereUserId(Auth::user()->id)->first();
						if($campus){
							$campus = $campus->campus_id;
						}
						else
						{
							$campus = 1;
						}
						$post->campus_id = $campus;
						
					}
					if(Auth::user()->disable == '2'){
						return 'false';
					}
					if($post->save()){
						$notification = new Notification;
						$notification->user_id = $post->user_id;
						$notification->type = 1;
						$notification->post_id = $post->id;
						$notification->created_at = Carbon::now();
						$notification->updated_at = Carbon::now();
						$notification->save();
						$notification = new Notification;
						$notification->user_id = $post->user_id;
						$notification->type = 2;
						$notification->post_id = $post->id;
						$notification->created_at = Carbon::now();
						$notification->updated_at = Carbon::now();
						$notification->save();
						$notification = new Notification;
						$notification->user_id = $post->user_id;
						$notification->type = 3;
						$notification->post_id = $post->id;
						$notification->created_at = Carbon::now();
						$notification->updated_at = Carbon::now();
						$notification->save();
						if($post->type == 1 || $post->type == 2){
							preg_match_all('/#([a-zA-Z0-9\x{0980}-\x{09FF}_])+/u', $post->post, $matches);
							foreach ($matches[0] as $key) {
								$tag = HashTag::whereTag($key)->first();
								if($tag){
									$tagged_post = new TaggedPost;
									$tagged_post->post_id = $post->id;
									$tagged_post->tag_id = $tag->id;
									$tagged_post->save();
								}
								else
								{
									$tag = new HashTag;
									$tag->tag = $key;
									$tag->save();
									$tagged_post = new TaggedPost;
									$tagged_post->post_id = $post->id;
									$tagged_post->tag_id = $tag->id;
									$tagged_post->save();
								}
							}
						}
						// Post Process
							$now = Carbon::parse($post->created_at);
			          		$feeling = DB::table('feelings')->find($post->feeling)->name;
			           		$following = Following::whereFollowerId(Auth::user()->id)->whereFollowingId($post->user_id)->get()->count();
			           		$confession = Confession::whereUserId($post->user_id)->first();
							if($confession){
								$confess_time = Carbon::parse($confession->created_at);
								$confess_time = $confess_time->diffInHours();
								//$confess_time = $confess_time->diffInSeconds();
								if($confess_time < 24){
									$confession = $confession->confess;	
								}
								else
								{
									$confession = null;
								}
							}
							$user = User::find($post->user_id);
							$url = Picture::find($user->picture);
							$url = $url->url;
							$text = htmlentities($post->post);
							//9-2-Start
							$pos = strpos($text ,'watch?v=');
							if ($pos != 0) {
								$pos = $pos + 8;
								$str = substr($text, $pos, 11);
							# code...
							}
							else{
								$str = null;
							}
							//9-2-End
					/* Eve-26-May-Ehsan */
						
	          			/* !!!Eve-26-May-Ehsan */
	          			$text = preg_replace('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i','<a target="_blank" href="$1">$1</a>', $text);
	          			if($post->type == 1 || $post->type == 2){
							$text = preg_replace('/#([a-zA-Z0-9\x{0980}-\x{09FF}_])+/u','<a class="tags">$0</a>',$text); //5-7-Ehsan
						}
							$text = nl2br($text);
						$text = Emojione::shortnameToImage($text);
	          			$data = array(
						'id' => $post->id,
						'post' => $text,
						'user_id' => $post->user_id,
						'img' => asset($url),
						'confess' => $confession,
						'following' => $following,
						'type' => $post->type,
						'like' => Like::wherePostId($post->id)->get()->count(),
						'dislike' => Dislike::wherePostId($post->id)->get()->count(), 
						'liked' => Like::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'disliked' => Dislike::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'comment' => Comment::wherePostId($post->id)->get()->count(),
						'feeling' => $feeling,
						'vidsrc' => $str, //9-2-Ehsan
						'ago' => $now->diffForHumans()
					); 

						// 
						return json_encode($data);
					}
				} 
				catch (Exception $e) 
				{
					return $e->getMessage();
				}
				
			}
			return 'false';
		}

		public function viewMorePost(){
			try {


				$type = Input::get('type');
				$time = Input::get('time');
				if($type == 1){
					// Changed
						$posts = Post::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*')->where('posts.created_at', '<=' ,$time)->where('users.disable', '0')->whereType('0')->whereIn('posts.user_id', function($query){
						$query->select('friend_id')->from('friend_list')->whereUserId(Auth::user()->id);
						})->orWhereIn('posts.user_id', function($query){
							$query->select('following_id')->from('followings')->whereFollowerId(Auth::user()->id);
						})->where('posts.created_at', '<=' ,$time)->where('users.disable', '0')->whereType('1')->orWhere('posts.user_id', Auth::user()->id)->where('posts.created_at', '<=' ,$time)->where('users.disable', '0')->whereType('0')->orderBy('posts.id', 'desc')->skip(Input::get('off'))->take(10)->get();
					// Changed
				}
				elseif($type == 2){
					$posts = Post::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*')->where('users.disable', '0')->whereType('1')->where('posts.created_at', '<=' ,$time)->orderBy('posts.id', 'desc')->skip(Input::get('off'))->take(10)->get();/*27-May-Joy*/
				}
				elseif($type == 3){ //23-6-Ehsan
					$posts = Post::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*')->where('users.disable', '0')->whereType('2')->where('posts.created_at', '<=' ,$time)->where('posts.campus_id', Session::get('campus'))->orderBy('posts.id', 'desc')->skip(Input::get('off'))->take(10)->get();/*27-May-Joy*/
				}
				elseif ($type == 4) { //23-6-Ehsan
					$posts = Post::whereUserId(Auth::user()->id)->whereType('0')->where('posts.created_at', '<=' ,$time)->orderBy('id', 'desc')->skip(Input::get('off'))->take(10)->get();
				}
				elseif ($type == 5) { //23-6-Ehsan
					$posts = Post::whereUserId(Auth::user()->id)->whereType('1')->where('posts.created_at', '<=' ,$time)->orderBy('id', 'desc')->skip(Input::get('off'))->take(10)->get();
				}
				elseif($type == 6){
					$posts = Post::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*')->where('posts.created_at', '<=' ,$time)->where('users.disable', '0')->whereType('2')->where('posts.user_id', Auth::user()->id)->where('posts.campus_id', Session::get('campus'))->orderBy('posts.id', 'desc')->skip(Input::get('off'))->take(10)->get();/*27-May-Joy*/
				}
				elseif($type == 7){

					$posts = Post::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*')->where('posts.created_at', '<=' ,$time)->where('users.disable', '0')->whereType('1')->whereHideName('0')->whereNotNull('users.username')->where('posts.user_id', Session::get('id'))->orderBy('posts.id', 'desc')->skip(Input::get('off'))->take(10)->get();/*27-May-Joy*/
				}
				$i = 0;
				foreach ($posts as $post) {
					$now = Carbon::parse($post->created_at);
	          			$feeling = DB::table('feelings')->find($post->feeling)->name;
	           			$following = Following::whereFollowerId(Auth::user()->id)->whereFollowingId($post->user_id)->get()->count();
	           			$confession = Confession::whereUserId($post->user_id)->first();
					if($confession){
						$confess_time = Carbon::parse($confession->created_at);
						$confess_time = $confess_time->diffInHours();
						//$confess_time = $confess_time->diffInSeconds();
						if($confess_time < 24){
							if($confession->updated_at < $post->created_at){
								$confession_view = ConfessionView::whereConfessionId($confession->id)->whereIsValid(1)->get()->count();
								$confession = [
									'id' => $confession->id,
									'confess'=> $confession->confess,
									'view' => $confession_view
								];

							}
							else{
								$confession = null;
							}	
						}
						else
						{
							$confession = null;
						}
					}
					$user = User::find($post->user_id);
					$url = Picture::find($user->picture);
					$url = $url->url;
	        	  		$text = htmlentities($post->post);
					
					// 9-2-Start
	        	  		$pos = strpos($text ,'watch?v=');
						if ($pos != 0) {
							$pos = $pos + 8;
							$str = substr($text, $pos, 11);
						# code...
						}
						else{
							$str = null;
						}
					// 9-2-End
					
					/*Eve-26-May-Ehsan*/
					
		          		/*!!!!Eve-26-May-Ehsan*/
					$text = preg_replace('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i','<a target="_blank" href="$1">$1</a>', $text);
	          			if ($post->type == 1  || $post->type == 2) {
							if($type >= 5){	/*$type == 3 || removed on Eve-26-May-Ehsan*/ //5-7-Ehsan
				        	  	$text = preg_replace('/#([a-zA-Z0-9\x{0980}-\x{09FF}_])+/u','<a class="notags">$0</a>',$text); //17-11-Ehsan
			          		}	else if($type < 4) { /*23-6-Ehsan*/
				        	  	$text = preg_replace('/#([a-zA-Z0-9\x{0980}-\x{09FF}_])+/u','<a href="" class="tags">$0</a>',$text);
			          		}
		          		} 
						$text = nl2br($text);
						$text = Emojione::shortnameToImage($text);

						$name = null;
						if(($type == 2 || $type == 7) && !$post->hide_name){
							$user = User::find($post->user_id);
							$name = $user->username;
						}


	          			$data['posts'][$i++] = array(
						'id' => $post->id,
						'post' => $text,
						'user_id' => $post->user_id,
						'img' => asset($url),
						'confess' => $confession,
						'following' => $following,
						'type' => $post->type,
						'like' => Like::wherePostId($post->id)->get()->count(),
						'dislike' => Dislike::wherePostId($post->id)->get()->count(), 
						'liked' => Like::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'disliked' => Dislike::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'comment' => Comment::wherePostId($post->id)->get()->count(),
						'feeling' => $feeling,
						'vidsrc' => $str, //9-2-Ehsan
						'name' => $name,
						'ago' => $now->diffForHumans()
					);
				}
				$data['length'] = sizeof($posts);
				return json_encode($data);
			} catch (Exception $e) {
				// return $e->getMessage();		
			}
			return 'false';
		}
		
		public function like($id){
			$type = Input::get('type');
			if($type){
				if($type == 1)
				{	
					$like = Like::wherePostId($id)->whereUserId(Auth::user()->id)->get()->count();
					$dislike = Dislike::wherePostId($id)->whereUserId(Auth::user()->id)->get()->count();
					if($like || $dislike){
						return 'false';	
					}
					$like = new Like;
					$like->post_id = $id;
					$like->user_id = Auth::user()->id;
					try
					{
						if($like->save())
						{
							DB::table('notifications')->where('type', '1')->where('post_id',$like->post_id)->update(array('seen' => 0,'updated_at' => Carbon::now()));
							return 'true';
						}
						
					} catch (Exception $e) {
						
					}
				}
				elseif($type == 2) {
					$like = CommentLike::whereCommentId($id)->whereUserId(Auth::user()->id)->get()->count();
					$dislike = CommentDislike::whereCommentId($id)->whereUserId(Auth::user()->id)->get()->count();
					if($like || $dislike){
						return 'false';	
					}
					$like = new CommentLike;
					$like->comment_id = $id;
					$like->user_id = Auth::user()->id;
					try
					{
						if($like->save())
						{
							return 'true';
						}
						
					} catch (Exception $e) {
						
					}
				}
			}
			return 'false';
		}


		public function unlike($id){
			$type = Input::get('type');
			$username = Auth::user()->id;
			if($type){
				if($type == 1){

					try{
						$like = Like::wherePostId($id)->whereUserId($username)->first();
						//echo $like->id;
						if($like){

							if($like->delete()){
								return 'true';
							}

						}
					} catch (Exception $e) {
						
					}
				}
				elseif ($type == 2) {
					try
					{
						$like = CommentLike::whereCommentId($id)->whereUserId($username)->first();

						if($like){
							if($like->delete()){
								return 'true';
							}
						}
					} catch (Exception $e) {
						
					}
				}
			}
			return 'false';
		}


		public function dislike($id){
			$type = Input::get('type');

			if($type){
				if($type == 1)
				{
					$like = Like::wherePostId($id)->whereUserId(Auth::user()->id)->get()->count();
					$dislike = Dislike::wherePostId($id)->whereUserId(Auth::user()->id)->get()->count();
					if($like || $dislike){
						return 'false';	
					}
					$like = new Dislike;
					$like->post_id = $id;
					$like->user_id = Auth::user()->id;
					try
					{
						if($like->save())
						{
							DB::table('notifications')->where('type', '2')->where('post_id',$like->post_id)->update(array('seen' => 0,'updated_at' => Carbon::now()));
							return 'true';
						}
						
					} catch (Exception $e) {
						
					}
				}
				elseif($type == 2) {
					$like = CommentLike::whereCommentId($id)->whereUserId(Auth::user()->id)->get()->count();
					$dislike = CommentDislike::whereCommentId($id)->whereUserId(Auth::user()->id)->get()->count();
					if($like || $dislike){
						return 'false';	
					}
					$like = new CommentDislike;
					$like->comment_id = $id;
					$like->user_id = Auth::user()->id;
					try
					{
						if($like->save())
						{
							return 'true';
						}
						
					} catch (Exception $e) {
						
					}
				}
			}
			return 'false';
		}


		public function undislike($id){
			$type = Input::get('type');
			$username = Auth::user()->id;
			if($type){
				if($type == 1){
					try {
						$like = Dislike::wherePostId($id)->whereUserId($username)->first();

						if($like){
							if($like->delete()){
								return 'true';
							}
						}
					} catch (Exception $e) {
						
					}
				}
				elseif ($type == 2) {
					try
					{
						$like = CommentDislike::whereCommentId($id)->whereUserId($username)->first();

						if($like){
							if($like->delete()){
								return 'true';
							}
						}
					} catch (Exception $e) {
						
					}
				}
			}
			return 'false';
		}
		public function getIndividualPersonsPostsLikeDislikeRatio($id=null){
			try {
				$userid = $id;
				$posts = Post::whereUserId($id)->get();
				$like = 0;
				$dislike = 0;
				foreach ($posts as $key) {
					$count = Like::wherePostId($key->id)->get()->count();
					$like += $count;
					$count = Dislike::wherePostId($key->id)->get()->count();
					$dislike += $count;
				}
				$temp = (($like * 1.00)/($like+$dislike))*100.00;
				$data['like'] = number_format((float)$temp, 2, '.', '');
				$temp = (($dislike * 1.00)/($like+$dislike))*100.00;
				$data['dislike'] = number_format((float)$temp, 2, '.', '');
				
				return json_encode($data);
			} catch (Exception $e){
				$data['like'] = 50;
				$data['dislike'] = 50;
			}
			return json_encode($data);
		}
		public function following(){
			try {
				$following = new Following;
				$following->follower_id =  Auth::user()->id;
				$following->following_id = Input::get('following_id');
				if($following->save()){
					return 'true';
				}
				else{
					return 'false';
				}
			} catch (Exception $e) {
				return 'false';	
			}
		}
		public function unfollowing(){
			try {
				$following = Following::whereFollowerId(Auth::user()->id)->whereFollowingId(Input::get('following_id'))->first();
			
				if($following != null){
					$following->delete();
					return 'true';
				}
				else{
					return 'false';
				}
			} catch (Exception $e) {
				return 'false';	
			}
		}
		public function createReport(){
			try {
				$post_report = PostReport::wherePostId(Input::get('pid'))->whereUserId(Auth::user()->id)->whereReportId(Input::get('rid'))->first();
				if($post_report){
					return 'false';
				}
				$post_report = new PostReport;
				$post_report->post_id = Input::get('pid');
				$post_report->user_id = Auth::user()->id;
				$post_report->report_id = Input::get('rid');

				if($post_report->save()){
					return 'true';
				}
				else{
					return 'false';
				}
			} catch (Exception $e) {
				return 'false';	
			}
		}
		
		//Confession Related Code Start
		public function confess(){
			try {

				$confess = Input::get('confess');
				$rules = [
					'confess' => 'required'
				];
				$validator = Validator::make(Input::all(), $rules);
				if($validator->passes()){
					$user = Confession::whereUserId(Auth::user()->id)->first();
					if($user){
						$user->confess = $confess;
						$user->created_at = Carbon::now();
						if($user->save()){
							DB::table('confession_view')->where('confession_id', $user->id)->update(array('is_valid' => 0,'updated_at' => Carbon::now()));
							return 'true';
						}
					}
					else
					{
						$user = new Confession;
						$user->user_id = Auth::user()->id;
						$user->confess = $confess;
						$user->created_at = Carbon::now();
						if($user->save()){
							DB::table('confession_view')->where('confession_id', $user->id)->update(array('is_valid' => 0,'updated_at' => Carbon::now()));
							
							return 'true';

						}
					}
				}
			}catch(Exception $e) {
				
			}
			return 'false';
		}
		// Confession View Created
		public function viewConfession(){
			
			$confession_id = Input::get('cid');
			$confession = Confession::find($confession_id);
			if($confession == null){
				return 'false';
			}
			$user_id = Auth::user()->id;
			$confession_view = ConfessionView::whereConfessionId($confession_id)->whereUserId($user_id)->first();
			if($confession_view){
				if ($confession_view->is_valid == 1) return 'done'; //7-11-Ehsan ::done means already viewed and valid
				$confession_view->is_valid = 1;
				$confession_view->save();
			}
			else{
				$confession_view = new ConfessionView;
				$confession_view->confession_id = $confession_id;
				$confession_view->user_id = $user_id;
				$confession_view->is_valid = 1;
				$confession_view->save();
			}		
			return 'true';
		}
		//Confession Related Code Ends
		public function setProfilePicture($id = null){
			try {
				$user = User::find(Auth::user()->id);
				if($user){
					$user->picture = $id;
					$user->updated_at = Carbon::now();
					if ($user->save()){
						return 'true';
					}
				}
			} catch (Exception $e) {
				
			}
			return 'false';
		}
		public function deletePost($id = null){
			try {
				$type = Input::get('type');
				if($type == 0){
					$post = Post::whereId($id)->whereUserId(Auth::user()->id)->first();
					if($post){
						if($post->delete()){
							return 'true';
						}
					}
				}
				elseif($type == 1){
					$comment = Comment::whereId($id)->whereUserId(Auth::user()->id)->first();
					if($comment){
						if($comment->delete()){
							return 'true';
						}
					}
				}
				

			} catch (Exception $e) {
				
			}
			return 'false';
		}
		public function requestToDelete($id = null){
			try {
				$type = Input::get('type');
				if($type == 0){
					$post = Post::find($id);
					if($post){
						$notification = Notification::where('user_id',$post->user_id)->where('type', 4)->where('post_id',$post->id)->first();
						if($notification){
							$notification->like = $notification->like + 1;
							$notification->seen = 0;
							$notification->updated_at = Carbon::now();
							$notification->save();
							
						}
						else
						{
							$notification = new Notification;
							$notification->user_id = $post->user_id;
							$notification->type = 4;
							$notification->post_id = $post->id;
							$notification->like = 1;
							$notification->seen = 0;
							$notification->created_at = Carbon::now();
							$notification->updated_at = Carbon::now();
							$notification->save();
							// return 'ok';
						}
						return 'true';
					}
				}
				elseif($type == 1)
				{
					$comment = Comment::find($id);
					if($comment){
						$notification = Notification::where('user_id',$comment->user_id)->where('type', 5)->where('post_id',$comment->post_id)->where('dislike',$comment->id)->first();
						if($notification){
							$notification->like = $notification->like + 1;
							$notification->seen = 0;
							$notification->created_at = Carbon::now(); 
							$notification->updated_at = Carbon::now();
							$notification->save();
							
						}
						else
						{
							$notification = new Notification;
							$notification->user_id = $comment->user_id;
							$notification->type = 5;
							$notification->post_id = $comment->post_id;
							$notification->like = 1;
							
							$notification->dislike = $comment->id;
							$notification->seen = 0;

							$notification->created_at = Carbon::now();
							$notification->updated_at = Carbon::now();
							$notification->save();
						}
						return 'true';
					}
				}
				
			} catch (Exception $e) {
				
			}
			return 'false';
		}
		//
		// Get HashTagged Post Result
		public function postProcess($posts){
			$data = null;
			$i = 0;
			foreach ($posts as $post) {
				$post = Post::find($post->id);
				//if ($i == 5) break;	///////////////////06-May-2015-Ehsan
					$now = Carbon::parse($post->created_at);
	          		$feeling = DB::table('feelings')->find($post->feeling)->name;
	           		$following = Following::whereFollowerId(Auth::user()->id)->whereFollowingId($post->user_id)->get()->count();
	           		$confession = Confession::whereUserId($post->user_id)->first();
					if($confession){
						$confess_time = Carbon::parse($confession->created_at);
						//$now = $now->diffInHours();
						$confess_time = $confess_time->diffInHours(); /*23-6-Ehsan*/
						//$confess_time = $confess_time->diffInSeconds();
						if($confess_time < 24){
							$confession = $confession->confess;	
						}
						else
						{
							$confession = null;
						}
					}
					$user = User::find($post->user_id);
					$user = User::find($post->user_id);
					if($user->disable == 1){
						continue;
					}
					$url = Picture::find($user->picture);
					$url = $url->url;
	          			$text = htmlentities($post->post);
					$text = preg_replace('/#([a-zA-Z0-9\x{0980}-\x{09FF}_])+/u','<a href="" class="tags">$0</a>',$text);
					/* Eve-26-May-Ehsan */
		          		$text = preg_replace('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i','<a target="_blank" href="$1">$1</a>', $text);
		          		/* !!!!Eve-26-May-Ehsan */
		          		$text = nl2br($text);
		          		
					$text = Emojione::shortnameToImage($text);
	          			$data[$i++] = array(
						'id' => $post->id,
						'post' => $text,
						'user_id' => $post->user_id,
						'img' => asset($url),
						'confess' => $confession,
						'following' => $following,
						'type' => $post->type,
						'like' => Like::wherePostId($post->id)->get()->count(),
						'dislike' => Dislike::wherePostId($post->id)->get()->count(), 
						'liked' => Like::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'disliked' => Dislike::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'comment' => Comment::wherePostId($post->id)->get()->count(),
						'feeling' => $feeling,
						'ago' => $now->diffForHumans()
					);
			}
			return $data;
		}
		public function getResultByTag(){
			$data['posts'] = null;
			$type = Input::get('type');
			if($type == null){
				return null;
			}
			try {
				$tag = Input::get('tag');
				if($type == 1)
				{
					$posts = DB::table('hash_tagged_posts')->select('post_id as id','tag')->join('hashtags', 'hashtags.id', '=', 'hash_tagged_posts.tag_id')->whereIn('hash_tagged_posts.post_id',function($query){
							$query->select('posts.id')->from('posts')->whereType('1');
					})->where('tag', 'like','%'. $tag.'%')->orderBy('post_id','desc')->get();	
				}
				elseif($type == 2)
				{
					$posts = DB::table('hash_tagged_posts')->select('post_id as id','tag')->join('hashtags', 'hashtags.id', '=', 'hash_tagged_posts.tag_id')->whereIn('hash_tagged_posts.post_id',function($query){
							$query->select('posts.id')->from('posts')->whereType('2')->whereCampusId(Session::get('campus'));
					})->where('tag', 'like', '%'. $tag.'%')->orderBy('post_id','desc')->get();
				}
				$data['posts'] = $this->postProcess($posts);
				//echo 'ok';
			} catch (Exception $e) {
			
			}
			return json_encode($data);
		}
		public function getTagsByTag(){
			$data['tags'] = null;
			$type = Input::get('type');
			if($type == null){
				return null;
			}
			try {
				$tag = Input::get('tag');
				if($type == 1)
				{
					$data['tags'] = HashTag::join('hash_tagged_posts', 'hashtags.id', '=', 'hash_tagged_posts.tag_id')
					->whereIn('hash_tagged_posts.post_id',function($query){
							$query->select('posts.id')->from('posts')->whereType('1');
					})->where('hashtags.tag', 'like','%'. $tag.'%')->groupBy(['hashtags.id', 'hashtags.tag'])->get(['hashtags.id','hashtags.tag']);
					
				}
				elseif($type == 2)
				{
					$data['tags'] = HashTag::join('hash_tagged_posts', 'hashtags.id', '=', 'hash_tagged_posts.tag_id')
					->whereIn('hash_tagged_posts.post_id',function($query){
						$query->select('posts.id')->from('posts')->whereType('2')->whereCampusId(Session::get('campus'));
					})->where('hashtags.tag', 'like','%'. $tag.'%')->groupBy(['hashtags.id', 'hashtags.tag'])->get(['hashtags.id','hashtags.tag']);
				
				}
			}catch (Exception $e) {
				
			}
			return json_encode($data);
		}
		// Account Enable
		public function enable(){
			try {
				$user = User::find(Auth::user()->id);
				
				if($user){
					if($user->disable == 2){
						return Redirect::to('/');		
					}
					$user->disable = 0;
					$user->save();
					return Redirect::to('/profile');
				}
			} catch (Exception $e) {
				
			}
			return Redirect::to('/');
		}
		// Account Disable
		public function disable(){
			try {
				$user = User::find(Auth::user()->id);
				if($user){
					if($user->disable == 2){
						return Redirect::to('/');		
					}
					$user->disable = 1;
					$user->save();
					return Redirect::to('/logout');
				}
			} catch (Exception $e) {
				
			}
			return Redirect::to('/');
		}
		public function checkedNotification(){

				try {
					DB::table('notifications')->whereUserId(Auth::user()->id)->update(array('seen' => 1));
					return "true";	
				} catch (Exception $e){
						
				}
				return "false";
		}
		// Campus Feature Related Code

		public function setCampus($id){
			$ucampus = UserCampus::whereUserId(Auth::user()->id)->first();
			if($id == 1)
			{
				return 'false';
			}
			//return json_encode($ucampus);
			if($ucampus){
				$now = Carbon::parse($ucampus->updated_at);
				if($now->diffInDays() < 30){
					return 'false';	
				}
			
				$ucampus->campus_id = $id;
				$ucampus->save();
				return 'true';
			}
			else
			{
				$ucampus = new UserCampus;
				$ucampus->user_id = Auth::user()->id;
				$ucampus->campus_id = $id;
				$ucampus->save();
				return 'true';
			}
			return 'false';

		}


		// Campus Feature Related Code End...
		// Set Username
		public function setUsername(){
			$user = Auth::user();
			$rules = array
			(
				'name'    => 'required|unique:users,username,'.$user->id
			);
			$data = Input::all();
			$validator = Validator::make($data, $rules);
			if($validator->fails()){
				return Response::json([
						'message' => $validator->messages(),
						'status'  => false
					]);
			}
			$user = Auth::user();
			$user->username = $data['name'];

			$user->username_created_at = Carbon::now();
			
			if($user->save()){
				return Response::json([
						'message' => 'Success',
						'status'  => true
					]);
			}
			return Response::json([
						'message' => 'Failed',
						'status'  => false
					]);
			
		}
		public function getNotification(){
			$off = Input::get('off');
			$notifications = Notification::whereUserId(Auth::user()->id)->where('seen','!=',2)->orderBy('updated_at', 'desc')->skip(Input::get('off'))->take('18446744073709551615')->get();
			if(count($notifications) == 0){
				return '404';
			}
			$date = Carbon::parse(Input::get('date'));

			$data['notifications'] = null;
			$i = 0;
			$size = 0;
			foreach ($notifications as $notification){
				
				$dec = 1;
				if($notification->type == 1){
					$like = Like::wherePostId($notification->post_id)->get()->count() - $notification->like;
					// $dislike = Dislike::wherePostId($notification->post_id)->get()->count() - $notification->dislike;
					if($like > 0){
						// $ss = $like == 1? '': 's';
						$msg = $like;
						// $msg = 'You have <b>'.$msg.'</b> in your Post';
					}
					else{
						$dec = 0;
					}
					$post = Post::find($notification->post_id)->post;
					$post = ' "'.str_limit($post, 20,'...').'"';
				}
				elseif($notification->type == 2){
					$dislike = Dislike::wherePostId($notification->post_id)->get()->count() - $notification->dislike;

					if($dislike > 0){
						// $ss = $dislike == 1 ? '': 's';
						$msg = $dislike;//.' new dislike'.$ss;
						// $msg = 'You have <b>'.$msg.'</b> in your Post';
					}
					else{
						$dec = 0;
					}
					$post = Post::find($notification->post_id)->post;
					$post = ' "'.str_limit($post, 20,'...').'"';
				}
				elseif($notification->type == 3){
					$comment = Comment::wherePostId($notification->post_id)->get()->count() - $notification->comment;
					if($comment > 0){
						$msg = $comment;

					}
					else{
						$dec = 0;
					}
					$post = Post::find($notification->post_id)->post;
					$post = ' "'.str_limit($post, 20,'...').'"';
				}
				elseif($notification->type == 4){
					$post = Post::find($notification->post_id)->post;
					$post = ' "'.str_limit($post, 20,'...').'"';
					$msg = $notification->like;
					
				}
				elseif($notification->type == 5){
					$post = Comment::find($notification->dislike);
					if($post){
						$post = $post->comment;
						$post = ' "'.str_limit($post, 20,'...').'"';
						$msg = $notification->like;
					}
					else{
						$notification->delete();
						$dec = 0;
					}			
				}
				if($dec){

					if($i == 10){
					 	$data['hasMore'] = true;
					 	break;
					}
					$message = [
						'id' => $notification->id,
						'type' => $notification->type,
						'message' => [
							'count' => $msg,
							'post' => $post 
						],
						'seen' => $notification->seen,
						'ago' => Carbon::parse($notification->updated_at)->diffForHumans()
					];
					// $data['notifications'][$i]['id'] = $notification->id;
					// $data['notifications'][$i]['msg'] = $msg.'<br/>'.$post;
					// $data['notifications'][$i]['ago'] = Carbon::parse($notification->updated_at)->diffForHumans();
					$data['notifications'][$i] = $message;
					if($notification->seen == 0){
						$size++;
					}
					// $data['notifications'][$i]['seen'] = $notification->seen;	
					$difference = $date->diff($notification->updated_at)->days;
					if($difference >= 1){
						//echo $notification->updated_at.'<br>';	
						$date = Carbon::parse($notification->updated_at);
						//echo $i.'<br>';
						$data['notifications'][$i]['mark'] = true;//$notification->updated_at;
					}
					else{
						$data['notifications'][$i]['mark'] = false;
						
					}

					$i++;
				}
				
				$off++;	
				// if($i == 10) break;
			}
			// return json_encode();
			// $view['msg'] = $data;//View::make('ajax.notification')->withData($data)->render();
			$data['length'] = $i;
			$data['off'] = $off;
			$data['date'] = $date.'';
			return Response::json($data);
		}
	}